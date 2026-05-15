<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="menu-detail-page py-4">

  <section class="container">

    <div class="row align-items-center g-5">

      <div class="col-12 col-lg-6">

        <div class="menu-image-wrapper">

          <div id="menuCarousel" class="carousel slide menu-carousel">

            <div class="carousel-inner">

              <div class="carousel-item active">
                <img
                  src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/menu-festif-traditionnel/standard-1.jpg"
                  class="d-block w-100 menu-detail-img"
                  alt="Menu festif traditionnel"
                  data-bs-toggle="modal"
                  data-bs-target="#galleryModal"
                >
              </div>

              <div class="carousel-item">
                <img
                  src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/menu-festif-traditionnel/standard-2.jpg"
                  class="d-block w-100 menu-detail-img"
                  alt="Menu festif traditionnel"
                  data-bs-toggle="modal"
                  data-bs-target="#galleryModal"
                >
              </div>

              <div class="carousel-item">
                <img
                  src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/menu-festif-traditionnel/standard-3.jpg"
                  class="d-block w-100 menu-detail-img"
                  alt="Menu festif traditionnel"
                  data-bs-toggle="modal"
                  data-bs-target="#galleryModal"
                >
              </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>

          </div>

          <p class="menu-image-hint">
            <i class="bi bi-zoom-in"></i>
            Cliquez sur l’image pour agrandir
          </p>

        </div>

      </div>

      <div class="col-12 col-lg-6">

        <div class="menu-detail-content">

          <div class="d-flex justify-content-between align-items-start mb-3">
            <h1 class="menu-detail-title">Menu festif traditionnel</h1>
            <p class="menu-detail-price">32 € / personne</p>
          </div>

          <p class="menu-detail-condition">
            <i class="bi bi-calendar-event"></i>
            Commande 1 semaine en avance
          </p>

          <div class="menu-composition mt-4">
            <h2>Composition du menu</h2>

            <div class="menu-composition-body">

              <h3>Entrée</h3>
              <p class="dish-name">Foie gras de canard et son chutney de saison</p>
              <p class="dish-description">
                Foie gras mi-cuit, accompagné d’un chutney de figues et pain brioché légèrement toasté.
              </p>
              <p class="dish-allergens">Allergènes : Lait, Gluten</p>

              <h3>Plat</h3>
              <p class="dish-name">Dinde rôtie aux herbes de Noël</p>
              <p class="dish-description">
                Dinde rôtie lentement, jus réduit aux épices douces, accompagnée de pommes de terre fondantes et légumes de saison.
              </p>
              <p class="dish-allergens">Allergènes : Céleri</p>

              <h3>Dessert</h3>
              <p class="dish-name">Bûche de Noël chocolat & praliné</p>
              <p class="dish-description">
                Biscuit moelleux, mousse chocolat noir et cœur praliné croustillant.
              </p>
              <p class="dish-allergens">Allergènes : Gluten, Lait, Œufs, Fruits à coque</p>

            </div>
          </div>

          <div class="text-center mt-4">
            <a href="index.php?url=commande" class="btn menu-order-btn">Commander</a>
          </div>

          <div class="menu-detail-badges mt-4">

            <div class="menu-detail-badge">
              <i class="bi bi-box-seam"></i>
              <span>Prêt de matériel possible</span>
            </div>

            <div class="menu-detail-badge">
              <i class="bi bi-people"></i>
              <span>Minimum 5 personnes</span>
            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

</main>

<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">

    <div class="modal-content bg-transparent border-0">

      <div class="modal-body p-0">

        <div id="galleryCarousel" class="carousel slide">

          <div class="carousel-inner">

            <div class="carousel-item active">
              <img
                src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/menu-festif-traditionnel/classique-1.jpg"
                class="d-block w-100 gallery-img"
                alt="Menu festif traditionnel"
              >
            </div>

            <div class="carousel-item">
              <img
                src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/menu-festif-traditionnel/classique-2.jpg"
                class="d-block w-100 gallery-img"
                alt="Menu festif traditionnel"
              >
            </div>

            <div class="carousel-item">
              <img
                src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/menu-festif-traditionnel/classique-3.jpg"
                class="d-block w-100 gallery-img"
                alt="Menu festif traditionnel"
              >
            </div>

          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>

          <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>

        </div>

      </div>

    </div>

  </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>