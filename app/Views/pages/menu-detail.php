<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="menu-detail-page py-4">
  <section class="container">
    <div class="row align-items-center g-5">

      <div class="col-12 col-lg-6">
        <div class="menu-image-wrapper">

          <div id="menuCarousel" class="carousel slide menu-carousel">
            <div class="carousel-inner">

              <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                  <img
                    src="<?= BASE_URL ?>/<?= htmlspecialchars($image['url']) ?>"
                    class="d-block w-100 menu-detail-img"
                    alt="<?= htmlspecialchars($image['texte_alternatif'] ?? $menu['titre']) ?>"
                    data-bs-toggle="modal"
                    data-bs-target="#galleryModal"
                  >
                </div>
              <?php endforeach; ?>

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
            <h1 class="menu-detail-title">
              <?= htmlspecialchars($menu['titre']) ?>
            </h1>

            <p class="menu-detail-price">
              <?= number_format($menu['prix_par_personne'], 2, ',', ' ') ?> € / personne
            </p>
          </div>

          <p class="menu-detail-condition">
            <i class="bi bi-calendar-event"></i>
            <?= htmlspecialchars($menu['conditions']) ?>
          </p>

          <p class="menu-detail-description">
            <?= htmlspecialchars($menu['description_longue']) ?>
          </p>

          <div class="menu-composition mt-4">
            <h2>Composition du menu</h2>

            <div class="menu-composition-body">

              <?php foreach ($plats as $plat): ?>
                <h3><?= htmlspecialchars($plat['type_plat']) ?></h3>

                <p class="dish-name">
                  <?= htmlspecialchars($plat['nom']) ?>
                </p>

                <p class="dish-description">
                  <?= htmlspecialchars($plat['description']) ?>
                </p>

                <p class="dish-allergens">
                  Allergènes :
                  <?= htmlspecialchars($plat['allergenes'] ?? 'Aucun') ?>
                </p>
              <?php endforeach; ?>

            </div>
          </div>

          <div class="text-center mt-4">
            <a href="index.php?url=commande&id=<?= (int) $menu['id'] ?>" class="btn menu-order-btn">
              Commander
            </a>
          </div>

          <div class="menu-detail-badges mt-4">
            <div class="menu-detail-badge">
              <i class="bi bi-box-seam"></i>
              <span>Prêt de matériel possible</span>
            </div>

            <div class="menu-detail-badge">
              <i class="bi bi-people"></i>
              <span>Minimum <?= (int) $menu['nb_personnes_min'] ?> personnes</span>
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

            <?php foreach ($images as $index => $image): ?>
              <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img
                  src="<?= BASE_URL ?>/<?= htmlspecialchars($image['url']) ?>"
                  class="d-block w-100 gallery-img"
                  alt="<?= htmlspecialchars($image['texte_alternatif'] ?? $menu['titre']) ?>"
                >
              </div>
            <?php endforeach; ?>

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