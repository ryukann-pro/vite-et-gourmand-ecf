<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/Entities/Utilisateur.php';

class UtilisateurTest extends TestCase
{
    public function testUtilisateurActif(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            true,
            'Client'
        );

        $this->assertTrue(
            $utilisateur->estActif()
        );
    }

    public function testUtilisateurInactif(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            false,
            'Client'
        );

        $this->assertFalse(
            $utilisateur->estActif()
        );
    }

    public function testUtilisateurPossedeRole(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            true,
            'Employé'
        );

        $this->assertTrue(
            $utilisateur->aUnDesRoles(['Employé', 'Admin'])
        );
    }

    public function testUtilisateurNePossedePasRole(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            true,
            'Client'
        );

        $this->assertFalse(
            $utilisateur->aUnDesRoles(['Employé', 'Admin'])
        );
    }

    public function testRoleExact(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            true,
            'Admin'
        );

        $this->assertTrue(
            $utilisateur->aLeRole('Admin')
        );
    }

    public function testEmailValide(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            true,
            'Client'
        );

        $this->assertTrue(
            $utilisateur->emailValide()
        );
    }

    public function testEmailInvalide(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'email-invalide',
            true,
            'Client'
        );

        $this->assertFalse(
            $utilisateur->emailValide()
        );
    }

    public function testInformationsValides(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            true,
            'Client'
        );

        $this->assertTrue(
            $utilisateur->informationsValides()
        );
    }

    public function testMotDePasseValide(): void
    {
        $this->assertTrue(
            Utilisateur::motDePasseValide('Test1234!?')
        );
    }

    public function testMotDePasseInvalide(): void
    {
        $this->assertFalse(
            Utilisateur::motDePasseValide('test1234')
        );
    }

    public function testTelephoneValide(): void
    {
        $this->assertTrue(
            Utilisateur::telephoneValide('0612345678')
        );
    }

    public function testTelephoneInvalide(): void
    {
        $this->assertFalse(
            Utilisateur::telephoneValide('12345')
        );
    }

    public function testLongueursValides(): void
    {
        $utilisateur = new Utilisateur(
            'Dupont',
            'Jean',
            'jean@exemple.fr',
            true,
            'Client'
        );

        $this->assertTrue(
            $utilisateur->longueursValides()
        );
    }
}