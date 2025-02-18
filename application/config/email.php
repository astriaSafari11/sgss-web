<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.gmail.com', 
    'smtp_port' => 587,
    'smtp_user' => 'astria.safari@gmail.com',
    'smtp_pass' => '',
    //'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'mail', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
//    'charset' => 'iso-8859-1',
//    'wordwrap' => TRUE
);