<?php

require_once('config.php');

if (!isset($_SESSION['user'])) {
    header("Location: /index.php");
    exit();
} else {
    header("Location: /popular.php");
}
