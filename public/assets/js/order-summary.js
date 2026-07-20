const nbPersonnesInput = document.getElementById('nbPersonnes');

const resumeNbPersonnes = document.getElementById('resumeNbPersonnes');
const resumeSousTotal = document.getElementById('resumeSousTotal');
const resumeReduction = document.getElementById('resumeReduction');
const resumeLivraison = document.getElementById('resumeLivraison');
const resumeTotal = document.getElementById('resumeTotal');
const prixUnitaire = document.getElementById('prixUnitaire');
const prix = parseFloat(prixUnitaire.dataset.prix);
const villeLivraisonSelect = document.getElementById('villeLivraison');

function calculerResumeCommande() {

    // Récupération des contraintes
    const minimum = parseInt(nbPersonnesInput.min, 10);
    const maximum = parseInt(nbPersonnesInput.max, 10);
    const minimumMenu = parseInt(prixUnitaire.dataset.minimum, 10);

    // Nombre de personnes
    let nbPersonnes = parseInt(nbPersonnesInput.value, 10);

    if (Number.isNaN(nbPersonnes) || nbPersonnes < minimum) {
        nbPersonnes = minimum;
    }

    if (nbPersonnes > maximum) {
        nbPersonnes = maximum;
        nbPersonnesInput.value = maximum;
    }

    // Sous-total
    const sousTotal = prix * nbPersonnes;

    // Réduction
    let reduction = 0;

    if (nbPersonnes >= minimumMenu + 5) {
        reduction = sousTotal * 0.10;
    }

    // Livraison
    const optionVilleSelectionnee =
        villeLivraisonSelect.options[villeLivraisonSelect.selectedIndex];

    const distance = parseFloat(optionVilleSelectionnee.dataset.distance);

    let fraisLivraison = 5;

    if (distance > 0) {
        fraisLivraison += distance * 0.59;
    }
    const total = sousTotal - reduction + fraisLivraison;
    // Mise à jour du résumé
    resumeNbPersonnes.textContent = nbPersonnes;

    resumeSousTotal.textContent =
        sousTotal.toFixed(2).replace('.', ',') + ' €';

    resumeReduction.textContent =
        '- ' + reduction.toFixed(2).replace('.', ',') + ' €';

    resumeLivraison.textContent =
        fraisLivraison.toFixed(2).replace('.', ',') + ' €';
        
    resumeTotal.textContent =
        total.toFixed(2).replace('.', ',') + ' €';
}
nbPersonnesInput.addEventListener('input', calculerResumeCommande);
villeLivraisonSelect.addEventListener('change', calculerResumeCommande);

calculerResumeCommande();