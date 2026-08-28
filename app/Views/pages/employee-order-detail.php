<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-order-detail-page py-5">
    <section class="container">

        <div class="employee-order-detail-card">

            <h1 class="employee-order-detail-title mb-5">
                Détail commande #CMD-<?= (int) $order['id'] ?>
            </h1>

            <div class="row g-4 mb-5">
                <div class="col-12 col-lg-6">
                    <div class="employee-order-info-box h-100">
                        <h2>Informations client</h2>

                        <p>
                            <strong>Client :</strong>
                            <?= htmlspecialchars($order['prenom_client']) ?>
                            <?= htmlspecialchars($order['nom_client']) ?>
                        </p>

                        <p>
                            <strong>Email :</strong>
                            <?= htmlspecialchars($order['email_client']) ?>
                        </p>

                        <p>
                            <strong>Téléphone :</strong>
                            <?= htmlspecialchars($order['telephone_client']) ?>
                        </p>

                        <p>
                            <strong>Adresse :</strong>
                            <?= htmlspecialchars($order['adresse_livraison']) ?>,
                            <?= htmlspecialchars($order['ville']) ?>
                        </p>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="employee-order-info-box h-100">
                        <h2>Informations commande</h2>

                        <p>
                            <strong>Menu :</strong>
                            <?= htmlspecialchars($order['menu_titre']) ?>
                        </p>

                        <p>
                            <strong>Date livraison :</strong>
                            <?= date('d/m/Y', strtotime($order['date_livraison'])) ?>
                            à
                            <?= htmlspecialchars(substr($order['heure_livraison'], 0, 5)) ?>
                        </p>

                        <p>
                            <strong>Nombre de personnes :</strong>
                            <?= (int) $order['nb_personnes'] ?>
                        </p>

                        <p>
                            <strong>Total :</strong>
                            <?= number_format((float) $order['prix_total'], 2, ',', ' ') ?> €
                        </p>

                        <p>
                            <strong>Prêt matériel :</strong>
                            <?= $order['pret_materiel'] ? 'Oui' : 'Non' ?>
                        </p>

                        <p>
                            <strong>Statut :</strong>
                            <?= htmlspecialchars($order['statut']) ?>
                        </p>
                    </div>
                </div>
            </div>

            <?php
            $currentStatus = (int) $order['statut_id'];
            $hasEquipmentLoan = (bool) $order['pret_materiel'];

            $nextStatuses = [
                1 => [2 => 'Acceptée'],
                2 => [3 => 'En préparation'],
                3 => [4 => 'En cours de livraison'],
                4 => [5 => 'Livrée'],
                6 => [7 => 'Terminée']
            ];

            if ($currentStatus === 5) {
                if ($hasEquipmentLoan) {
                    $nextStatuses[5] = [6 => 'En attente retour matériel'];
                } else {
                    $nextStatuses[5] = [7 => 'Terminée'];
                }
            }

            $availableStatuses = $nextStatuses[$currentStatus] ?? [];
            ?>

            <?php if (!in_array((int) $order['statut_id'], [7, 8])): ?>

                <div class="employee-order-section mb-5">

                    <h2 class="employee-order-section-title mb-4">
                        Mise à jour du statut
                    </h2>

                    <form method="POST">

                        <div class="row g-4">

                            <div class="col-12 col-lg-8">

                                <label for="statut_id" class="form-label">
                                    Nouveau statut
                                </label>

                                <select
                                    id="statut_id"
                                    class="form-select"
                                    name="statut_id">

                                    <?php foreach ($availableStatuses as $statusId => $statusLabel): ?>
                                        <option value="<?= $statusId ?>">
                                            <?= $statusLabel ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <div class="col-12 col-lg-4 d-flex align-items-end">
                                <button
                                    type="submit"
                                    class="btn employee-order-btn w-100">
                                    Mettre à jour
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            <?php else: ?>

                <div class="alert alert-secondary">
                    Cette commande est clôturée et ne peut plus changer de statut.
                </div>

            <?php endif; ?>

            <?php if (in_array((int) $order['statut_id'], [1, 2, 3])): ?>

                <div class="employee-order-section mb-5">

                    <h2 class="employee-order-section-title mb-4">
                        Annulation de commande
                    </h2>

                    <div class="alert alert-warning">
                        Avant toute annulation, le client doit être contacté par téléphone ou par email.
                    </div>

                    <form method="POST">

                        <div class="row g-4">

                            <div class="col-12 col-md-6">

                                <label for="mode_contact" class="form-label">
                                    Mode de contact
                                </label>

                                <select
                                    id="mode_contact"
                                    class="form-select"
                                    name="mode_contact"
                                    required>

                                    <option value="">Choisir</option>
                                    <option value="telephone">Téléphone</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">

                                <label for="client_contacte" class="form-label">
                                    Client contacté ?
                                </label>

                                <select
                                    id="client_contacte"
                                    class="form-select"
                                    name="client_contacte"
                                    required>

                                    <option value="">Choisir</option>
                                    <option value="oui">Oui</option>
                                    <option value="non">Non</option>
                                </select>
                            </div>

                            <div class="col-12">

                                <label for="motif_annulation" class="form-label">
                                    Motif d’annulation
                                </label>

                                <textarea
                                    id="motif_annulation"
                                    class="form-control"
                                    name="motif_annulation"
                                    rows="5"
                                    required></textarea>
                            </div>

                            <div class="col-12">
                                <button
                                    type="submit"
                                    name="cancel_order"
                                    class="btn employee-order-danger-btn">
                                    Annuler la commande
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            <?php endif; ?>

            <div class="employee-order-section">

                <h2 class="employee-order-section-title mb-4">
                    Historique du suivi
                </h2>

                <ul class="employee-order-tracking-list">

                    <?php foreach ($tracking as $track): ?>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>

                            <span>
                                <?= htmlspecialchars($track['statut']) ?>
                                —
                                <?= date('d/m/Y H:i', strtotime($track['date_changement'])) ?>
                            </span>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>