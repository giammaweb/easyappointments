<?php

/**
 * Environment Configuration Refactoring.
 * Centralizes configuration parameters and enables automatic loading of
 * credentials from an external .env file to isolate sensitive data from 
 * the Git repository.
 *
 * @author Gian Marco Artioli <gianmarco@murena.io>
 * @version 1.0.0
 */
(function () {
    $envPath = __DIR__ . '/params.env';
    if (!file_exists($envPath)) {
        return;
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }

        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim(trim($value), '"\'');

            $_ENV[$name] = $value;
            putenv("{$name}={$value}");
        }
    }
})();

// Helper to convert 'true'/'false' strings from .env  file in real PHP booleans
$filterBool = function ($key, $default = false) {
    if (!isset($_ENV[$key])) {
        return $default;
    }
    $val = strtolower(trim($_ENV[$key]));
    return in_array($val, ['true', '1', 'on', 'yes'], true);
};


// ==================================================
// GLOBAL CONSTANTS DEFINITION
// ==================================================

define('ENV_BASE_URL',      $_ENV['BASE_URL'] ?? 'http://localhost');
define('ENV_LANGUAGE',      $_ENV['LANGUAGE'] ?? 'english');
define('ENV_DEBUG_MODE',    $filterBool('DEBUG_MODE', false));

// ==================================================
// DB CONSTANTS DEFINITION
// ==================================================

define('ENV_DB_HOST',      $_ENV['DB_HOST'] ?? 'mysql');
define('ENV_DB_NAME',      $_ENV['DB_NAME'] ?? 'easyappointments');
define('ENV_DB_USERNAME',  $_ENV['DB_USERNAME'] ?? 'user');
define('ENV_DB_PASSWORD',  $_ENV['DB_PASSWORD'] ?? 'password');

// ==================================================
// GOOGLE CALENDAR CONSTANTS DEFINITION
// ==================================================

define('ENV_GOOGLE_SYNC_FEATURE',   $filterBool('GOOGLE_SYNC_FEATURE', false));
define('ENV_GOOGLE_CLIENT_ID',      $_ENV['GOOGLE_CLIENT_ID'] ?? '');
define('ENV_GOOGLE_CLIENT_SECRET',  $_ENV['GOOGLE_CLIENT_SECRET'] ?? '');

// ==================================================
// EMAIL CONSTANTS DEFINITION
// ==================================================

define('ENV_EMAIL_SMTP_DEBUG',      (int)($_ENV['EMAIL_SMTP_DEBUG'] ?? 0));
define('ENV_EMAIL_SMTP_HOST',       $_ENV['EMAIL_SMTP_HOST'] ?? 'localhost');
define('ENV_EMAIL_SMTP_PORT',       (int)($_ENV['EMAIL_SMTP_PORT'] ?? 25));
define('ENV_EMAIL_FROM_NAME',       $_ENV['EMAIL_FROM_NAME'] ?? 'Easy!Appointments');
define('ENV_EMAIL_FROM_ADDRESS',    $_ENV['EMAIL_FROM_ADDRESS'] ?? 'noreply@easyappointments.org');
define('ENV_EMAIL_USERAGENT',       $_ENV['EMAIL_USERAGENT'] ?? 'Easy!Appointments');
define('ENV_EMAIL_PROTOCOL',        $_ENV['EMAIL_PROTOCOL'] ?? 'smtp');
define('ENV_EMAIL_MAILTYPE',        $_ENV['EMAIL_MAILTYPE'] ?? 'text');
define('ENV_EMAIL_SMTP_AUTH',       $filterBool('EMAIL_SMTP_AUTH', false));
define('ENV_EMAIL_SMTP_USER',       $_ENV['EMAIL_SMTP_USER'] ?? 'mailuser');
define('ENV_EMAIL_SMTP_PASS',       $_ENV['EMAIL_SMTP_PASS'] ?? 'mailpassword');
define('ENV_EMAIL_SMTP_CRYPTO',     $_ENV['EMAIL_SMTP_CRYPTO'] ?? 'ssl');
define('ENV_EMAIL_REPLY_TO',        $_ENV['EMAIL_REPLY_TO'] ?? '');
define('ENV_EMAIL_CRLF',            $_ENV['EMAIL_CRLF'] ?? "\r\n");
define('ENV_EMAIL_NEWLINE',         $_ENV['EMAIL_NEWLINE'] ?? "\r\n");


class Config {

    // ------------------------------------------------------------------------
    // GENERAL SETTINGS
    // ------------------------------------------------------------------------

    const BASE_URL = ENV_BASE_URL;
    const LANGUAGE = ENV_LANGUAGE;
    const DEBUG_MODE = ENV_DEBUG_MODE;

    // ------------------------------------------------------------------------
    // DATABASE SETTINGS
    // ------------------------------------------------------------------------

    const DB_HOST = ENV_DB_HOST;
    const DB_NAME = ENV_DB_NAME;
    const DB_USERNAME = ENV_DB_USERNAME;
    const DB_PASSWORD = ENV_DB_PASSWORD;

    // ------------------------------------------------------------------------
    // GOOGLE CALENDAR SYNC
    // ------------------------------------------------------------------------

    const GOOGLE_SYNC_FEATURE = ENV_GOOGLE_SYNC_FEATURE;
    const GOOGLE_CLIENT_ID = ENV_GOOGLE_CLIENT_ID;
    const GOOGLE_CLIENT_SECRET = ENV_GOOGLE_CLIENT_SECRET;

    // ------------------------------------------------------------------------
    // EMAIL SETTINGS
    // ------------------------------------------------------------------------

    const EMAIL_SMTP_DEBUG = ENV_EMAIL_SMTP_DEBUG;
    const EMAIL_SMTP_HOST = ENV_EMAIL_SMTP_HOST;
    const EMAIL_SMTP_PORT = ENV_EMAIL_SMTP_PORT;
    const EMAIL_FROM_NAME = ENV_EMAIL_FROM_NAME;
    const EMAIL_FROM_ADDRESS = ENV_EMAIL_FROM_ADDRESS;

    const EMAIL_USERAGENT = ENV_EMAIL_USERAGENT;
    const EMAIL_PROTOCOL = ENV_EMAIL_PROTOCOL;
    const EMAIL_MAILTYPE = ENV_EMAIL_MAILTYPE;
    const EMAIL_SMTP_AUTH = ENV_EMAIL_SMTP_AUTH;
    const EMAIL_SMTP_USER = ENV_EMAIL_SMTP_USER;
    const EMAIL_SMTP_PASS = ENV_EMAIL_SMTP_PASS;
    const EMAIL_SMTP_CRYPTO = ENV_EMAIL_SMTP_CRYPTO;
    const EMAIL_REPLY_TO = ENV_EMAIL_REPLY_TO;
    const EMAIL_CRLF = ENV_EMAIL_CRLF;
    const EMAIL_NEWLINE = ENV_EMAIL_NEWLINE;

}