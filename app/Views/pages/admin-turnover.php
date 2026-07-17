<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
$turnoverByMenu = [];

foreach ($statistics as $statistic) {
    $statisticMenuId = (int) $statistic['menu_id'];

    if (!isset($turnoverByMenu[$statisticMenuId])) {
        $turnoverByMenu[$statisticMenuId] = [
            'menu_id' => $statisticMenuId,
            'menu' => $statistic['menu'],
            'commandes' => 0,
            'chiffre_affaires' => 0
        ];
    }

    $turnoverByMenu[$statisticMenuId]['commandes']++;

    $turnoverByMenu[$statisticMenuId]['chiffre_affaires'] +=
        (float) $statistic['chiffre_affaires'];
}

$totalCommandes = count($statistics);

$totalChiffreAffaires = array_sum(
    array_column($turnoverByMenu, 'chiffre_affaires')
);

$menuLePlusRentable = null;

foreach ($turnoverByMenu as $menuStatistic) {
    if (
        $menuLePlusRentable === null ||
        $menuStatistic['chiffre_affaires'] >
        $menuLePlusRentable['chiffre_affaires']
    ) {
        $menuLePlusRentable = $menuStatistic;
    }
}
?>

<main class="admin-turnover-page py-5">
    <section class="container">

        <div class="admin-turnover-header mb-5">
            <h1 class="admin-turnover-title">
                Chiffre d’affaires
            </h1>

            <p class="admin-turnover-text">
                Consultez le chiffre d’affaires par menu avec des filtres par menu et par période.
            </p>
        </div>

        <div class="admin-turnover-card mb-5">
            <h2 class="admin-turnover-subtitle mb-4">
                Filtres
            </h2>

            <form method="GET" action="index.php">
                <input
                    type="hidden"
                    name="url"
                    value="admin-chiffre-affaires">

                <div class="row g-4">

                    <div class="col-12 col-lg-3">
                        <label for="menuId" class="form-label">
                            Menu
                        </label>

                        <select
                            id="menuId"
                            name="menu_id"
                            class="form-select">
                            <option value="" <?= $menuId === 0 ? 'selected' : '' ?>>
                                Tous les menus
                            </option>

                            <?php foreach ($turnoverByMenu as $menuStatistic): ?>
                                <option
                                    value="<?= (int) $menuStatistic['menu_id'] ?>"
                                    <?= $menuId === (int) $menuStatistic['menu_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($menuStatistic['menu']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 col-lg-2">
                        <label for="dateDebut" class="form-label">
                            Date début
                        </label>

                        <input
                            type="date"
                            id="dateDebut"
                            name="date_debut"
                            class="form-control"
                            value="<?= htmlspecialchars($dateDebut) ?>">
                    </div>

                    <div class="col-12 col-lg-2">
                        <label for="dateFin" class="form-label">
                            Date fin
                        </label>

                        <input
                            type="date"
                            id="dateFin"
                            name="date_fin"
                            class="form-control"
                            value="<?= htmlspecialchars($dateFin) ?>">
                    </div>

                    <div class="col-12 col-lg-2 d-flex align-items-end">
                        <button
                            type="submit"
                            class="btn admin-turnover-btn w-100">
                            Filtrer
                        </button>
                    </div>

                    <div class="col-12 col-lg-2 d-flex align-items-end">
                        <a
                            href="index.php?url=admin-chiffre-affaires"
                            class="btn btn-outline-secondary w-100">
                            Réinitialiser
                        </a>
                    </div>

                </div>
            </form>
        </div>
        <?php if ($filterError): ?>
            <div class="alert alert-danger mt-4">
                <?= htmlspecialchars($filterError) ?>
            </div>
        <?php endif; ?>
        <?php if ($totalCommandes > 0): ?>

            <div class="row g-4 mb-5">

                <div class="col-12 col-md-4">
                    <div class="admin-turnover-stat-card">
                        <span>Total CA</span>

                        <strong>
                            <?= number_format(
                                $totalChiffreAffaires,
                                2,
                                ',',
                                ' '
                            ) ?> €
                        </strong>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="admin-turnover-stat-card">
                        <span>Commandes terminées</span>

                        <strong>
                            <?= $totalCommandes ?>
                        </strong>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="admin-turnover-stat-card">
                        <span>Menu le plus rentable</span>

                        <strong>
                            <?= htmlspecialchars(
                                $menuLePlusRentable['menu'] ?? 'Aucun'
                            ) ?>
                        </strong>
                    </div>
                </div>

            </div>

            <div class="admin-turnover-card">
                <h2 class="admin-turnover-subtitle mb-4">
                    Chiffre d’affaires par menu
                </h2>

                <div class="table-responsive">
                    <table class="table align-middle admin-turnover-table">

                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Commandes</th>
                                <th>Chiffre d’affaires</th>
                                <th>Prix moyen</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($turnoverByMenu as $menuStatistic): ?>

                                <?php
                                $prixMoyen =
                                    $menuStatistic['commandes'] > 0
                                    ? $menuStatistic['chiffre_affaires']
                                    / $menuStatistic['commandes']
                                    : 0;
                                ?>

                                <tr>
                                    <td>
                                        <?= htmlspecialchars(
                                            $menuStatistic['menu']
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= (int) $menuStatistic['commandes'] ?>
                                    </td>

                                    <td>
                                        <?= number_format(
                                            $menuStatistic['chiffre_affaires'],
                                            2,
                                            ',',
                                            ' '
                                        ) ?> €
                                    </td>

                                    <td>
                                        <?= number_format(
                                            $prixMoyen,
                                            2,
                                            ',',
                                            ' '
                                        ) ?> €
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
            </div>

        <?php else: ?>

            <div class="admin-turnover-card">
                <div class="turnover-empty">
                    <p>
                        Aucune commande terminée ne permet encore de calculer le chiffre d’affaires.
                    </p>
                </div>
            </div>

        <?php endif; ?>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>