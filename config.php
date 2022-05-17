<?php

if (!isset($_SESSION)) {
    session_start();
}

$con = mysqli_connect('readme', 'root', '', 'readme');
mysqli_set_charset($con, 'utf8');
