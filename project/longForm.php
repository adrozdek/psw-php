<?php require_once 'connections.php'; ?>
<?php
$users = require_once 'users.php';
if (!isset($_SESSION['userId']) || array_search($_SESSION['userId'], array_column($users, 'id')) === false) {
    header('Location: login.php');
} ?>
<?php $animals = require_once 'animals.php'; ?>
<?php $transports = require_once 'transport.php'; ?>
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
    <form action="form.php" method="POST">
        <input name="type" type="text" value="long" hidden>
        <div>
            <label for="imie">Imię</label>
            <input id="imie" type="text" pattern="^[A-Z][a-z]+$" name="imie">
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
            <label for="owoc">Ulubiony owoc</label>
            <input id="owoc" type="text" name="owoc">
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
            <textarea rows="4" cols="50" maxlength="200" placeholder="Wpisz wiadomość"></textarea>
        </div>
        <div>
            <label for="zwierzatka">Wybierz które zwierzątka lubisz:</label>
            <select id="zwierzatka" name="zwierzatka" multiple>
                <?php foreach ($animals as $key => $animal): ?>
                    <option value="<?= $key; ?>"><?= $animal; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            Wybierz jakie środki transportu lubisz:
            <?php foreach ($transports as $key => $transport): ?>
                <input name="transport[]" id="<?= $key; ?>" type="checkbox" value="<?= $key; ?>">
                <label for="<?= $key; ?>"><?= $transport; ?></label>
            <?php endforeach; ?>
        </div>
        <button type="reset">Wyczyść</button>
        <button type="submit">Wyślij</button>
    </form>
</div>
</body>
</html>