<?php
require_once 'connections.php';
unset($_SESSION['userId']);
header("Location: index.php");