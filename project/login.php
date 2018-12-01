<?php
require_once 'connections.php';
$users = require_once 'users.php';
$error = '';
if (isset($_SESSION['userId']) && array_search($_SESSION['userId'], array_column($users, 'id')) !== false) {
    header('Location: profile.php');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $key = array_search($_POST['login'], array_column($users, 'login'));
    if ($key !== false && $users[$key]['password'] === $_POST['password']) {
        $_SESSION['userId'] = $users[$key]['id'];
        header("Location: profile.php");
    } else {
        $error = 'Niepoprawne dane.';
    }

}
?>
<?php $theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 0;  ?>
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
    <?php if ($error != ''): ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" value="<?= isset($_POST['login']) ? $_POST['login'] : ''; ?>">
        <label for="password">Hasło:</label>
        <input type="password" name="password" id="password">
        <button type="submit">Zaloguj</button>
    </form>
</div>
</body>
</html>