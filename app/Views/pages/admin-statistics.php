<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
$maxCommandes = 0;

foreach ($statistics as $statistic) {
    $commandes = (int) $statistic['commandes'];

    if ($commandes > $maxCommandes) {
        $maxCommandes = $commandes;
    }
}
?>

<main class="admin-statistics-page py-5">
    <section class="container">

        <div class="admin-statistics-header mb-5">
            <h1 class="admin-statistics-title">
                Statistiques des commandes
            </h1>

            <p class="admin-statistics-text">
                Visualisez le nombre de commandes terminées par menu et comparez les performances.
            </p>
        </div>

        <div class="admin-statistics-card mb-5">
            <h2 class="admin-statistics-subtitle mb-4">
                Commandes par menu
            </h2>

            <?php if ($totalCommandes > 0): ?>

                <div class="statistics-chart-placeholder <?= count($statistics) > 8 ? 'statistics-scroll' : '' ?>">

                    <?php foreach ($statistics as $statistic): ?>

                        <?php
                        $commandes = (int) $statistic['commandes'];

                        $height = max(
                            5,
                            round(($commandes / $maxCommandes) * 90)
                        );
                        ?>

                        <div class="statistics-item">

                            <div class="statistics-bar" style="height: <?= $height ?>%;">

                                <?php if ($commandes > 0): ?>
                                    <span><?= $commandes ?></span>
                                <?php endif; ?>

                            </div>

                            <p class="statistics-label">
                                <?= htmlspecialchars($statistic['menu']) ?>
                            </p>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="statistics-empty">
                    <p>
                        Aucune commande terminée pour le moment.
                    </p>
                </div>

            <?php endif; ?>
        </div>

        <?php if ($totalCommandes > 0): ?>

            <div class="admin-statistics-card">
                <h2 class="admin-statistics-subtitle mb-4">
                    Détail comparatif
                </h2>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Nombre de commandes</th>
                                <th>Part approximative</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($statistics as $statistic): ?>

                                <?php
                                $commandes = (int) $statistic['commandes'];

                                $part = round(
                                    ($commandes / $totalCommandes) * 100
                                );
                                ?>

                                <tr>
                                    <td>
                                        <?= htmlspecialchars($statistic['menu']) ?>
                                    </td>

                                    <td>
                                        <?= $commandes ?>
                                    </td>

                                    <td>
                                        <?= $part ?> %
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>