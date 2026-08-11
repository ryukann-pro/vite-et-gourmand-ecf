<?php

/** @var array $order */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Confirmation de votre commande</title>
</head>

<body>

    <h1>
        Bonjour <?= htmlspecialchars($order['prenom_client'], ENT_QUOTES, 'UTF-8') ?>,
    </h1>

    <p>
        Votre commande a bien été enregistrée.
    </p>

    <p>
        Elle est actuellement en attente de validation.
    </p>

    <h2>Récapitulatif</h2>

    <ul>
        <li><strong>Commande :</strong> #<?= $order['id'] ?></li>
        <li><strong>Menu :</strong> <?= htmlspecialchars($order['menu_titre'], ENT_QUOTES, 'UTF-8') ?></li>
        <li><strong>Nombre de personnes :</strong> <?= $order['nb_personnes'] ?></li>
        <li><strong>Date de livraison :</strong> <?= date('d/m/Y', strtotime($order['date_livraison'])) ?></li>
        <li><strong>Heure :</strong> <?= substr($order['heure_livraison'], 0, 5) ?></li>
        <li><strong>Adresse :</strong> <?= htmlspecialchars($order['adresse_livraison'], ENT_QUOTES, 'UTF-8') ?></li>
        <li><strong>Ville :</strong> <?= htmlspecialchars($order['ville'], ENT_QUOTES, 'UTF-8') ?></li>
        <li><strong>Montant total :</strong> <?= number_format($order['prix_total'], 2, ',', ' ') ?> €</li>
        <li>
            <strong>Prêt de matériel :</strong>
            <?= $order['pret_materiel'] ? 'Oui' : 'Non' ?>
        </li>
    </ul>
    <p>
        Nous vous informerons par e-mail dès que votre commande sera validée.
    </p>

    <p>
        Merci pour votre confiance et à bientôt chez Vite & Gourmand !
    </p>

</body>

</html>