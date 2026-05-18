<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-reviews-page py-5">
    <section class="container">

        <div class="employee-reviews-header mb-5">
            <h1 class="employee-reviews-title">Gestion des avis clients</h1>
            <p class="employee-reviews-text">
                Validez ou refusez les avis reçus avant leur affichage sur la page d’accueil.
            </p>
        </div>

        <div class="employee-reviews-card">

            <h2 class="employee-reviews-subtitle mb-4">Avis en attente</h2>

            <div class="row g-4">

                <div class="col-12 col-lg-6">
                    <article class="employee-review-item">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <div>
                                <h3>Julie Dupont</h3>
                                <p class="employee-review-menu mb-0">Menu : Buffet Signature Réception</p>
                            </div>

                            <span class="badge bg-warning text-dark">En attente</span>
                        </div>

                        <div class="employee-review-stars mb-3">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>

                        <p class="employee-review-comment">
                            Très bonne prestation, plats savoureux et livraison à l’heure.
                        </p>

                        <div class="employee-review-actions">
                            <button class="btn employee-review-validate-btn">
                                Valider
                            </button>

                            <button class="btn employee-review-refuse-btn">
                                Refuser
                            </button>
                        </div>
                    </article>
                </div>

                <div class="col-12 col-lg-6">
                    <article class="employee-review-item">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <div>
                                <h3>Lucas Martin</h3>
                                <p class="employee-review-menu mb-0">Menu : Menu Festif Traditionnel</p>
                            </div>

                            <span class="badge bg-warning text-dark">En attente</span>
                        </div>

                        <div class="employee-review-stars mb-3">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </div>

                        <p class="employee-review-comment">
                            Bon menu, très généreux. Quelques minutes de retard mais prestation sérieuse.
                        </p>

                        <div class="employee-review-actions">
                            <button class="btn employee-review-validate-btn">
                                Valider
                            </button>

                            <button class="btn employee-review-refuse-btn">
                                Refuser
                            </button>
                        </div>
                    </article>
                </div>

            </div>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>