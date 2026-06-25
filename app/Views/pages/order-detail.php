<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="order-detail-page py-5">

    <section class="container">

        <div class="order-detail-card">

            <h1 class="order-detail-title mb-5">
                Détail de la commande #CMD-
                <?= (int) $order['id'] ?>
            </h1>

            <div class="order-detail-info">
                <p><strong>Menu :</strong>
                    <?= htmlspecialchars($order['menu_titre']) ?>
                </p>
                <p><strong>Date de commande :</strong>
                    <?= date('d/m/Y à H:i', strtotime($order['date_creation'])) ?>
                </p>
                <p><strong>Date de livraison :</strong>
                    <?= date('d/m/Y', strtotime($order['date_livraison'])) ?> à
                    <?= htmlspecialchars(substr($order['heure_livraison'], 0, 5)) ?>
                </p>
                <p><strong>Adresse :</strong>
                    <?= htmlspecialchars($order['adresse_livraison']) ?>,
                    <?= htmlspecialchars($order['ville']) ?>
                </p>
                <p><strong>Nombre de personnes :</strong>
                    <?= (int) $order['nb_personnes'] ?>
                </p>
                <p><strong>Statut :</strong>
                    <?= htmlspecialchars($order['statut']) ?>
                </p>
                <p><strong>Total :</strong>
                    <?= number_format((float) $order['prix_total'], 2, ',', ' ') ?> €
                </p>
            </div>

            <hr class="order-detail-divider">

            <h2 class="order-detail-section-title mb-4">
                Suivi de commande
            </h2>

            <ul class="order-tracking-list">
                <?php foreach ($tracking as $track): ?>
                    <li>
                        <i class="bi bi-check-circle-fill"></i>

                        <span>
                            <?= htmlspecialchars($track['statut']) ?>
                            —
                            <?= date('d/m/Y H:i', strtotime($track['date_changement'])) ?>

                            <br>

                            <?php if (!empty($track['auteur_nom'])): ?>
                                <small class="text-muted">
                                    Par <?= htmlspecialchars($track['auteur_prenom'] . ' ' . $track['auteur_nom']) ?>
                                    (<?= htmlspecialchars($track['auteur_role']) ?>)
                                </small>
                            <?php endif; ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="order-detail-actions">
                <?php if ((int) $order['statut_id'] === 1): ?>

                    <a href="index.php?url=modifier-commande&id=<?= (int) $order['id'] ?>"
                        class="btn order-detail-btn order-detail-btn-secondary">
                        Modifier la commande
                    </a>

                <?php endif; ?>
                <?php if ((int) $order['statut_id'] === 1): ?>

                    <a href="index.php?url=annuler-commande&id=<?= (int) $order['id'] ?>"
                        class="btn order-detail-btn order-detail-btn-danger"
                        onclick="return confirm('Voulez-vous vraiment annuler cette commande ?')">
                        Annuler la commande
                    </a>

                <?php endif; ?>
            </div>

            <hr class="order-detail-divider">
            <?php if ((int) $order['statut_id'] === 7 && !$hasReview): ?>
                <h2 class="order-detail-section-title mb-4">
                    Donner un avis
                </h2>

                <form method="POST" class="review-form" action="index.php?url=laisser-avis&id=<?= (int) $order['id'] ?>">
                    <div class="mb-4">
                        <label class="form-label">Note</label>
                        <select name="note" class="form-select" required>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option selected>5</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Commentaire</label>
                        <textarea name="commentaire" class="form-control" rows="5"
                            placeholder="Votre avis sur la prestation..." required></textarea>
                    </div>

                    <button type="submit" class="btn order-detail-btn order-review-btn">
                        Envoyer mon avis
                    </button>

                </form>
            <?php elseif ((int) $order['statut_id'] === 7 && $hasReview): ?>
                <div class="alert alert-info">
                    Vous avez déjà laissé un avis pour cette commande.
                </div>
            <?php endif; ?>
        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>