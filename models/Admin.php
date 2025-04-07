
<?php
// Admin.php
class Admin
{
    private int $id;
    private string $nom;
    private string $email;
    private string $mdp;

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNom(string $nom): void
    {
        $this->nom = htmlspecialchars($nom);
    }

    public function setEmail(string $email): void
    {
        $this->email = htmlspecialchars($email);
    }

    public function setMdp(string $mdp): void
    {
        $this->mdp = password_hash($mdp, PASSWORD_BCRYPT); // Hashage du mot de passe
    }
}
