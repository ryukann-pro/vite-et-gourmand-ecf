<?php
require_once __DIR__ . '/../../Models/HoraireModel.php';

$horaireModel = new HoraireModel();
$footerHoraires = $horaireModel->getAll();
?>

<footer class="site-footer">

    <div class="container">

        <div class="footer-grid">

            <!-- Horaires -->
            <div class="footer-column">

                <h2 class="footer-hours-title">
                    Nos horaires
                </h2>

                <div class="footer-hours-list">

                    <?php foreach ($footerHoraires as $horaire): ?>

                        <p class="footer-hours">

                            <strong>
                                <?= htmlspecialchars($horaire['jour_semaine']) ?>
                            </strong>

                            :

                            <?= htmlspecialchars(substr($horaire['heure_ouverture'], 0, 5)) ?>

                            -

                            <?= htmlspecialchars(substr($horaire['heure_fermeture'], 0, 5)) ?>

                        </p>

                    <?php endforeach; ?>

                </div>

            </div>

            <!-- Contact -->
            <div class="footer-column">

                <h2 class="footer-hours-title">
                    Contact
                </h2>

                <p class="footer-help">
                    Besoin d’aide ? Des questions ?
                </p>

                <a href="tel:+33556000000" class="footer-contact-link">
                    <i class="bi bi-telephone-fill"></i>
                    05 56 00 00 00
                </a>

                <a href="mailto:contact@viteetgourmand.fr" class="footer-contact-link footer-email">

                    <i class="bi bi-envelope-fill"></i>

                    contact@viteetgourmand.fr

                </a>

                <p class="footer-address">
                    12 rue Sainte-Catherine<br>
                    33000 Bordeaux
                </p>

            </div>

            <!-- Navigation -->
            <div class="footer-column">

                <h2 class="footer-hours-title">
                    Navigation
                </h2>

                <nav class="footer-links">

                    <a href="<?= BASE_URL ?>/index.php?url=accueil">
                        Accueil
                    </a>

                    <a href="<?= BASE_URL ?>/index.php?url=menus">
                        Menus
                    </a>

                    <a href="<?= BASE_URL ?>/index.php?url=contact">
                        Contact
                    </a>

                    <a href="<?= BASE_URL ?>/index.php?url=mentions-legales">
                        Mentions légales
                    </a>

                    <a href="<?= BASE_URL ?>/index.php?url=cgv">
                        CGV
                    </a>
                </nav>

            </div>

        </div>

        <p class="footer-copyright mt-5 mb-0">
            © 2026 Vite & Gourmand
        </p>

    </div>

</footer>

<?php if (isset($_SESSION['user'])): ?>

    <div
        id="sessionWarning"
        class="alert alert-warning position-fixed bottom-0 end-0 m-4 d-none"
        role="alert"
        style="z-index: 9999;"
    >
        <p class="mb-2">
            Votre session va bientôt expirer pour cause d'inactivité.
        </p>

        <button
            type="button"
            id="stayConnected"
            class="btn btn-sm btn-dark"
        >
            Rester connecté
        </button>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/session-timeout.js"></script>

<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>