<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-order-detail-page py-5">
    <section class="container">

        <div class="employee-order-detail-card">

            <h1 class="employee-order-detail-title mb-5">
                Détail commande #CMD-001
            </h1>

            <div class="row g-4 mb-5">
                <div class="col-12 col-lg-6">
                    <div class="employee-order-info-box h-100">
                        <h2>Informations client</h2>
                        <p><strong>Client :</strong> Julie Dupont</p>
                        <p><strong>Email :</strong> julie@email.com</p>
                        <p><strong>Téléphone :</strong> 06 00 00 00 00</p>
                        <p><strong>Adresse :</strong> 5 rue exemple, Bordeaux</p>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="employee-order-info-box h-100">
                        <h2>Informations commande</h2>
                        <p><strong>Menu :</strong> Buffet Signature Réception</p>
                        <p><strong>Date livraison :</strong> 15/05/2026 à 12:30</p>
                        <p><strong>Nombre de personnes :</strong> 10</p>
                        <p><strong>Total :</strong> 180 €</p>
                        <p><strong>Prêt matériel :</strong> Non</p>
                    </div>
                </div>
            </div>

            <div class="employee-order-section mb-5">
                <h2 class="employee-order-section-title mb-4">
                    Mise à jour du statut
                </h2>

                <form>
                    <div class="row g-4">
                        <div class="col-12 col-lg-8">
                            <label class="form-label">Nouveau statut</label>
                            <select class="form-select">
                                <option>En attente</option>
                                <option>Acceptée</option>
                                <option>En préparation</option>
                                <option>En cours de livraison</option>
                                <option>Livrée</option>
                                <option>En attente du retour de matériel</option>
                                <option>Terminée</option>
                                <option>Annulée</option>
                            </select>
                        </div>

                        <div class="col-12 col-lg-4 d-flex align-items-end">
                            <button type="submit" class="btn employee-order-btn w-100">
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="employee-order-section mb-5">
                <h2 class="employee-order-section-title mb-4">
                    Annulation de commande
                </h2>

                <div class="alert alert-warning">
                    Avant toute annulation, le client doit être contacté par téléphone ou par email.
                </div>

                <form>
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Mode de contact</label>
                            <select class="form-select">
                                <option>Téléphone</option>
                                <option>Email</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Client contacté ?</label>
                            <select class="form-select">
                                <option>Oui</option>
                                <option>Non</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Motif d’annulation</label>
                            <textarea class="form-control" rows="5" placeholder="Indiquer le motif d’annulation..."></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn employee-order-danger-btn">
                                Annuler la commande
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="employee-order-section">
                <h2 class="employee-order-section-title mb-4">
                    Historique du suivi
                </h2>

                <ul class="employee-order-tracking-list">
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>En attente — 15/05/2026 10:30</span>
                    </li>
                    <li>
                        <i class="bi bi-clock"></i>
                        <span>Acceptée — en attente</span>
                    </li>
                    <li>
                        <i class="bi bi-clock"></i>
                        <span>En préparation — en attente</span>
                    </li>
                </ul>
            </div>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>