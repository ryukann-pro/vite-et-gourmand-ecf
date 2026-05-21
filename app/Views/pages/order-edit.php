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
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <h2 class="order-edit-section-title mb-4">
                    Menu commandé
                </h2>

                <div class="order-edit-summary mb-5">
                    <h3 class="order-edit-menu-title">
                        <?= htmlspecialchars($order['menu_titre']) ?>
                    </h3>
                </div>

                <h2 class="order-edit-section-title mb-4">
                    Informations modifiables
                </h2>

                <div class="mb-4">
                    <label for="adresseLivraison" class="form-label">
                        Adresse de livraison
                    </label>

                    <input
                        type="text"
                        id="adresseLivraison"
                        name="adresse_livraison"
                        class="form-control"
                        value="<?= htmlspecialchars($order['adresse_livraison']) ?>"
                        required
                    >
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <label for="villeLivraison" class="form-label">
                            Ville de livraison
                        </label>

                        <select
                            id="villeLivraison"
                            name="ville_id"
                            class="form-select"
                            required
                        >
                            <?php foreach ($cities as $city): ?>
                                <option
                                    value="<?= (int) $city['id'] ?>"
                                    <?= (int) $city['id'] === (int) $order['ville_id'] ? 'selected' : '' ?>
                                >
                                    <?= htmlspecialchars($city['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="nbPersonnes" class="form-label">
                            Nombre de personnes
                        </label>

                        <input
                            type="number"
                            id="nbPersonnes"
                            name="nb_personnes"
                            class="form-control"
                            value="<?= (int) $order['nb_personnes'] ?>"
                            min="1"
                            required
                        >
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <label for="dateLivraison" class="form-label">
                            Date de livraison
                        </label>

                        <input
                            type="date"
                            id="dateLivraison"
                            name="date_livraison"
                            class="form-control"
                            value="<?= htmlspecialchars($order['date_livraison']) ?>"
                            min="<?= date('Y-m-d') ?>"
                            required
                        >
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="heureLivraison" class="form-label">
                            Heure souhaitée
                        </label>

                        <select
                            id="heureLivraison"
                            name="heure_livraison"
                            class="form-select"
                            required
                        >
                            <?php
                            $selectedHour = substr($order['heure_livraison'], 0, 5);
                            $hours = [
                                '07:30', '08:00', '08:30', '09:00', '09:30',
                                '10:00', '10:30', '11:00', '11:30', '12:00',
                                '12:30', '13:00', '13:30', '14:00', '14:30',
                                '15:00', '15:30', '16:00', '16:30', '17:00',
                                '17:30', '18:00', '18:30'
                            ];
                            ?>

                            <?php foreach ($hours as $hour): ?>
                                <option
                                    value="<?= $hour ?>"
                                    <?= $selectedHour === $hour ? 'selected' : '' ?>
                                >
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
                        <?= $order['pret_materiel'] ? 'checked' : '' ?>
                    >

                    <label
                        class="form-check-label"
                        for="pretMaterielEdit"
                    >
                        Demander un prêt de matériel
                    </label>
                </div>

                <div class="order-edit-actions">
                    <button type="submit" class="btn order-edit-btn">
                        Enregistrer les modifications
                    </button>

                    <a
                        href="index.php?url=detail-commande&id=<?= (int) $order['id'] ?>"
                        class="btn account-secondary-btn"
                    >
                        Retour au détail
                    </a>
                </div>

            </form>

        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>