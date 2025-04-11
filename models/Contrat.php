<?php
// Contrat.php
class Contrat
{
    private int $id;
    private string $type;
    private float $montant;
    private int $duree;
    private int $idClient;

    private string $nom;
    private string $prenom;

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function getIdClient(): int
    {
        return $this->idClient;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setType(string $type): void
    {
        $this->type = htmlspecialchars($type);
    }

    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }

    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
    }

    public function setIdClient(int $idClient): void
    {
        $this->idClient = $idClient;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }
}
