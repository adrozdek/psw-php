<?php
require_once 'connections.php';
$users = require_once 'users.php';
$theme = $_COOKIE['theme'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $theme = $_POST['theme'];
    setcookie('theme', $theme, time() + 2 * 24 * 60 * 60);
}
?>
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
    <form action="" method="POST">
        <label for="theme">Wybierz:</label>
        <select id="theme" name="theme">
            <option value="" <?= $theme == null ? ' selected' : ''; ?>>Wybierz</option>
            <option value="dark" <?= $theme === 'dark' ? ' selected' : ''; ?>>Mroczny</option>
            <option value="light" <?= $theme === 'light' ? ' selected' : ''; ?>>Jasny</option>
            <option value="magical" <?= $theme === 'magical' ? ' selected' : ''; ?>>Magiczny</option>
        </select>
        <button type="submit">Zatwierdź</button>
    </form>
    <form action="form.php" method="POST">
        <div>
            <label for="imie">Imię</label>
            <input id="imie" type="text" name="imie">
        </div>
        <div>
            <label for="nazwisko">Nazwisko</label>
            <input id="nazwisko" type="text" name="nazwisko">
        </div>
        <div>
            <label for="numerek">Szczęśliwy numerek</label>
            <input id="numerek" type="number" name="numerek">
        </div>
        <div>
            <label for="telefon">Telefon</label>
            <input id="telefon" type="text" name="telefon">
        </div>
        <div>
            <fieldset>
                <legend>Wybierz płeć:</legend>
                <input type="radio" name="plec" id="kobieta" value="kobieta">
                <label for="kobieta">Kobieta</label>
                <input type="radio" name="plec" id="mezczyzna" value="mezczyzna">
                <label for="mezczyzna">Mężczyzna</label>
            </fieldset>
        </div>
        <div>
        <textarea name="longText" rows="4" cols="50" maxlength="200"
                  placeholder="Wpisz wiadomość bez używania literki a"></textarea>
        </div>
        <button type="reset">Wyczyść</button>
        <button type="submit">Wyślij</button>
    </form>
</div>
</body>
</html>