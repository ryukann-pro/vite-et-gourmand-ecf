<?php

class Utilisateur
{
    public function __construct(
        private string $nom,
        private string $prenom,
        private string $email,
        private bool $actif,
        private string $role
    ) {}

    public function estActif(): bool
    {
        return $this->actif;
    }

    public function aUnDesRoles(array $roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    public function aLeRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function emailValide(): bool
    {
        return filter_var(
            $this->email,
            FILTER_VALIDATE_EMAIL
        ) !== false;
    }

    public function informationsValides(): bool
    {
        return $this->nom !== ''
            && $this->prenom !== ''
            && $this->email !== '';
    }

    public static function motDePasseValide(string $password): bool
    {
        return preg_match(
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{10,}$/',
            $password
        ) === 1;
    }

    public static function telephoneValide(string $telephone): bool
    {
        return preg_match(
            '/^0[1-9][0-9]{8}$/',
            $telephone
        ) === 1;
    }

    public function longueursValides(): bool
    {
        return strlen($this->nom) <= 50
            && strlen($this->prenom) <= 50
            && strlen($this->email) <= 191;
    }
}
