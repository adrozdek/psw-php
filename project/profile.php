<?php
require_once 'connections.php';
$users = require_once 'users.php';
if (isset($_SESSION['userId']) !== NULL || array_search($_SESSION['userId'], array_column($users, 'id')) === false) {
    header('Location: login.php');
} ?>