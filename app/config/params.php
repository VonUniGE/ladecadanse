<?php


define("MODE_DEBUG", TRUE);
 
error_reporting(E_ALL & ~E_DEPRECATED);
//error_reporting(E_ALL);
ini_set('display_errors', '1');

$glo_email_admin = "michel@ladecadanse.ch";
$glo_email_info = "info@ladecadanse.ch";
$glo_email_support = "info@ladecadanse.ch";

// auth SMTP
$glo_email_host = "mail.darksite.ch";
$glo_email_username = "info@ladecadanse.ch";
$glo_email_password = "DiEs-Te82";

// path
//$rep_absolu = "/home/www/darksite.ch/ladecadanse/"; // prod
$rep_absolu = "C:\Users\michel\hosts\darksite\www\ladecadanse\\";
$rep_geolite2_db = "C:\Users\michel\host\www\GeoLite2-City.mmdb";

// URL
// $url_domaine = "http://ladecadanse.darksite.ch"; // prod
$url_domaine = "http://ladecadanse";
$url_site = $url_domaine.'/'; //"/ladecadanse/";

// pour récupérer le nom du script courant (sans path ni extension)
// define("PREG_PATTERN_NOMPAGE", "/^\/(.+)\.php$/"); // ladecadanse.darksite.ch
//define("PREG_PATTERN_NOMPAGE", "/^\/.*\/(.+)\.php$/"); // host/ladecadanse/
define("PREG_PATTERN_NOMPAGE", "/^\/(.+)\.php$/"); // host/ladecadanse/

// base de données
$param['dbhost'] = 'localhost';
$param['dbusername'] = 'ladecadanse2';
$param['dbpassword'] = 'd3music';
$param['dbname'] = 'ladecadanse3';