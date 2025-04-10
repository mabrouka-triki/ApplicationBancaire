
<?php
class Compte
{
    private int $id;
    private string $RIB;
    private string $type;
    private float $solde;
    private int $idClient;

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getRIB(): string
    {
        return $this->RIB;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSolde(): float
    {
        return $this->solde;
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

    public function setRIB(string $RIB): void
    {
        $this->RIB = htmlspecialchars($RIB);
    }

    public function setType(string $type): void
    {
        $this->type = htmlspecialchars($type);
    }

    public function setSolde(float $solde): void
    {
        $this->solde = $solde;
    }

    public function setIdClient(int $idClient): void
    {
        $this->idClient = $idClient;
    }

    public function getNom(): string {
        return $this->nom;
    }
    
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    public function getPrenom(): string {
        return $this->prenom;
    }
    
    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }
}
