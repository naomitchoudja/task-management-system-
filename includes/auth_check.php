<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /taskflow/pages/login.php');
    exit;
}
