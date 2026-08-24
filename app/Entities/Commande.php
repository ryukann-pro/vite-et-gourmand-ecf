<?php

class Commande
{
    public function __construct(
        private int $nbPersonnes,
        private float $prixUnitaire,
        private int $minimumMenu,
        private float $distanceKm
    ) {
    }

    public function calculerSousTotal(): float
    {
        return $this->prixUnitaire * $this->nbPersonnes;
    }

    public function calculerReduction(): float
    {
        if ($this->nbPersonnes >= $this->minimumMenu + 5) {
            return $this->calculerSousTotal() * 0.10;
        }

        return 0;
    }

    public function calculerFraisLivraison(): float
    {
        $fraisLivraison = 5;

        if ($this->distanceKm > 0) {
            $fraisLivraison += $this->distanceKm * 0.59;
        }

        return $fraisLivraison;
    }

    public function calculerTotal(): float
    {
        return $this->calculerSousTotal()
            - $this->calculerReduction()
            + $this->calculerFraisLivraison();
    }
}