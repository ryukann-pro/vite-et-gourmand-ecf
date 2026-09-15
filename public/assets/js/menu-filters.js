const baseUrl = window.APP_BASE_URL ?? "";
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

    menusContainer.replaceChildren();
    
    if (menus.length === 0) {
        const column = document.createElement("div");
        column.className = "col-12";

        const alert = document.createElement("div");
        alert.className = "alert alert-info";
        alert.textContent = "Aucun menu ne correspond aux filtres sélectionnés.";

        column.appendChild(alert);
        menusContainer.appendChild(column);

        return;
    }

    menus.forEach(menu => {
        const column = document.createElement("div");
        column.className = "col-12 col-md-6 col-xl-4";

        const article = document.createElement("article");
        article.className = "menu-card";

        const imageWrapper = document.createElement("div");
        imageWrapper.className = "menu-card-img-wrapper";

        const image = document.createElement("img");
        image.className = "menu-card-img";
        image.src = `${baseUrl}/${menu.image_url}`;
        image.alt = menu.texte_alternatif;

        imageWrapper.appendChild(image);
        article.appendChild(imageWrapper);

        const body = document.createElement("div");
        body.className = "menu-card-body";

        const title = document.createElement("h2");
        title.className = "menu-card-title";
        title.textContent = menu.titre;

        const description = document.createElement("p");
        description.className = "menu-card-description";
        description.textContent = menu.description_courte;

        body.appendChild(title);
        body.appendChild(description);

        const info = document.createElement("div");
        info.className = "menu-card-info";

        const people = document.createElement("span");
        people.textContent = `Min. ${menu.nb_personnes_min} personnes`;

        const regime = document.createElement("span");
        regime.textContent = menu.regime;

        const price = document.createElement("strong");
        price.textContent = `${parseFloat(menu.prix_par_personne).toFixed(0)} € par personne`;

        info.appendChild(people);
        info.appendChild(regime);
        info.appendChild(price);

        body.appendChild(info);

        const link = document.createElement("a");
        link.className = "btn menu-card-btn";
        link.href = `index.php?url=menu-detail&id=${encodeURIComponent(menu.id)}`;
        link.textContent = "Voir les détails du menu";

        body.appendChild(link);

        article.appendChild(body);

        column.appendChild(article);
        menusContainer.appendChild(column);
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