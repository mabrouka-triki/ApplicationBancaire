<?php
// Contrat.php
class Contrat
{
    private int $id;
    private string $type;
    private float $montant;
    private string $duree;
    private int $idClient;

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

    public function getDuree(): string
    {
        return $this->duree;
    }

    public function getIdClient(): int
    {
        return $this->idClient;
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

    public function setDuree(string $duree): void
    {
        $this->duree = htmlspecialchars($duree);
    }

    public function setIdClient(int $idClient): void
    {
        $this->idClient = $idClient;
    }
}

