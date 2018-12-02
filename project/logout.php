<?php
require_once 'connections.php';
unset($_SESSION['userId']);
session_regenerate_id();
session_destroy();
header("Location: index.php");