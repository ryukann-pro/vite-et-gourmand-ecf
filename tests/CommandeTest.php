<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/Entities/Commande.php';

class CommandeTest extends TestCase
{
  public function testCalculSousTotal(): void
  {
    $commande = new Commande(
      10,
      18.00,
      5,
      0
    );

    $this->assertSame(
      180.0,
      $commande->calculerSousTotal()
    );
  }

  public function testReductionAppliquee(): void
  {
    $commande = new Commande(
      10,
      18.00,
      5,
      0
    );

    $this->assertSame(
      18.0,
      $commande->calculerReduction()
    );
  }

  public function testPasDeReductionSousLeSeuil(): void
  {
    $commande = new Commande(
      9,
      18.00,
      5,
      0
    );

    $this->assertSame(
      0.0,
      $commande->calculerReduction()
    );
  }

  public function testFraisLivraisonBordeaux(): void
  {
    $commande = new Commande(
      10,
      18.00,
      5,
      0
    );

    $this->assertSame(
      5.0,
      $commande->calculerFraisLivraison()
    );
  }

  public function testFraisLivraisonAvecDistance(): void
  {
    $commande = new Commande(
      10,
      18.00,
      5,
      7
    );

    $this->assertEqualsWithDelta(
      9.13,
      $commande->calculerFraisLivraison(),
      0.001
    );
  }

  public function testCalculTotal(): void
  {
    $commande = new Commande(
      10,
      18.00,
      5,
      0
    );

    $this->assertSame(
      167.0,
      $commande->calculerTotal()
    );
  }
}