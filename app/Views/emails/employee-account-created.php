<?php

/** @var string $firstName */
/** @var string $email */

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre compte employé a été créé</title>
</head>
<body>

    <h1>
        Bonjour <?= htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') ?>,
    </h1>

    <p>
        Un compte employé Vite & Gourmand a été créé pour vous.
    </p>

    <p>
        <strong>Adresse de connexion :</strong>
        <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p>
        Votre mot de passe initial vous sera communiqué séparément par l’administrateur.
    </p>

    <p>
        Pour des raisons de sécurité, votre mot de passe n’est pas communiqué dans cet email.
    </p>

</body>
</html>