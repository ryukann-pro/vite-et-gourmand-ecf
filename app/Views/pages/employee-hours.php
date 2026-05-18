<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-hours-page py-5">
    <section class="container">

        <div class="employee-hours-header mb-5">
            <h1 class="employee-hours-title">Gestion des horaires</h1>
            <p class="employee-hours-text">
                Modifiez les horaires d’ouverture du restaurant.
            </p>
        </div>

        <div class="employee-hours-card">

            <h2 class="employee-hours-subtitle mb-4">Horaires hebdomadaires</h2>

            <form>

                <?php
                $days = [
                    ['Lundi', '07:30', '19:00'],
                    ['Mardi', '07:30', '19:00'],
                    ['Mercredi', '07:30', '19:00'],
                    ['Jeudi', '07:30', '19:00'],
                    ['Vendredi', '07:30', '19:00'],
                    ['Samedi', '07:30', '19:00'],
                    ['Dimanche', '07:30', '13:00'],
                ];
                ?>

                <?php foreach ($days as $day): ?>
                    <div class="employee-hour-row">

                        <div class="employee-hour-day">
                            <?= $day[0] ?>
                        </div>

                        <div>
                            <label class="form-label">Ouverture</label>
                            <input type="time" class="form-control" value="<?= $day[1] ?>">
                        </div>

                        <div>
                            <label class="form-label">Fermeture</label>
                            <input type="time" class="form-control" value="<?= $day[2] ?>">
                        </div>

                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn employee-hours-btn mt-4">
                    Enregistrer les horaires
                </button>

            </form>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>