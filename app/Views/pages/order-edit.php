<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="order-edit-page py-5">

    <section class="container">

        <div class="order-edit-card">

            <h1 class="order-edit-title mb-5">
                Modifier la commande #CMD-001
            </h1>

            <div class="alert alert-warning order-edit-warning mb-5">
                Le menu choisi ne peut pas être modifié.
                Pour changer de menu, veuillez annuler cette commande et en créer une nouvelle.
            </div>

            <form>

                <h2 class="order-edit-section-title mb-4">
                    Menu commandé
                </h2>

                <div class="order-edit-summary mb-5">

                    <h3 class="order-edit-menu-title">
                        Buffet Signature Réception
                    </h3>

                    <p class="order-edit-menu-description">
                        Buffet traiteur complet pour réceptions professionnelles ou privées.
                    </p>

                </div>

                <h2 class="order-edit-section-title mb-4">
                    Informations modifiables
                </h2>

                <div class="mb-4">
                    <label class="form-label">
                        Adresse de livraison
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="5 rue exemple"
                    >
                </div>

                <div class="row">

                    <div class="col-12 col-md-6 mb-4">

                        <label class="form-label">
                            Ville de livraison
                        </label>

                        <select class="form-select">
                            <option selected>Bordeaux</option>
                            <option>Mérignac</option>
                            <option>Pessac</option>
                            <option>Talence</option>
                            <option>Bègles</option>
                            <option>Cenon</option>
                            <option>Lormont</option>
                            <option>Le Bouscat</option>
                        </select>

                    </div>

                    <div class="col-12 col-md-6 mb-4">

                        <label class="form-label">
                            Nombre de personnes
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            value="10"
                            min="10"
                        >

                        <small class="order-edit-help">
                            Minimum 10 personnes pour ce menu.
                        </small>

                    </div>

                </div>

                <div class="row">

                    <div class="col-12 col-md-6 mb-4">

                        <label class="form-label">
                            Date de livraison
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            value="2026-05-15"
                        >

                    </div>

                    <div class="col-12 col-md-6 mb-4">

                        <label class="form-label">
                            Heure souhaitée
                        </label>

                        <select class="form-select">
                            <option>07:30</option>
                            <option>08:00</option>
                            <option>08:30</option>
                            <option selected>12:30</option>
                            <option>13:00</option>
                            <option>13:30</option>
                            <option>14:00</option>
                            <option>14:30</option>
                            <option>15:00</option>
                            <option>15:30</option>
                            <option>16:00</option>
                            <option>16:30</option>
                            <option>17:00</option>
                            <option>17:30</option>
                            <option>18:00</option>
                            <option>18:30</option>
                        </select>

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Téléphone
                    </label>

                    <input
                        type="tel"
                        class="form-control"
                        value="06 00 00 00 00"
                    >

                </div>

                <div class="form-check mb-5">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="pretMaterielEdit"
                    >

                    <label
                        class="form-check-label"
                        for="pretMaterielEdit"
                    >
                        Demander un prêt de matériel
                    </label>

                </div>

                <div class="order-edit-actions">

                    <button
                        type="submit"
                        class="btn order-edit-btn"
                    >
                        Enregistrer les modifications
                    </button>

                    <a
                        href="index.php?url=detail-commande&id=1"
                        class="btn account-secondary-btn"
                    >
                        Retour au détail
                    </a>

                </div>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>