<?php

/** @var array $order */
/** @var string $reviewLink */

?>

<h1>Merci pour votre commande !</h1>

<p>
    Bonjour
    <?= htmlspecialchars(
        $order['prenom_client'],
        ENT_QUOTES,
        'UTF-8'
    ) ?>,
</p>

<p>
    Votre commande est maintenant terminée.
</p>

<p>
    <a href="<?= htmlspecialchars(
        $reviewLink,
        ENT_QUOTES,
        'UTF-8'
    ) ?>">
        Laisser un avis
    </a>
</p>