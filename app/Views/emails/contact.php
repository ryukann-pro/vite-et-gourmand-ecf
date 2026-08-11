<?php

/** @var string $lastName */
/** @var string $firstName */
/** @var string $email */
/** @var string|null $phone */
/** @var string $title */
/** @var string $message */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nouvelle demande de contact</title>
</head>

<body>

    <h1>Nouvelle demande de contact</h1>

    <p>
        <strong>Nom :</strong>
        <?= htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p>
        <strong>Prénom :</strong>
        <?= htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') ?>
    </p>

    <p>
        <strong>Email :</strong>
        <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
    </p>

    <?php if ($phone !== null): ?>
        <p>
            <strong>Téléphone :</strong>
            <?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <p>
        <strong>Titre :</strong>
        <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
    </p>

    <h2>Message</h2>

    <p>
        <?= nl2br(
            htmlspecialchars(
                $message,
                ENT_QUOTES,
                'UTF-8'
            )
        ) ?>
    </p>

</body>

</html>