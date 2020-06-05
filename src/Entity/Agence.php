<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 */
class Agence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomAgence;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $idAgence;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $contactNameAgence;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $phoneAgence;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $emailAgence;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="agence")
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Transfer::class, mappedBy="agence")
     */
    private $transfers;

    public function __construct()
    {
        $this->transfers = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgence(): ?string
    {
        return $this->nomAgence;
    }

    public function setNomAgence(string $nomAgence): self
    {
        $this->nomAgence = $nomAgence;

        return $this;
    }

    public function getIdAgence(): ?string
    {
        return $this->idAgence;
    }

    public function setIdAgence(string $idAgence): self
    {
        $this->idAgence = $idAgence;

        return $this;
    }

    public function getContactNameAgence(): ?string
    {
        return $this->contactNameAgence;
    }

    public function setContactNameAgence(string $contactNameAgence): self
    {
        $this->contactNameAgence = $contactNameAgence;

        return $this;
    }

    public function getPhoneAgence(): ?string
    {
        return $this->phoneAgence;
    }

    public function setPhoneAgence(string $phoneAgence): self
    {
        $this->phoneAgence = $phoneAgence;

        return $this;
    }

    public function getEmailAgence(): ?string
    {
        return $this->emailAgence;
    }

    public function setEmailAgence(?string $emailAgence): self
    {
        $this->emailAgence = $emailAgence;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
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

    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        return $this->nomAgence;
        // to show the id of the Category in the select
        // return $this->id;
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
            $transfer->setAgence($this);
        }

        return $this;
    }

    public function removeTransfer(Transfer $transfer): self
    {
        if ($this->transfers->contains($transfer)) {
            $this->transfers->removeElement($transfer);
            // set the owning side to null (unless already changed)
            if ($transfer->getAgence() === $this) {
                $transfer->setAgence(null);
            }
        }

        return $this;
    }
}
