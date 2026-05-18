<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="admin-employees-page py-5">

    <section class="container">

        <div class="admin-employees-header mb-5">

            <h1 class="admin-employees-title">
                Gestion des employés
            </h1>

            <p class="admin-employees-text">
                Créez, consultez ou désactivez les comptes employés.
            </p>

        </div>

        <div class="admin-employees-card">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <h2 class="admin-employees-subtitle mb-0">
                    Employés existants
                </h2>

                <a href="index.php?url=admin-creation-employe"
                    class="btn admin-employees-btn">

                    Créer un employé

                </a>

            </div>

            <div class="table-responsive">

                <table class="table align-middle admin-employees-table">

                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>

                            <td>Julie Martin</td>

                            <td>
                                julie@email.com
                            </td>

                            <td>
                                Employé
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    Actif
                                </span>
                            </td>

                            <td>

                                <div class="d-flex justify-content-end gap-2 flex-wrap">

                                    <button class="btn btn-sm admin-employees-secondary-btn">
                                        Modifier
                                    </button>

                                    <button class="btn btn-sm admin-employees-danger-btn">
                                        Désactiver
                                    </button>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>Lucas Bernard</td>

                            <td>
                                lucas@email.com
                            </td>

                            <td>
                                Employé
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    Inactif
                                </span>
                            </td>

                            <td>

                                <div class="d-flex justify-content-end gap-2 flex-wrap">

                                    <button class="btn btn-sm admin-employees-secondary-btn">
                                        Modifier
                                    </button>

                                    <button class="btn btn-sm admin-employees-btn">
                                        Réactiver
                                    </button>

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