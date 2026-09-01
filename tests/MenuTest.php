<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/Entities/Menu.php';

class MenuTest extends TestCase
{
    public function testRespecteMinimum(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertTrue(
            $menu->respecteMinimum(5)
        );
    }

    public function testNeRespectePasMinimum(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertFalse(
            $menu->respecteMinimum(4)
        );
    }

    public function testAssezDeStock(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertTrue(
            $menu->aAssezDeStock(8)
        );
    }

    public function testPasAssezDeStock(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertFalse(
            $menu->aAssezDeStock(11)
        );
    }

    public function testPeutEtreCommande(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertTrue(
            $menu->peutEtreCommande(8)
        );
    }

    public function testNePeutPasEtreCommandeSousMinimum(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertFalse(
            $menu->peutEtreCommande(4)
        );
    }

    public function testNePeutPasEtreCommandeSansStock(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertFalse(
            $menu->peutEtreCommande(11)
        );
    }

    public function testSeuilReduction(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertSame(
            10,
            $menu->seuilReduction()
        );
    }

    public function testValeursValides(): void
    {
        $menu = new Menu(
            'Menu Classique',
            5,
            20.00,
            10
        );

        $this->assertTrue(
            $menu->aDesValeursValides()
        );
    }

    public function testTitreVideInvalide(): void
    {
        $menu = new Menu(
            '',
            5,
            20.00,
            10
        );

        $this->assertFalse(
            $menu->aDesValeursValides()
        );
    }
}