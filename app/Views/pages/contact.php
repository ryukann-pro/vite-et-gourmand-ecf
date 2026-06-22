<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="contact-page py-5">

    <section class="container">

        <div class="contact-card">

            <h1 class="contact-title mb-4">
                Contact
            </h1>

            <p class="contact-text mb-5">
                Une question ? Un besoin particulier ?
                Contactez-nous via le formulaire ci-dessous.
            </p>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?url=contact">

                <div class="mb-4">
                    <label for="title" class="form-label">
                        Titre
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="titre"
                        class="form-control"
                        placeholder="Sujet de votre demande"
                        required
                    >
                </div>

                <div class="row">

                    <div class="col-12 col-md-6 mb-4">
                        <label for="lastname" class="form-label">
                            Nom
                        </label>

                        <input
                            type="text"
                            id="lastname"
                            name="nom"
                            class="form-control"
                            placeholder="Votre nom"
                            required
                        >
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="firstname" class="form-label">
                            Prénom
                        </label>

                        <input
                            type="text"
                            id="firstname"
                            name="prenom"
                            class="form-control"
                            placeholder="Votre prénom"
                            required
                        >
                    </div>

                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">
                        Adresse email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Votre adresse email"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">
                        Téléphone
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        name="telephone"
                        class="form-control"
                        placeholder="Votre numéro"
                    >
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label">
                        Message
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        class="form-control"
                        rows="6"
                        placeholder="Votre message"
                        required
                    ></textarea>
                </div>

                <button
                    type="submit"
                    class="btn contact-btn w-100"
                >
                    Envoyer le message
                </button>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>