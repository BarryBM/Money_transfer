<?php

namespace App\Entity;

use App\Repository\DestinataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DestinataireRepository::class)
 */
class Destinataire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $idDest;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomDest;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenomDest;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $villeDest;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $phoneDest;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $emailDest;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Expediteur::class, inversedBy="destinataire")
     */
    private $expediteur;

    /**
     * @ORM\OneToMany(targetEntity=Transfer::class, mappedBy="destinataire")
     */
    private $transfers;

    public function __construct()
    {
        $this->transfers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDest(): ?string
    {
        return $this->idDest;
    }

    public function setIdDest(string $idDest): self
    {
        $this->idDest = $idDest;

        return $this;
    }

    public function getNomDest(): ?string
    {
        return $this->nomDest;
    }

    public function setNomDest(string $nomDest): self
    {
        $this->nomDest = $nomDest;

        return $this;
    }

    public function getPrenomDest(): ?string
    {
        return $this->prenomDest;
    }

    public function setPrenomDest(string $prenomDest): self
    {
        $this->prenomDest = $prenomDest;

        return $this;
    }

    public function getVilleDest(): ?string
    {
        return $this->villeDest;
    }

    public function setVilleDest(?string $villeDest): self
    {
        $this->villeDest = $villeDest;

        return $this;
    }

    public function getPhoneDest(): ?string
    {
        return $this->phoneDest;
    }

    public function setPhoneDest(string $phoneDest): self
    {
        $this->phoneDest = $phoneDest;

        return $this;
    }

    public function getEmailDest(): ?string
    {
        return $this->emailDest;
    }

    public function setEmailDest(?string $emailDest): self
    {
        $this->emailDest = $emailDest;

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

    /**
     * @return Collection|Transfer[]
     */
    public function getTransfers(): Collection
    {
        return $this->transfers;
    }

    public function addTransfer(Transfer $transfer): self
    {
        if (!$this->transfers->contains($transfer)) {
            $this->transfers[] = $transfer;
            $transfer->setDestinataire($this);
        }

        return $this;
    }

    public function removeTransfer(Transfer $transfer): self
    {
        if ($this->transfers->contains($transfer)) {
            $this->transfers->removeElement($transfer);
            // set the owning side to null (unless already changed)
            if ($transfer->getDestinataire() === $this) {
                $transfer->setDestinataire(null);
            }
        }

        return $this;
    }
}
