<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="order-detail-page py-5">

    <section class="container">

        <div class="order-detail-card">

            <h1 class="order-detail-title mb-5">
                Détail de la commande #CMD-001
            </h1>

            <div class="order-detail-info">
                <p><strong>Menu :</strong> Buffet Signature Réception</p>
                <p><strong>Date de livraison :</strong> 15/05/2026 à 12:30</p>
                <p><strong>Adresse :</strong> 5 rue exemple, Bordeaux</p>
                <p><strong>Nombre de personnes :</strong> 10</p>
                <p><strong>Total :</strong> 180 €</p>
            </div>

            <hr class="order-detail-divider">

            <h2 class="order-detail-section-title mb-4">
                Suivi de commande
            </h2>

            <ul class="order-tracking-list">
                <li class="order-tracking-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>En attente — 15/05/2026 10:30</span>
                </li>

                <li class="order-tracking-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Acceptée — 15/05/2026 11:00</span>
                </li>

                <li class="order-tracking-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Terminée — 15/05/2026 16:30</span>
                </li>
            </ul>

            <div class="order-detail-actions">
                <a href="index.php?url=modifier-commande&id=1" class="btn order-detail-btn order-detail-btn-secondary">
                    Modifier la commande
                </a>

                <a href="#" class="btn order-detail-btn order-detail-btn-danger">
                    Annuler la commande
                </a>
            </div>

            <hr class="order-detail-divider">

            <h2 class="order-detail-section-title mb-4">
                Donner un avis
            </h2>

            <form class="review-form">

                <div class="mb-4">
                    <label class="form-label">Note</label>
                    <select class="form-select">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option selected>5</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Commentaire</label>
                    <textarea
                        class="form-control"
                        rows="5"
                        placeholder="Votre avis sur la prestation..."
                    ></textarea>
                </div>

                <button type="submit" class="btn order-detail-btn order-review-btn">
                    Envoyer mon avis
                </button>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>