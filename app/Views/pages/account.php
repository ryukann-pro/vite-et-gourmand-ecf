<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="account-page py-5">
    <section class="container">

        <div class="account-card mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <h1 class="account-title mb-0">Mon compte</h1>

                <a href="index.php?url=modifier-profil" class="btn account-btn">
                    Modifier mes informations
                </a>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="account-info-box h-100">
                        <h2 class="account-subtitle mb-3">Informations personnelles</h2>

                        <p><strong>Nom :</strong> Dupont</p>
                        <p><strong>Prénom :</strong> Julie</p>
                        <p><strong>Email :</strong> julie@email.com</p>
                        <p><strong>Téléphone :</strong> 06 00 00 00 00</p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="account-info-box h-100">
                        <h2 class="account-subtitle mb-3">Adresse</h2>

                        <p>
                            12 rue Sainte-Catherine<br>
                            33000 Bordeaux
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="account-card">
            <h2 class="account-subtitle mb-4">Mes commandes</h2>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Commande</th>
                            <th>Date</th>
                            <th>Menu</th>
                            <th>Statut</th>
                            <th>Total</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>#CMD-001</td>
                            <td>15/05/2026</td>
                            <td>Buffet Signature Réception</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    En attente
                                </span>
                            </td>
                            <td>180 €</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="index.php?url=detail-commande&id=1" class="btn btn-sm account-btn">
                                        Voir
                                    </a>

                                    <a href="index.php?url=modifier-commande&id=1" class="btn btn-sm account-secondary-btn">
                                        Modifier
                                    </a>

                                    <a href="#" class="btn btn-sm account-danger-btn">
                                        Annuler
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>#CMD-002</td>
                            <td>10/05/2026</td>
                            <td>Menu Festif Traditionnel</td>
                            <td>
                                <span class="badge bg-primary">
                                    Acceptée
                                </span>
                            </td>
                            <td>240 €</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="index.php?url=detail-commande&id=2" class="btn btn-sm account-btn">
                                        Voir
                                    </a>

                                    <a href="index.php?url=suivi-commande&id=2" class="btn btn-sm account-secondary-btn">
                                        Suivi
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>#CMD-003</td>
                            <td>05/05/2026</td>
                            <td>Menu Vegan Équilibré</td>
                            <td>
                                <span class="badge bg-success">
                                    Terminée
                                </span>
                            </td>
                            <td>120 €</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="index.php?url=detail-commande&id=3" class="btn btn-sm account-btn">
                                        Voir
                                    </a>

                                    <a href="index.php?url=avis-commande&id=3" class="btn btn-sm account-secondary-btn">
                                        Donner un avis
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