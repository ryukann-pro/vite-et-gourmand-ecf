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

            <form>

                <div class="mb-4">
                    <label for="title" class="form-label">
                        Titre
                    </label>

                    <input
                        type="text"
                        id="title"
                        class="form-control"
                        placeholder="Sujet de votre demande"
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
                            class="form-control"
                            placeholder="Votre nom"
                        >
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="firstname" class="form-label">
                            Prénom
                        </label>

                        <input
                            type="text"
                            id="firstname"
                            class="form-control"
                            placeholder="Votre prénom"
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
                        class="form-control"
                        placeholder="Votre adresse email"
                    >
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">
                        Téléphone
                    </label>

                    <input
                        type="tel"
                        id="phone"
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
                        class="form-control"
                        rows="6"
                        placeholder="Votre message"
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