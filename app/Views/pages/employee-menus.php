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

                <a href="index.php?url=employe-menu-create"
                    class="btn employee-management-btn">
                    Ajouter un menu
                </a>
            </div>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'used'): ?>
                <div class="alert alert-danger mb-4">
                    Impossible de supprimer ce menu car il est utilisé dans une commande.
                </div>
            <?php endif; ?>
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
                        <?php foreach ($menus as $menu): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($menu['titre']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($menu['theme']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($menu['regime']) ?>
                                </td>
                                <td>
                                    <?= number_format((float) $menu['prix_par_personne'], 2, ',', ' ') ?> € / personne
                                </td>
                                <td>
                                    <?= (int) $menu['stock'] ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2 flex-wrap">
                                        <a href="index.php?url=employe-menu-edit&id=<?= (int) $menu['id'] ?>"
                                            class="btn btn-sm employee-management-secondary-btn">
                                            Modifier
                                        </a>

                                        <a
                                            href="index.php?url=employe-menu-delete&id=<?= (int) $menu['id'] ?>"
                                            class="btn btn-sm employee-management-danger-btn"
                                            onclick="return confirm('Supprimer ce menu ?')">
                                            Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>