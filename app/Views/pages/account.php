<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="account-page py-5">
    <section class="container">

        <div class="account-card mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <h1 class="account-title mb-0">Mon compte</h1>

                <a href="index.php?url=modifier-profil" class="btn account-btn">
                    Modifier mes informations
                </a>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="account-info-box h-100">
                        <h2 class="account-subtitle mb-3">Informations personnelles</h2>
                        <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
                        <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
                        <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
                        <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['telephone'] ?? '') ?></p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="account-info-box h-100">
                        <h2 class="account-subtitle mb-3">Adresse</h2>

<?= htmlspecialchars($user['adresse'] ?? '') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="account-card">
            <h2 class="account-subtitle mb-4">Mes commandes</h2>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Commande</th>
                            <th>Date</th>
                            <th>Menu</th>
                            <th>Statut</th>
                            <th>Total</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#CMD-
                                    <?= (int) $order['id'] ?>
                                </td>

                                <td>
                                    <?= date('d/m/Y', strtotime($order['date_creation'])) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($order['menu_titre']) ?>
                                </td>

                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <?= htmlspecialchars($order['statut']) ?>
                                    </span>
                                </td>

                                <td>
                                    <?= number_format((float) $order['prix_total'], 2, ',', ' ') ?> €
                                </td>

                                <td>
                                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                                        <a href="index.php?url=detail-commande&id=<?= (int) $order['id'] ?>"
                                            class="btn btn-sm account-btn">
                                            Voir
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>