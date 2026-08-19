    <?php

/** @var string $firstName */
/** @var string $resetLink */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réinitialisation de votre mot de passe</title>
</head>

<body>

    <h1>
        Bonjour <?= htmlspecialchars(
            $firstName,
            ENT_QUOTES,
            'UTF-8'
        ) ?>,
    </h1>

    <p>
        Une demande de réinitialisation de votre mot de passe a été effectuée.
    </p>

    <p>
        Vous pouvez choisir un nouveau mot de passe en cliquant sur le lien ci-dessous :
    </p>

    <p>
        <a href="<?= htmlspecialchars(
            $resetLink,
            ENT_QUOTES,
            'UTF-8'
        ) ?>">
            Réinitialiser mon mot de passe
        </a>
    </p>

    <p>
        Ce lien est valable pendant 1 heure.
    </p>

    <p>
        Si vous n’êtes pas à l’origine de cette demande, vous pouvez ignorer cet email.
    </p>

</body>

</html>