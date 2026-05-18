<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-orders-page py-5">

    <section class="container">

        <div class="employee-orders-header mb-5">
            <h1 class="employee-orders-title">Gestion des commandes</h1>
            <p class="employee-orders-text">
                Retrouvez rapidement les commandes par statut ou par client.
            </p>
        </div>

        <div class="employee-orders-card mb-5">

            <h2 class="employee-orders-subtitle mb-4">Filtres</h2>

            <div class="row g-4">

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">Statut</label>
                    <select class="form-select">
                        <option>Tous les statuts</option>
                        <option>En attente</option>
                        <option>Acceptée</option>
                        <option>En préparation</option>
                        <option>En cours de livraison</option>
                        <option>Livrée</option>
                        <option>En attente retour matériel</option>
                        <option>Terminée</option>
                        <option>Annulée</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label">Client</label>
                    <input type="text" class="form-control" placeholder="Nom, prénom ou email">
                </div>

                <div class="col-12 col-lg-4 d-flex align-items-end">
                    <button class="btn employee-orders-btn w-100">
                        Rechercher
                    </button>
                </div>

            </div>

        </div>

        <div class="employee-orders-card">

            <h2 class="employee-orders-subtitle mb-4">Commandes</h2>

            <div class="table-responsive">

                <table class="table align-middle employee-orders-table">

                    <thead>
                        <tr>
                            <th>Commande</th>
                            <th>Client</th>
                            <th>Menu</th>
                            <th>Date livraison</th>
                            <th>Statut</th>
                            <th>Total</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>#CMD-001</td>
                            <td>Julie Dupont<br><small>julie@email.com</small></td>
                            <td>Buffet Signature Réception</td>
                            <td>15/05/2026<br><small>12:30</small></td>
                            <td><span class="badge bg-warning text-dark">En attente</span></td>
                            <td>180 €</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="index.php?url=employe-detail-commande&id=1" class="btn btn-sm employee-orders-btn">
                                        Voir
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>#CMD-002</td>
                            <td>Lucas Martin<br><small>lucas@email.com</small></td>
                            <td>Menu Festif Traditionnel</td>
                            <td>20/05/2026<br><small>18:00</small></td>
                            <td><span class="badge bg-primary">Acceptée</span></td>
                            <td>320 €</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="index.php?url=employe-detail-commande&id=2" class="btn btn-sm employee-orders-btn">
                                        Voir
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>#CMD-003</td>
                            <td>Sophie Bernard<br><small>sophie@email.com</small></td>
                            <td>Cocktail Vegan Événementiel</td>
                            <td>22/05/2026<br><small>11:30</small></td>
                            <td><span class="badge bg-success">Terminée</span></td>
                            <td>315 €</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="index.php?url=employe-detail-commande&id=3" class="btn btn-sm employee-orders-btn">
                                        Voir
                                    </a>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>