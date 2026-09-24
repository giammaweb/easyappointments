CREATE OR REPLACE VIEW easyappointments.overbooking_checker AS
SELECT 
    t.reservation_id,
    t.reservation_datetime,
    t.reservation_day,
    t.reservation_start_time,
    t.reservation_end_time,
    t.client_name,
    t.client_surname,
    t.client_fullname,
    t.service_name,
    t.service_capacity,
    t.provider_fullname,
    t.reservation_status,
    t.total_bookings_service_slot,
    t.total_bookings_provider_slot,
    /* Dynamic alert based on service capacity limits or provider double-booking */
    CASE 
        WHEN t.total_bookings_service_slot > COALESCE(t.service_capacity, 1) 
            THEN 'WARNING: Exceeded service capacity'
        WHEN t.total_bookings_provider_slot > 1 
             AND COALESCE(t.service_capacity, 1) = 1
            THEN 'WARNING: Provider double-booked'
        ELSE 'OK'
    END AS alert_status
FROM (
    SELECT
        a.id AS reservation_id,
        a.book_datetime AS reservation_datetime,
        CAST(a.start_datetime AS DATE) AS reservation_day,
        TIME_FORMAT(CAST(a.start_datetime AS TIME), '%H:%i') AS reservation_start_time,
        TIME_FORMAT(CAST(a.end_datetime AS TIME), '%H:%i') AS reservation_end_time,
        c.first_name AS client_name,
        c.last_name AS client_surname,
        CONCAT(c.first_name, ' ', c.last_name) AS client_fullname,
        s.name AS service_name,
        s.attendants_number AS service_capacity,
        CONCAT(p.first_name, ' ', p.last_name) AS provider_fullname,
        a.`status` AS reservation_status,
        /* Total active bookings for the SAME SERVICE in the SAME TIME SLOT */
        COUNT(*) OVER (
            PARTITION BY a.id_services, a.start_datetime
        ) AS total_bookings_service_slot,
        /* Total bookings assigned to the SAME PROVIDER in the SAME TIME SLOT */
        COUNT(*) OVER (
            PARTITION BY a.id_users_provider, a.start_datetime
        ) AS total_bookings_provider_slot
    FROM ea_appointments a
    LEFT JOIN ea_users c ON a.id_users_customer = c.id
    LEFT JOIN ea_services s ON a.id_services = s.id
    LEFT JOIN ea_users p ON a.id_users_provider = p.id
    WHERE a.is_unavailability = 0
) t;