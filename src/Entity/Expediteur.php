<?php

namespace App\Entity;

use App\Repository\ExpediteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpediteurRepository::class)
 */
class Expediteur
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
    private $idExp;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Destinataire::class, mappedBy="expediteur")
     */
    private $destinataire;

    /**
     * @ORM\OneToMany(targetEntity=Transfer::class, mappedBy="expediteur")
     */
    private $transfers;

    public function __construct()
    {
        $this->destinataire = new ArrayCollection();
        $this->transfers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdExp(): ?string
    {
        return $this->idExp;
    }

    public function setIdExp(string $idExp): self
    {
        $this->idExp = $idExp;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    /**
     * @return Collection|Destinataire[]
     */
    public function getDestinataire(): Collection
    {
        return $this->destinataire;
    }

    public function addDestinataire(Destinataire $destinataire): self
    {
        if (!$this->destinataire->contains($destinataire)) {
            $this->destinataire[] = $destinataire;
            $destinataire->setExpediteur($this);
        }

        return $this;
    }

    public function removeDestinataire(Destinataire $destinataire): self
    {
        if ($this->destinataire->contains($destinataire)) {
            $this->destinataire->removeElement($destinataire);
            // set the owning side to null (unless already changed)
            if ($destinataire->getExpediteur() === $this) {
                $destinataire->setExpediteur(null);
            }
        }

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
            $transfer->setExpediteur($this);
        }

        return $this;
    }

    public function removeTransfer(Transfer $transfer): self
    {
        if ($this->transfers->contains($transfer)) {
            $this->transfers->removeElement($transfer);
            // set the owning side to null (unless already changed)
            if ($transfer->getExpediteur() === $this) {
                $transfer->setExpediteur(null);
            }
        }

        return $this;
    }
}
