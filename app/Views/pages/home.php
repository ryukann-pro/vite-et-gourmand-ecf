<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main>
    <section class="hero-home">
        <div class="hero-overlay">
            <div class="container h-100">
                <div class="row h-100 align-items-center">

                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="hero-content-left text-white">
                            <h1 class="hero-title mb-4">Vite & gourmand</h1>

                            <p class="hero-text mb-4">
                                Depuis plus de 25 ans à Bordeaux,<br>
                                Julie et José régalent vos événements avec une cuisine maison,
                                généreuse et de saison.<br>
                                Découvrez un menu qui évolue toute l’année pour s’adapter à toutes vos envies.
                            </p>

                            <a href="index.php?url=menus" class="btn btn-warning hero-btn">
                                Nos menus
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center justify-content-lg-end mt-5 mt-lg-0">
                        <div class="hero-content-right text-white text-lg-center">
                            <h2 class="hero-contact-title mb-4">Une question ? Parlons-en !</h2>

                            <p class="hero-text mb-4">
                                Besoin d’un traiteur pour un événement ou simplement d’informations ?
                                Contactez-nous, nous vous répondrons rapidement.
                            </p>

                            <p class="hero-phone mb-4">07 87 69 37 89</p>

                            <a href="index.php?url=contact" class="btn btn-warning hero-btn">
                                Nous contacter
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="team-section py-5">
        <div class="container">
            <div class="team-card text-center">

                <h2 class="team-title mb-4">- Notre équipe -</h2>

                <h3 class="team-subtitle mb-4">
                    Derrière chaque plat, deux passionnés en action
                </h3>

                <p class="team-intro mb-5">
                    Julie et José mettent leur savoir-faire et leur créativité au service de vos événements.
                    Chaque plat est pensé avec soin pour allier goût, générosité et convivialité.
                </p>

                <div class="row justify-content-center align-items-start g-5 mb-4">

                    <div class="col-lg-5">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/equipe/julie.jpg"
                            alt="Julie, cheffe et cofondatrice" class="team-img mb-4">

                        <h4 class="team-name">Julie</h4>
                        <p class="team-role">cheffe et cofondatrice</p>
                    </div>

                    <div class="col-lg-5">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/equipe/josé.jpg"
                            alt="José, chef et cofondateur" class="team-img mb-4">

                        <h4 class="team-name">José</h4>
                        <p class="team-role">chef et co-fondateur</p>
                    </div>

                </div>

                <p class="team-duo mb-3">
                    Julie & José, le duo de Vite & Gourmand
                </p>

                <p class="team-text mb-0">
                    Entre créativité et maîtrise, ils imaginent ensemble une cuisine authentique
                    qui rend chaque événement mémorable.
                </p>

            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>