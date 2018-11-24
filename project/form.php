<?php
require_once 'connections.php';
$trueFruits = require_once 'fruits.php';
$replace = ['a' => 'z', 'b' => 'm', 'r' => 'g', 'c' => 'i', 'm' => 'h', 's' => 'r', 't' => 'e', 'u' => 'p'];

$happyNumber = 0;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isLongVersion = $_POST['type'] === 'long';
    $firstName = $_POST['imie'];
    if (strcasecmp($firstName, 'Superdługieimie') > 0) {
        die('Tak długie imię jest niemożliwe oszukisto');
    }
    if (strncasecmp(ucfirst($firstName), 'A', 1) === 0 ||
        strncasecmp(ucfirst($firstName), 'N', 1) === 0) {
        echo 'Jak słodko! Twoje imię zaczyna się tak samo jak jednej z autorek.';
    }
    $lastName = $_POST['nazwisko'];
    if (strlen($lastName) > 0 && $lastName === mb_strtolower($lastName)) {
        $errors[] = 'Nazwisko z małej litery?';
    }
    if (preg_match('/^\p{Ll}/u', $lastName)) {
        $errors[] = 'Nazwisko z małej litery? (preg matchem)';
    }
    if ($isLongVersion) {
        $happyNumber = (int)$_POST['numerek'];
        if ($happyNumber < 0 || $happyNumber > 50) {
            $errors[] = 'Szczęśliwy numerek może być tylko 0-50! - Bo tak.';
        }
        $chosenFruit = $_POST['owoc'];
        if (!in_array($chosenFruit, $trueFruits)) {
            $errors[] = 'Twój owoc nie jest dobry! Rozszyfruj listę.';
        }
    } else {
        if ($aMatches = preg_match_all('/a/i', $_POST['longText'])) {
            $errors[] = 'Twój tekst zawiera aż ' . $aMatches . ' a!!!';
        }
    }
}
echo 'IP ' . $_SERVER['REMOTE_ADDR'];

$trueFruits = preg_replace('/w/i', 'l', $trueFruits);
function getLetterRegex($element)
{
    return '/' . $element . '/i';
}

?>
<?php $theme = $_COOKIE['theme']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formularz</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class="<?= $theme; ?>">
<div class="content">

    <?php if (!empty($errors)) : ?>
        <div style="background-color: black; color: red; font-size: 25px; width: 100%; height: 90%;">
            <h1>Błędy!!!</h1>
            <ul style="list-style: none">
                Aż <?= count($errors); ?>:
                <?php while ($error = current($errors)): ?>
                    <li><?= key($errors) + 1 . ' - ' . mb_strtoupper($error); ?></li>
                    <?php next($errors); ?>
                <?php endwhile; ?>
            </ul>
            <p>No ale ten pierwszy błąd? Jak można: <?= reset($errors); ?></p>
            <p>
                <a style="color: pink; font-size: 30px; font-weight: bold" href="index.php">Spróbuj jeszcze raz</a>
            </p>
        </div>
        <p>Dobre owocki:</p>
        <ul>
            <?php foreach ($trueFruits as $trueFruit): ?>
                <li><?= preg_replace(array_map('getLetterRegex', array_keys($replace)), array_values($replace), $trueFruit); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php for ($i = 1; $i <= $happyNumber; $i++): ?>
            <?= $i . '  '; ?>
        <?php endfor; ?>
    <?php else: ?>
        <p>Wysłano!</p>
        <p style="color: pink; font-size: 30px; font-weight: bold">
            <a style="color: pink; font-size: 30px; font-weight: bold" href="index.php">
                Wyślij jeszcze raz jak nie masz co robić - krótki
            </a>
            <br>
            <a style="color: pink; font-size: 30px; font-weight: bold" href="longForm.php">
                Wyślij jeszcze raz jak nie masz co robić - długi
            </a>
        </p>
    <?php endif; ?>
</div>
</body>
</html>
