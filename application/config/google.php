<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
 */
$config['google']['client_id'] = '80744806355-pn3g6tr04g2gaedvq46chbgnp2ohnhnp.apps.googleusercontent.com';
$config['google']['client_secret'] = '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';
$config['google']['redirect_uri'] = 'https://www.shubhexa.in/ulogin/google_login';
$config['google']['application_name'] = 'Shubhexa login';
$config['google']['api_key'] = '';
$config['google']['scopes'] = array('email' => '', 'profile' => '');
