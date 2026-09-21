<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Environment Configuration Refactoring.
 * Centralizes configuration parameters and enables automatic loading of
 * credentials from an external .env file to isolate sensitive data from 
 * the Git repository. (see /config.php file)
 *
 * @author Gian Marco Artioli <gianmarco@murena.io>
 * @version 1.0.0
 */


// Add custom values by settings them to the  array.
// Example: ['smtp_host'] = 'smtp.gmail.com';
// @link https://codeigniter.com/user_guide/libraries/email.html

// ------------------------------------------
// COMMON PARAMETERS
// ------------------------------------------

$config['smtp_debug']   = Config::EMAIL_SMTP_DEBUG;
$config['smtp_host']    = Config::EMAIL_SMTP_HOST;
$config['smtp_port']    = Config::EMAIL_SMTP_PORT;
$config['from_name']    = Config::EMAIL_FROM_NAME;
$config['from_address'] = Config::EMAIL_FROM_ADDRESS;

$config['useragent']    = Config::EMAIL_USERAGENT;
$config['protocol']     = Config::EMAIL_PROTOCOL;
$config['mailtype']     = Config::EMAIL_MAILTYPE;

$config['smtp_auth']    = Config::EMAIL_SMTP_AUTH;
$config['smtp_user']    = Config::EMAIL_SMTP_USER;
$config['smtp_pass']    = Config::EMAIL_SMTP_PASS;
$config['smtp_crypto']  = Config::EMAIL_SMTP_CRYPTO;

$config['reply_to']     = Config::EMAIL_REPLY_TO;
$config['crlf']         = Config::EMAIL_CRLF;
$config['newline']      = Config::EMAIL_NEWLINE;
