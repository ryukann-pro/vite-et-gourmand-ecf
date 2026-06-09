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

            <?php if (empty($reviews)): ?>

                <div class="alert alert-success mb-0">
                    Aucun avis en attente de validation.
                </div>

            <?php else: ?>

                <div class="row g-4">

                    <?php foreach ($reviews as $review): ?>

                        <div class="col-12 col-lg-6">
                            <article class="employee-review-item">

                                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                    <div>
                                        <h3>
                                            <?= htmlspecialchars($review['prenom']) ?>
                                            <?= htmlspecialchars($review['nom']) ?>
                                        </h3>

                                        <p class="employee-review-menu mb-0">
                                            Commande #CMD-<?= (int) $review['commande_id'] ?>
                                        </p>
                                    </div>

                                    <span class="badge bg-warning text-dark">En attente</span>
                                </div>

                                <div class="employee-review-stars mb-3">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= (int) $review['note']): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php else: ?>
                                            <i class="bi bi-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>

                                <p class="employee-review-comment">
                                    <?= nl2br(htmlspecialchars($review['commentaire'])) ?>
                                </p>

                                <div class="employee-review-actions">
                                    <a href="index.php?url=valider-avis&id=<?= (int) $review['id'] ?>"
                                        class="btn employee-review-validate-btn">
                                        Valider
                                    </a>

                                    <a href="index.php?url=supprimer-avis&id=<?= (int) $review['id'] ?>"
                                        class="btn employee-review-refuse-btn"
                                        onclick="return confirm('Voulez-vous vraiment refuser cet avis ?')">
                                        Refuser
                                    </a>
                                </div>

                            </article>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>