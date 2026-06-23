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

                <a href="index.php?url=employe-plat-create" class="btn employee-management-btn">
                    Ajouter un plat
                </a>
            </div>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'used'): ?>

                <div class="alert alert-danger mb-4">
                    Impossible de supprimer ce plat car il est utilisé dans un menu.
                </div>

            <?php endif; ?>
            <div class="table-responsive">
                <table class="table align-middle employee-management-table">
                    <thead>
                        <tr>
                            <th>Plat</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Allergènes</th>
                            <th>Utilisation</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($plats as $plat): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($plat['nom']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($plat['type_plat']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($plat['description']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($plat['allergenes'] ?? 'Aucun') ?>
                                </td>
                                <td>
                                    <?php if ((int) $plat['nb_menus'] > 0): ?>
                                        <span class="badge bg-warning text-dark">
                                            Utilisé
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success">
                                            Non utilisé
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2 flex-wrap">

                                        <a href="index.php?url=employe-plat-edit&id=<?= (int) $plat['id'] ?>"
                                            class="btn btn-sm employee-management-secondary-btn">
                                            Modifier
                                        </a>
                                        <a href="index.php?url=employe-plat-delete&id=<?= (int) $plat['id'] ?>"
                                            class="btn btn-sm employee-management-danger-btn"
                                            onclick="return confirm('Supprimer ce plat ?')">
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