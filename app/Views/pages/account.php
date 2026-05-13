<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="account-page py-5">

    <section class="container">

        <div class="account-card mb-5">

            <h1 class="account-title mb-4">
                Mon compte
            </h1>

            <div class="row g-4">

                <div class="col-12 col-md-6">
                    <div class="account-info-box">

                        <h2 class="account-subtitle mb-3">
                            Informations personnelles
                        </h2>

                        <p><strong>Nom :</strong> Dupont</p>
                        <p><strong>Prénom :</strong> Julie</p>
                        <p><strong>Email :</strong> julie@email.com</p>
                        <p><strong>Téléphone :</strong> 06 00 00 00 00</p>

                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="account-info-box">

                        <h2 class="account-subtitle mb-3">
                            Adresse
                        </h2>

                        <p>
                            12 rue Sainte-Catherine<br>
                            33000 Bordeaux
                        </p>

                    </div>
                </div>

            </div>

        </div>

        <div class="account-card">

            <h2 class="account-subtitle mb-4">
                Mes commandes
            </h2>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>Commande</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>#CMD-001</td>
                            <td>15/05/2026</td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    En attente
                                </span>
                            </td>

                            <td>180 €</td>

                            <td>
                                <a href="#" class="btn btn-sm account-btn">
                                    Voir
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>#CMD-002</td>
                            <td>10/05/2026</td>

                            <td>
                                <span class="badge bg-success">
                                    Terminée
                                </span>
                            </td>

                            <td>240 €</td>

                            <td>
                                <a href="#" class="btn btn-sm account-btn">
                                    Voir
                                </a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>