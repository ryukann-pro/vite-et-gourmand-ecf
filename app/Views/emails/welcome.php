<?php
/** @var string $firstName */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue chez Vite & Gourmand</title>
</head>
<body>
    <h1>Bienvenue <?= htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') ?> !</h1>

    <p>Votre compte a bien été créé.</p>

    <p>
        Vous pouvez maintenant consulter nos menus et passer commande.
    </p>
</body>
</html>