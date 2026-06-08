<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-orders-page py-5">

    <section class="container">

        <div class="employee-orders-header mb-5">
            <h1 class="employee-orders-title">Gestion des commandes</h1>
            <p class="employee-orders-text">
                Retrouvez rapidement les commandes par statut ou par client.
            </p>
        </div>

        <div class="employee-orders-card mb-5">

            <h2 class="employee-orders-subtitle mb-4">Filtres</h2>

            <form method="GET" class="row g-4">

                <input type="hidden" name="url" value="employe-commandes">

                <div class="col-12 col-md-6 col-lg-4">
                    <label for="statutFiltre" class="form-label">Statut</label>

                    <select id="statutFiltre" name="statut_id" class="form-select">
                        <option value="0">Tous les statuts</option>
                        <option value="1" <?= ($_GET['statut_id'] ?? '') == 1 ? 'selected' : '' ?>>En attente</option>
                        <option value="2" <?= ($_GET['statut_id'] ?? '') == 2 ? 'selected' : '' ?>>Acceptée</option>
                        <option value="3" <?= ($_GET['statut_id'] ?? '') == 3 ? 'selected' : '' ?>>En préparation</option>
                        <option value="4" <?= ($_GET['statut_id'] ?? '') == 4 ? 'selected' : '' ?>>En cours de livraison
                        </option>
                        <option value="5" <?= ($_GET['statut_id'] ?? '') == 5 ? 'selected' : '' ?>>Livrée</option>
                        <option value="6" <?= ($_GET['statut_id'] ?? '') == 6 ? 'selected' : '' ?>>En attente retour
                            matériel</option>
                        <option value="7" <?= ($_GET['statut_id'] ?? '') == 7 ? 'selected' : '' ?>>Terminée</option>
                        <option value="8" <?= ($_GET['statut_id'] ?? '') == 8 ? 'selected' : '' ?>>Annulée</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label for="clientFiltre" class="form-label">Client</label>

                    <input type="text" id="clientFiltre" name="client" class="form-control"
                        placeholder="Nom, prénom ou email" value="<?= htmlspecialchars($_GET['client'] ?? '') ?>">
                </div>

                <div class="col-12 col-lg-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn employee-orders-btn w-100">
                        Rechercher
                    </button>

                    <a href="index.php?url=employe-commandes" class="btn account-secondary-btn w-100">
                        Réinitialiser
                    </a>
                </div>

            </form>

        </div>

        <div class="employee-orders-card">

            <h2 class="employee-orders-subtitle mb-4">Commandes</h2>

            <div class="table-responsive">

                <table class="table align-middle employee-orders-table">

                    <thead>
                        <tr>
                            <th>Commande</th>
                            <th>Client</th>
                            <th>Menu</th>
                            <th>Date livraison</th>
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
                                    <?= htmlspecialchars($order['prenom_client']) ?>
                                    <?= htmlspecialchars($order['nom_client']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($order['menu_titre']) ?>
                                </td>

                                <td>
                                    <?= date('d/m/Y', strtotime($order['date_livraison'])) ?>
                                </td>

                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <?= htmlspecialchars($order['statut']) ?>
                                    </span>
                                </td>

                                <td>
                                    <?= number_format((float) $order['prix_total'], 2, ',', ' ') ?> €
                                </td>

                                <td class="text-end">
                                    <a href="index.php?url=employe-detail-commande&id=<?= (int) $order['id'] ?>"
                                        class="btn btn-sm account-btn">
                                        Voir
                                    </a>
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