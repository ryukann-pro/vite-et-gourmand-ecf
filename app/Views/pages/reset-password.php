<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="forgot-password-page py-5">

    <section class="container">

        <div class="forgot-password-card">

            <h1 class="forgot-password-title mb-4">
                Réinitialiser votre mot de passe
            </h1>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">
                    <label for="password" class="form-label">
                        Nouveau mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="form-label">
                        Confirmation du mot de passe
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        class="form-control"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="btn forgot-password-btn w-100"
                >
                    Modifier mon mot de passe
                </button>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>