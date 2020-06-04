<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
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
    private $nomPays;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $codePays;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $codeTelPays;

    /**
     * @ORM\OneToMany(targetEntity=Currency::class, mappedBy="pays")
     */
    private $currency;

    /**
     * @ORM\OneToMany(targetEntity=Agence::class, mappedBy="pays")
     */
    private $agence;

    /**
     * @ORM\OneToMany(targetEntity=Transfer::class, mappedBy="pays")
     */
    private $transfers;

    public function __construct()
    {
        $this->currency = new ArrayCollection();
        $this->agence = new ArrayCollection();
        $this->transfers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(string $nomPays): self
    {
        $this->nomPays = $nomPays;

        return $this;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function getCodeTelPays(): ?string
    {
        return $this->codeTelPays;
    }

    public function setCodeTelPays(string $codeTelPays): self
    {
        $this->codeTelPays = $codeTelPays;

        return $this;
    }

    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        return $this->nomPays;
        // to show the id of the Category in the select
        // return $this->id;
    }

    /**
     * @return Collection|Currency[]
     */
    public function getCurrency(): Collection
    {
        return $this->currency;
    }

    public function addCurrency(Currency $currency): self
    {
        if (!$this->currency->contains($currency)) {
            $this->currency[] = $currency;
            $currency->setPays($this);
        }

        return $this;
    }

    public function removeCurrency(Currency $currency): self
    {
        if ($this->currency->contains($currency)) {
            $this->currency->removeElement($currency);
            // set the owning side to null (unless already changed)
            if ($currency->getPays() === $this) {
                $currency->setPays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Agence[]
     */
    public function getAgence(): Collection
    {
        return $this->agence;
    }

    public function addAgence(Agence $agence): self
    {
        if (!$this->agence->contains($agence)) {
            $this->agence[] = $agence;
            $agence->setPays($this);
        }

        return $this;
    }

    public function removeAgence(Agence $agence): self
    {
        if ($this->agence->contains($agence)) {
            $this->agence->removeElement($agence);
            // set the owning side to null (unless already changed)
            if ($agence->getPays() === $this) {
                $agence->setPays(null);
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
            $transfer->setPays($this);
        }

        return $this;
    }

    public function removeTransfer(Transfer $transfer): self
    {
        if ($this->transfers->contains($transfer)) {
            $this->transfers->removeElement($transfer);
            // set the owning side to null (unless already changed)
            if ($transfer->getPays() === $this) {
                $transfer->setPays(null);
            }
        }

        return $this;
    }
}
