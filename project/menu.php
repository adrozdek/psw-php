<nav class="menu">
    <a href="index.php">Formularz dla wszystkich</a>
    <?php if (isset($_SESSION['userId'])): ?>
        <a href="longForm.php">Długi formularz dla zalogowanych</a>
        <a href="longForm.php">Profil</a>
        <a href="logout.php">Wyloguj</a>
        Witaj <?= ucfirst($users[array_search($_SESSION['userId'], array_column($users, 'id'))]['login']); ?>
    <?php else: ?>
        <a href="login.php">Zaloguj się</a>
    <?php endif; ?>
</nav>