<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
$prixUnitaire = (float) $menu['prix_par_personne'];
$nbPersonnesMin = (int) $menu['nb_personnes_min'];
$sousTotal = $prixUnitaire * $nbPersonnesMin;
$reduction = 0;
$fraisLivraison = 5;
$total = $sousTotal - $reduction + $fraisLivraison;
?>

<main class="order-page py-5">
    <section class="container">
        <div class="order-card">

            <h1 class="order-title mb-5">Commander un menu</h1>

            <div class="row g-5">

                <div class="col-12 col-lg-7">
                    <form method="post">

                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <h2 class="order-section-title mb-4">Informations client</h2>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <label for="nomClient" class="form-label">Nom</label>
                                <input type="text" id="nomClient" name="nom_client" class="form-control"
                                    value="<?= htmlspecialchars($_SESSION['user']['nom']) ?>" required>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label for="prenomClient" class="form-label">Prénom</label>
                                <input type="text" id="prenomClient" name="prenom_client" class="form-control"
                                    value="<?= htmlspecialchars($_SESSION['user']['prenom']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="emailClient" class="form-label">Adresse email</label>
                            <input type="email" id="emailClient" name="email_client" class="form-control"
                                value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" maxlength="191" required>
                        </div>

                        <div class="mb-5">
                            <label for="telephoneClient" class="form-label">Téléphone</label>
                            <input type="tel" id="telephoneClient" name="telephone_client" class="form-control"
                                pattern="^0[1-9][0-9]{8}$"
                                title="Veuillez entrer un numéro français valide à 10 chiffres."
                                placeholder="0612345678" required>
                        </div>

                        <h2 class="order-section-title mb-4">Informations de prestation</h2>

                        <div class="mb-4">
                            <label for="adresseLivraison" class="form-label">Adresse de livraison</label>
                            <input type="text" id="adresseLivraison" name="adresse_livraison" class="form-control"
                                placeholder="Adresse de la prestation" required>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <label for="villeLivraison" class="form-label">Ville de livraison</label>
                                <select id="villeLivraison" name="ville_id" class="form-select" required>
                                    <option value="1">Bordeaux</option>
                                    <option value="2">Mérignac</option>
                                    <option value="3">Pessac</option>
                                    <option value="4">Talence</option>
                                    <option value="5">Bègles</option>
                                    <option value="6">Cenon</option>
                                    <option value="7">Lormont</option>
                                    <option value="8">Le Bouscat</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label for="nbPersonnes" class="form-label">Nombre de personnes</label>
                                <input type="number" id="nbPersonnes" name="nb_personnes" class="form-control"
                                    value="<?= $nbPersonnesMin ?>" min="<?= $nbPersonnesMin ?>" required>
                                <small class="order-help">
                                    Minimum <?= $nbPersonnesMin ?> personnes pour ce menu
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <label for="dateLivraison" class="form-label">Date de livraison</label>
                                <input type="date" id="dateLivraison" name="date_livraison" class="form-control"
                                    min="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label for="heureLivraison" class="form-label">Heure souhaitée</label>
                                <select id="heureLivraison" name="heure_livraison" class="form-select" required>
                                    <option value="07:30">07:30</option>
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="pretMateriel" name="pret_materiel">
                            <label class="form-check-label" for="pretMateriel">
                                Demander un prêt de matériel
                            </label>
                        </div>

                        <button type="submit" class="btn order-btn w-100">
                            Valider la commande
                        </button>

                    </form>
                </div>

                <div class="col-12 col-lg-5">
                    <aside class="order-summary">

                        <h2 class="order-summary-title mb-4">Résumé de la commande</h2>

                        <img src="/vite-et-gourmand-ecf/public/<?= htmlspecialchars($images[0]['url'] ?? '') ?>"
                            alt="<?= htmlspecialchars($menu['titre']) ?>" class="order-summary-img mb-4">

                        <h3 class="order-menu-title">
                            <?= htmlspecialchars($menu['titre']) ?>
                        </h3>

                        <p class="order-menu-description">
                            <?= htmlspecialchars($menu['description_longue']) ?>
                        </p>

                        <div class="order-summary-info mt-4">

                            <div class="d-flex justify-content-between mb-2">
                                <span>Prix par personne</span>
                                <strong><?= number_format($prixUnitaire, 2, ',', ' ') ?> €</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Nombre de personnes</span>
                                <strong><?= $nbPersonnesMin ?></strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Sous-total menu</span>
                                <strong><?= number_format($sousTotal, 2, ',', ' ') ?> €</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Réduction</span>
                                <strong>- <?= number_format($reduction, 2, ',', ' ') ?> €</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Livraison</span>
                                <strong><?= number_format($fraisLivraison, 2, ',', ' ') ?> €</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span>Total</span>
                                <strong class="order-total">
                                    <?= number_format($total, 2, ',', ' ') ?> €
                                </strong>
                            </div>

                        </div>

                        <div class="order-note mt-4">
                            <p class="mb-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Une réduction de 10% est appliquée à partir de 5 personnes au-dessus du minimum.
                            </p>

                            <p class="mb-0">
                                <i class="bi bi-truck me-2"></i>
                                Livraison : 5 € + 0,59 €/km hors Bordeaux.
                            </p>
                        </div>

                    </aside>
                </div>

            </div>

        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>