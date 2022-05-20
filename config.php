<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}

$con = mysqli_connect('readme', 'root', '', 'readme');
mysqli_set_charset($con, 'utf8');
