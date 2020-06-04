<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 */
class Currency
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nomCurrency;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $codeCurrency;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="currency")
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Transfer::class, mappedBy="currency")
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

    public function getNomCurrency(): ?string
    {
        return $this->nomCurrency;
    }

    public function setNomCurrency(string $nomCurrency): self
    {
        $this->nomCurrency = $nomCurrency;

        return $this;
    }

    public function getCodeCurrency(): ?string
    {
        return $this->codeCurrency;
    }

    public function setCodeCurrency(string $codeCurrency): self
    {
        $this->codeCurrency = $codeCurrency;

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
            $transfer->setCurrency($this);
        }

        return $this;
    }

    public function removeTransfer(Transfer $transfer): self
    {
        if ($this->transfers->contains($transfer)) {
            $this->transfers->removeElement($transfer);
            // set the owning side to null (unless already changed)
            if ($transfer->getCurrency() === $this) {
                $transfer->setCurrency(null);
            }
        }

        return $this;
    }

    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        return $this->codeCurrency;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
