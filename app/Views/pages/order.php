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
                    <form>

                        <h2 class="order-section-title mb-4">Informations client</h2>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control" value="Dupont">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-control" value="Julie">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Adresse email</label>
                            <input type="email" class="form-control" value="julie.dupont@test.fr">
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" value="06 00 00 00 00">
                        </div>

                        <h2 class="order-section-title mb-4">Informations de prestation</h2>

                        <div class="mb-4">
                            <label class="form-label">Adresse de livraison</label>
                            <input type="text" class="form-control" placeholder="Adresse de la prestation">
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Ville de livraison</label>
                                <select class="form-select">
                                    <option>Bordeaux</option>
                                    <option>Mérignac</option>
                                    <option>Pessac</option>
                                    <option>Talence</option>
                                    <option>Bègles</option>
                                    <option>Cenon</option>
                                    <option>Lormont</option>
                                    <option>Le Bouscat</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Nombre de personnes</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    value="<?= $nbPersonnesMin ?>"
                                    min="<?= $nbPersonnesMin ?>"
                                >
                                <small class="order-help">
                                    Minimum <?= $nbPersonnesMin ?> personnes pour ce menu
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Date de livraison</label>
                                <input type="date" class="form-control">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Heure souhaitée</label>
                                <select class="form-select">
                                    <option>07:30</option>
                                    <option>08:00</option>
                                    <option>08:30</option>
                                    <option>09:00</option>
                                    <option>09:30</option>
                                    <option>10:00</option>
                                    <option>10:30</option>
                                    <option>11:00</option>
                                    <option>11:30</option>
                                    <option>12:00</option>
                                    <option>12:30</option>
                                    <option>13:00</option>
                                    <option>13:30</option>
                                    <option>14:00</option>
                                    <option>14:30</option>
                                    <option>15:00</option>
                                    <option>15:30</option>
                                    <option>16:00</option>
                                    <option>16:30</option>
                                    <option>17:00</option>
                                    <option>17:30</option>
                                    <option>18:00</option>
                                    <option>18:30</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="pretMateriel">
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

                        <img
                            src="/vite-et-gourmand-ecf/public/<?= htmlspecialchars($images[0]['url'] ?? '') ?>"
                            alt="<?= htmlspecialchars($menu['titre']) ?>"
                            class="order-summary-img mb-4"
                        >

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