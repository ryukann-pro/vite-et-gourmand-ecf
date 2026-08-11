<?php
/** @var array $order */
?>

<h1>
    Bonjour <?= htmlspecialchars(
        $order['prenom_client'],
        ENT_QUOTES,
        'UTF-8'
    ) ?>,
</h1>

<p>
    Votre commande est maintenant en attente du retour du matériel prêté.
</p>

<p>
    Merci de prendre contact avec Vite & Gourmand afin d’organiser sa restitution.
</p>

<p>
    Le matériel doit être restitué dans un délai de 10 jours ouvrés.
</p>

<p>
    Passé ce délai, des frais de 600 € pourront être appliqués conformément aux conditions générales de vente.
</p>