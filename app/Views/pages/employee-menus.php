<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-management-page py-5">
    <section class="container">

        <div class="employee-management-header mb-5">
            <h1 class="employee-management-title">Gestion des menus</h1>
            <p class="employee-management-text">
                Modifiez ou supprimez les menus proposés aux clients.
            </p>
        </div>

        <div class="employee-management-card">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <h2 class="employee-management-subtitle mb-0">Menus existants</h2>

                <a href="#" class="btn employee-management-btn">
                    Ajouter un menu
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle employee-management-table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Thème</th>
                            <th>Régime</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Buffet Signature Réception</td>
                            <td>Événement</td>
                            <td>Standard</td>
                            <td>18 € / personne</td>
                            <td>10</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="#" class="btn btn-sm employee-management-secondary-btn">Modifier</a>
                                    <a href="#" class="btn btn-sm employee-management-danger-btn">Supprimer</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Festin Végétarien de Noël</td>
                            <td>Noël</td>
                            <td>Végétarien</td>
                            <td>22 € / personne</td>
                            <td>8</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="#" class="btn btn-sm employee-management-secondary-btn">Modifier</a>
                                    <a href="#" class="btn btn-sm employee-management-danger-btn">Supprimer</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Menu Vegan Équilibré</td>
                            <td>Classique</td>
                            <td>Vegan</td>
                            <td>20 € / personne</td>
                            <td>12</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="#" class="btn btn-sm employee-management-secondary-btn">Modifier</a>
                                    <a href="#" class="btn btn-sm employee-management-danger-btn">Supprimer</a>
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