<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TarifsRepository")
 */
class Tarifs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $borne_inf;

    /**
     * @ORM\Column(type="integer")
     */
    private $borne_sup;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $typePiece;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="tarifs")
     */
    private $compte;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRetrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorneInf(): ?int
    {
        return $this->borne_inf;
    }

    public function setBorneInf(int $borne_inf): self
    {
        $this->borne_inf = $borne_inf;

        return $this;
    }

    public function getBorneSup(): ?int
    {
        return $this->borne_sup;
    }

    public function setBorneSup(int $borne_sup): self
    {
        $this->borne_sup = $borne_sup;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getTypePiece(): ?int
    {
        return $this->typePiece;
    }

    public function setTypePiece(?int $typePiece): self
    {
        $this->typePiece = $typePiece;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(?\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }
}
