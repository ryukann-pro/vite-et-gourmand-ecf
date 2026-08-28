<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-hours-page py-5">
    <section class="container">

        <div class="employee-hours-header mb-5">
            <h1 class="employee-hours-title">
                Gestion des horaires
            </h1>

            <p class="employee-hours-text">
                Modifiez les horaires d’ouverture du restaurant.
            </p>
        </div>

        <div class="employee-hours-card">

            <h2 class="employee-hours-subtitle mb-4">
                Horaires hebdomadaires
            </h2>

            <form method="POST" action="index.php?url=employe-horaires">

                <?php foreach ($horaires as $horaire): ?>

                    <?php
                    $horaireId = (int) $horaire['id'];
                    ?>

                    <div class="employee-hour-row">

                        <div class="employee-hour-day">
                            <?= htmlspecialchars($horaire['jour_semaine']) ?>
                        </div>

                        <div>
                            <label
                                for="ouverture_<?= $horaireId ?>"
                                class="form-label">
                                Ouverture
                            </label>

                            <input
                                type="time"
                                id="ouverture_<?= $horaireId ?>"
                                name="horaires[<?= $horaireId ?>][ouverture]"
                                class="form-control"
                                value="<?= htmlspecialchars(substr($horaire['heure_ouverture'], 0, 5)) ?>"
                                required>
                        </div>

                        <div>
                            <label
                                for="fermeture_<?= $horaireId ?>"
                                class="form-label">
                                Fermeture
                            </label>

                            <input
                                type="time"
                                id="fermeture_<?= $horaireId ?>"
                                name="horaires[<?= $horaireId ?>][fermeture]"
                                class="form-control"
                                value="<?= htmlspecialchars(substr($horaire['heure_fermeture'], 0, 5)) ?>"
                                required>
                        </div>

                    </div>

                <?php endforeach; ?>

                <button
                    type="submit"
                    class="btn employee-hours-btn mt-4">
                    Enregistrer les horaires
                </button>

            </form>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>