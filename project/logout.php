<?php
require_once 'connections.php';
unset($_SESSION['userId']);
session_destroy();
header("Location: index.php");