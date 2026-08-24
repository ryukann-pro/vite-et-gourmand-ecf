<?php

class Menu
{
    public function __construct(
        private string $titre,
        private int $nbPersonnesMin,
        private float $prixParPersonne,
        private int $stock
    ) {}

    public function respecteMinimum(int $nbPersonnes): bool
    {
        return $nbPersonnes >= $this->nbPersonnesMin;
    }

    public function aAssezDeStock(int $nbPersonnes): bool
    {
        return $nbPersonnes <= $this->stock;
    }

    public function peutEtreCommande(int $nbPersonnes): bool
    {
        return $this->respecteMinimum($nbPersonnes)
            && $this->aAssezDeStock($nbPersonnes);
    }

    public function seuilReduction(): int
    {
        return $this->nbPersonnesMin + 5;
    }

    public function getNbPersonnesMin(): int
    {
        return $this->nbPersonnesMin;
    }

    public function getPrixParPersonne(): float
    {
        return $this->prixParPersonne;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function aDesValeursValides(): bool
    {
        return $this->titre !== ''
            && $this->nbPersonnesMin > 0
            && $this->prixParPersonne > 0
            && $this->stock >= 0;
    }
}
