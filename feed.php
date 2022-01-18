<?php

session_start();

if (!isset($_SESSION['user'])) {
    header()
    header("Location: /index.php");
    exit();
}
