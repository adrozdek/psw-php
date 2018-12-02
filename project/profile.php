<?php
require_once 'connections.php';
$users = require_once 'users.php';
if (!isset($_SESSION['userId']) || array_search($_SESSION['userId'], array_column($users, 'id')) === false) {
    header('UserId:' . $_SESSION['userId'] . array_search($_SESSION['userId'], array_column($users, 'id')));
    header('Location: index.php');
} ?>

<?php $theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 0; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formularz</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class="<?= $theme; ?>">
<?= require_once 'menu.php'; ?>
<div class="content">
    Witaj! Twój login to:
    <div style="background-color: black; color: red; font-size: 25px; width: 100%; height: 90%; text-align: center">
        <?= ucfirst($users[array_search($_SESSION['userId'], array_column($users, 'id'))]['login']); ?>
    </div>
    <div>
        <?php $test = "3.10 coś"; ?>
        <h3>Test: <?= $test; ?></h3>
        Konwersja typów: settype($test, 'int')
        <?php settype($test, 'int'); ?><br>
        Test: <?= $test; ?>
    </div>
    <div>
        <?php $test = "3.10 coś"; ?>
        <h3>Test: <?= $test; ?></h3>
        Rzutowanie: <?= (int)$test; ?><br>
        Test: <?= $test; ?>
    </div>
</div>
</body>
</html>
