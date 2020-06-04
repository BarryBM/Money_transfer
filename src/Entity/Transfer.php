<?php

namespace App\Entity;

use App\Repository\TransferRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransferRepository::class)
 */
class Transfer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $taux;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $fees;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $taxe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Expediteur::class, inversedBy="transfers")
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity=Destinataire::class, inversedBy="transfers")
     */
    private $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="transfers")
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class, inversedBy="transfers")
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="transfers")
     */
    private $agence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTaux(): ?string
    {
        return $this->taux;
    }

    public function setTaux(string $taux): self
    {
        $this->taux = $taux;

        return $this;
    }

    public function getFees(): ?string
    {
        return $this->fees;
    }

    public function setFees(string $fees): self
    {
        $this->fees = $fees;

        return $this;
    }

    public function getTaxe(): ?string
    {
        return $this->taxe;
    }

    public function setTaxe(?string $taxe): self
    {
        $this->taxe = $taxe;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getExpediteur(): ?Expediteur
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Expediteur $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getDestinataire(): ?Destinataire
    {
        return $this->destinataire;
    }

    public function setDestinataire(?Destinataire $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }
}
