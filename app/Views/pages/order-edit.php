<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="order-edit-page py-5">
    <section class="container">

        <div class="order-edit-card">

            <h1 class="order-edit-title mb-5">
                Modifier la commande #CMD-<?= (int) $order['id'] ?>
            </h1>

            <div class="alert alert-warning order-edit-warning mb-5">
                Le menu choisi ne peut pas être modifié.
                Pour changer de menu, veuillez annuler cette commande et en créer une nouvelle.
            </div>

            <form method="POST">

                <?php if ($error): ?>
                    <div class="alert alert-danger mb-4">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <?php
                $selectedHour = substr($order['heure_livraison'], 0, 5);
                $maxPersonnes =
                    (int) $order['menu_stock']
                    + (int) $order['nb_personnes'];

                $hours = [
                    '07:30',
                    '08:00',
                    '08:30',
                    '09:00',
                    '09:30',
                    '10:00',
                    '10:30',
                    '11:00',
                    '11:30',
                    '12:00',
                    '12:30',
                    '13:00',
                    '13:30',
                    '14:00',
                    '14:30',
                    '15:00',
                    '15:30',
                    '16:00',
                    '16:30',
                    '17:00',
                    '17:30',
                    '18:00',
                    '18:30'
                ];
                ?>

                <div class="row g-5">

                    <!-- COLONNE GAUCHE -->
                    <div class="col-12 col-lg-7">

                        <h2 class="order-edit-section-title mb-4">
                            Informations modifiables
                        </h2>

                        <div class="mb-4">
                            <label
                                for="adresseLivraison"
                                class="form-label">
                                Adresse de livraison
                            </label>

                            <input
                                type="text"
                                id="adresseLivraison"
                                name="adresse_livraison"
                                class="form-control"
                                value="<?= htmlspecialchars($order['adresse_livraison']) ?>"
                                required>
                        </div>

                        <div class="row">

                            <div class="col-12 col-md-6 mb-4">
                                <label
                                    for="villeLivraison"
                                    class="form-label">
                                    Ville de livraison
                                </label>

                                <select
                                    id="villeLivraison"
                                    name="ville_id"
                                    class="form-select"
                                    required>
                                    <?php foreach ($cities as $city): ?>
                                        <option
                                            value="<?= (int) $city['id'] ?>"
                                            data-distance="<?= (float) $city['distance_km'] ?>"
                                            <?= (int) $city['id'] === (int) $order['ville_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($city['nom']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label
                                    for="nbPersonnes"
                                    class="form-label">
                                    Nombre de personnes
                                </label>

                                <input
                                    type="number"
                                    id="nbPersonnes"
                                    name="nb_personnes"
                                    class="form-control"
                                    value="<?= (int) $order['nb_personnes'] ?>"
                                    min="<?= (int) $order['menu_nb_personnes_min'] ?>"
                                    max="<?= $maxPersonnes ?>"
                                    required>

                                <small class="text-muted">
                                    Minimum <?= (int) $order['menu_nb_personnes_min'] ?> personnes —
                                    Maximum <?= $maxPersonnes ?> personnes disponibles
                                </small>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-12 col-md-6 mb-4">
                                <label
                                    for="dateLivraison"
                                    class="form-label">
                                    Date de livraison
                                </label>

                                <input
                                    type="date"
                                    id="dateLivraison"
                                    name="date_livraison"
                                    class="form-control"
                                    value="<?= htmlspecialchars($order['date_livraison']) ?>"
                                    min="<?= date('Y-m-d') ?>"
                                    required>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label
                                    for="heureLivraison"
                                    class="form-label">
                                    Heure souhaitée
                                </label>

                                <select
                                    id="heureLivraison"
                                    name="heure_livraison"
                                    class="form-select"
                                    required>
                                    <?php foreach ($hours as $hour): ?>
                                        <option
                                            value="<?= $hour ?>"
                                            <?= $selectedHour === $hour ? 'selected' : '' ?>>
                                            <?= $hour ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>

                        <div class="form-check mb-5">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="pretMaterielEdit"
                                name="pret_materiel"
                                <?= $order['pret_materiel'] ? 'checked' : '' ?>>

                            <label
                                class="form-check-label"
                                for="pretMaterielEdit">
                                Demander un prêt de matériel
                            </label>
                        </div>

                        <div class="order-edit-actions">

                            <button
                                type="submit"
                                class="btn order-edit-btn">
                                Enregistrer les modifications
                            </button>

                            <a
                                href="index.php?url=detail-commande&id=<?= (int) $order['id'] ?>"
                                class="btn account-secondary-btn">
                                Retour au détail
                            </a>

                        </div>

                    </div>

                    <!-- COLONNE DROITE -->
                    <div class="col-12 col-lg-5">

                        <div class="order-edit-summary">

                            <h2 class="order-edit-section-title mb-4">
                                Résumé de la commande
                            </h2>

                            <h3 class="order-edit-menu-title mb-4">
                                <?= htmlspecialchars($order['menu_titre']) ?>
                            </h3>

                            <div
                                id="prixUnitaire"
                                data-prix="<?= (float) $order['prix_unitaire'] ?>"
                                data-minimum="<?= (int) $order['menu_nb_personnes_min'] ?>"></div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>
                                    Prix par personne
                                </span>

                                <strong>
                                    <?= number_format(
                                        (float) $order['prix_unitaire'],
                                        2,
                                        ',',
                                        ' '
                                    ) ?> €
                                </strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>
                                    Nombre de personnes
                                </span>

                                <strong id="resumeNbPersonnes"></strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>
                                    Sous-total
                                </span>

                                <strong id="resumeSousTotal"></strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>
                                    Réduction
                                </span>

                                <strong id="resumeReduction"></strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>
                                    Livraison
                                </span>

                                <strong id="resumeLivraison"></strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <span class="fs-5">
                                    Total
                                </span>

                                <strong
                                    id="resumeTotal"
                                    class="fs-4"></strong>

                            </div>

                            <div class="text-muted">

                                <p class="mb-2">
                                    Une réduction de 10% est appliquée à partir de
                                    <?= (int) $order['menu_nb_personnes_min'] + 5 ?>
                                    personnes.
                                </p>

                                <p class="mb-0">
                                    Livraison : 5 € + 0,59 €/km hors Bordeaux.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>
</main>

<script src="<?= BASE_URL ?>/assets/js/order-summary.js"></script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>