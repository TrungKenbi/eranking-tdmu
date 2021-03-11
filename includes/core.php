<?php

defined('TRUNGKENBI') OR exit('No direct script access allowed');

ob_start();
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Asia/Ho_Chi_Minh');

define("BASE_PATH", dirname(dirname(__FILE__)));

require_once('config.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  $conn->set_charset("utf8mb4");
  $conn->query("SET time_zone = '+7:00'");
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
}

function __autoload($class_name) {
    if (file_exists(BASE_PATH . '/includes/classes/'.$class_name.'.class.php'))
        require_once(BASE_PATH . '/includes/classes/'.$class_name.'.class.php');
}

require_once('functions.php');

$hihi = $_SERVER['SCRIPT_NAME'];
$haha = explode('/', $hihi);

if (empty($_SESSION['id'])) {
    $filename = $haha[count($haha) - 1];
    $exduldes = [
        'login.php',
        'index.php',
        'ranking.php',
        'cron.php'
    ];
    if (!in_array($filename, $exduldes)) {
        header('Location: ' . $settings['base_url'] . '/account/login.php');
        exit;
    }
}

if (isset($_SESSION['id'])) {

    $_user = [
        'id' => $_SESSION['id'],
        'username' => $_SESSION['username'],
    ];

}





