<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-management-page py-5">
    <section class="container">

        <div class="employee-management-header mb-5">
            <h1 class="employee-management-title">Gestion des plats</h1>
            <p class="employee-management-text">
                Modifiez ou supprimez les plats utilisés dans les menus.
            </p>
        </div>

        <div class="employee-management-card">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <h2 class="employee-management-subtitle mb-0">Plats existants</h2>

                <a href="#" class="btn employee-management-btn">
                    Ajouter un plat
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle employee-management-table">
                    <thead>
                        <tr>
                            <th>Plat</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Allergènes</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Mini verrines de saumon fumé</td>
                            <td>Entrée</td>
                            <td>Verrines fraîches au saumon fumé, fromage frais et herbes.</td>
                            <td>Lait, Sulfites</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="#" class="btn btn-sm employee-management-secondary-btn">Modifier</a>
                                    <a href="#" class="btn btn-sm employee-management-danger-btn">Supprimer</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Dinde rôtie aux herbes de Noël</td>
                            <td>Plat principal</td>
                            <td>Dinde rôtie avec accompagnement de légumes de saison.</td>
                            <td>Céleri</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="#" class="btn btn-sm employee-management-secondary-btn">Modifier</a>
                                    <a href="#" class="btn btn-sm employee-management-danger-btn">Supprimer</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Bûche chocolat praliné</td>
                            <td>Dessert</td>
                            <td>Bûche traditionnelle au chocolat et praliné.</td>
                            <td>Gluten, Lait, Oeuf, Fruits à coque</td>
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