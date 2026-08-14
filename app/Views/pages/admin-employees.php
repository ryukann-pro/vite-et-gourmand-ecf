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

                        <?php foreach ($employees as $employee): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($employee['prenom'], ENT_QUOTES, 'UTF-8') ?>
                                    <?= htmlspecialchars($employee['nom'], ENT_QUOTES, 'UTF-8') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($employee['email'], ENT_QUOTES, 'UTF-8') ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($employee['role'], ENT_QUOTES, 'UTF-8') ?>
                                </td>

                                <td>
                                    <?php if ((int) $employee['actif'] === 1): ?>

                                        <span class="badge bg-success">
                                            Actif
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">
                                            Inactif
                                        </span>

                                    <?php endif; ?>
                                </td>

                                <td>

                                    <div class="d-flex justify-content-end gap-2 flex-wrap">

                                        <a
                                            href="index.php?url=admin-modification-employe&id=<?= (int) $employee['id'] ?>"
                                            class="btn btn-sm admin-employees-secondary-btn">
                                            Modifier
                                        </a>

                                        <form
                                            method="POST"
                                            action="index.php?url=admin-statut-employe&id=<?= (int) $employee['id'] ?>"
                                            class="d-inline">
                                            <?php if ((int) $employee['actif'] === 1): ?>

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm admin-employees-danger-btn admin-employees-status-btn"
                                                    onclick="return confirm('Désactiver cet employé ?')">
                                                    Désactiver
                                                </button>

                                            <?php else: ?>

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm admin-employees-btn admin-employees-status-btn">
                                                    Réactiver
                                                </button>

                                            <?php endif; ?>
                                        </form>

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