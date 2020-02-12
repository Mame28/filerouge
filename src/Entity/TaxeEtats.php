<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaxeEtatsRepository")
 */
class TaxeEtats
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $taxeEmet;

    /**
     * @ORM\Column(type="float")
     */
    private $taxeRecep;

    /**
     * @ORM\Column(type="float")
     */
    private $taxeSys;

    /**
     * @ORM\Column(type="float")
     */
    private $taxeEtat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaxeEmet(): ?float
    {
        return $this->taxeEmet;
    }

    public function setTaxeEmet(float $taxeEmet): self
    {
        $this->taxeEmet = $taxeEmet;

        return $this;
    }

    public function getTaxeRecep(): ?float
    {
        return $this->taxeRecep;
    }

    public function setTaxeRecep(float $taxeRecep): self
    {
        $this->taxeRecep = $taxeRecep;

        return $this;
    }

    public function getTaxeSys(): ?float
    {
        return $this->taxeSys;
    }

    public function setTaxeSys(float $taxeSys): self
    {
        $this->taxeSys = $taxeSys;

        return $this;
    }

    public function getTaxeEtat(): ?float
    {
        return $this->taxeEtat;
    }

    public function setTaxeEtat(float $taxeEtat): self
    {
        $this->taxeEtat = $taxeEtat;

        return $this;
    }
}
