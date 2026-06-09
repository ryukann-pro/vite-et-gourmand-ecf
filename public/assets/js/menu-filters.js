const themeFilter = document.getElementById("themeFilter");
const regimeFilter = document.getElementById("regimeFilter");
const menusContainer = document.getElementById("menusContainer");
const priceMinFilter = document.getElementById("priceMinFilter");
const priceMaxFilter = document.getElementById("priceMaxFilter");
const peopleFilter = document.getElementById("peopleFilter");
const resetFilters = document.getElementById("resetFilters");


async function loadMenus() {
  const theme = themeFilter.value;
  const regime = regimeFilter.value;
  const prixMin = priceMinFilter.value;
  const prixMax = priceMaxFilter.value;
  const people = peopleFilter.value;
const response = await fetch(
  `index.php?url=api-menus&theme=${encodeURIComponent(theme)}&regime=${encodeURIComponent(regime)}&prix_min=${encodeURIComponent(prixMin)}&prix_max=${encodeURIComponent(prixMax)}&personnes=${encodeURIComponent(people)}`
);

  const menus = await response.json();

  menusContainer.innerHTML = "";
  if (menus.length === 0) {
  menusContainer.innerHTML = `
    <div class="col-12">
      <div class="alert alert-info">
        Aucun menu ne correspond aux filtres sélectionnés.
      </div>
    </div>
  `;
  return;
}

  menus.forEach(menu => {

    menusContainer.innerHTML += `
        <div class="col-12 col-md-6 col-xl-4">
            <article class="menu-card">

                <div class="menu-card-img-wrapper">
                    <img
                        src="/vite-et-gourmand-ecf/public/${menu.image_url}"
                        alt="${menu.texte_alternatif}"
                        class="menu-card-img"
                    >
                </div>

                <div class="menu-card-body">

                    <h2 class="menu-card-title">
                        ${menu.titre}
                    </h2>

                    <p class="menu-card-description">
                        ${menu.description_courte}
                    </p>

                    <div class="menu-card-info">
                        <span>
                            Min. ${menu.nb_personnes_min} personnes
                        </span>

                        <span>
                            ${menu.regime}
                        </span>

                        <strong>
                            ${parseFloat(menu.prix_par_personne).toFixed(0)} € par personne
                        </strong>
                    </div>

                    <a
                        href="index.php?url=menu-detail&id=${menu.id}"
                        class="btn menu-card-btn"
                    >
                        Voir les détails du menu
                    </a>

                </div>

            </article>
        </div>
    `;
  });
}

themeFilter.addEventListener("change", loadMenus);
regimeFilter.addEventListener("change", loadMenus);
priceMinFilter.addEventListener("input", loadMenus);
priceMaxFilter.addEventListener("input", loadMenus);
peopleFilter.addEventListener("input", loadMenus);

resetFilters.addEventListener("click", () => {

    peopleFilter.value = "";
    priceMinFilter.value = "";
    priceMaxFilter.value = "";
    themeFilter.value = "";
    regimeFilter.value = "";

    loadMenus();
});