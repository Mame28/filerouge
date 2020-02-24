<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typePieceEnvoi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telEmetteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomR;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomR;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $montant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numpieceEmetteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numPieceRecepteur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="comptes")
     */
    private $compte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="users")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $commisionEmetteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $commissionRecepteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $commissionEtat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $commissionSysteme;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnvoi;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRetrait;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telRecepteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $frais;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $typePieceRecepteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transactions")
     */
    private $user_Retrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte")
     */
    private $compte_retrait;

    /**
     * @ORM\Column(type="float")
     */
    private $MontantTotal;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenomE(): ?string
    {
        return $this->prenomE;
    }

    public function setPrenomE(?string $prenomE): self
    {
        $this->prenomE = $prenomE;

        return $this;
    }

    public function getNomE(): ?string
    {
        return $this->nomE;
    }

    public function setNomE(?string $nomE): self
    {
        $this->nomE = $nomE;

        return $this;
    }

    public function getTypePieceEnvoi(): ?string
    {
        return $this->typePieceEnvoi;
    }

    public function setTypePieceEnvoi(?string $typePieceEnvoi): self
    {
        $this->typePieceEnvoi = $typePieceEnvoi;

        return $this;
    }

    public function getTelEmetteur(): ?int
    {
        return $this->telEmetteur;
    }

    public function setTelEmetteur(?int $telEmetteur): self
    {
        $this->telEmetteur = $telEmetteur;

        return $this;
    }

    public function getPrenomR(): ?string
    {
        return $this->prenomR;
    }

    public function setPrenomR(?string $prenomR): self
    {
        $this->prenomR = $prenomR;

        return $this;
    }

    public function getNomR(): ?string
    {
        return $this->nomR;
    }

    public function setNomR(?string $nomR): self
    {
        $this->nomR = $nomR;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(?string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getNumpieceEmetteur(): ?int
    {
        return $this->numpieceEmetteur;
    }

    public function setNumpieceEmetteur(?int $numpieceEmetteur): self
    {
        $this->numpieceEmetteur = $numpieceEmetteur;

        return $this;
    }

    public function getNumPieceRecepteur(): ?int
    {
        return $this->numPieceRecepteur;
    }

    public function setNumPieceRecepteur(?int $numPieceRecepteur): self
    {
        $this->numPieceRecepteur = $numPieceRecepteur;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCommisionEmetteur(): ?int
    {
        return $this->commisionEmetteur;
    }

    public function setCommisionEmetteur(?int $commisionEmetteur): self
    {
        $this->commisionEmetteur = $commisionEmetteur;

        return $this;
    }

    public function getCommissionRecepteur(): ?int
    {
        return $this->commissionRecepteur;
    }

    public function setCommissionRecepteur(?int $commissionRecepteur): self
    {
        $this->commissionRecepteur = $commissionRecepteur;

        return $this;
    }

    public function getCommissionEtat(): ?int
    {
        return $this->commissionEtat;
    }

    public function setCommissionEtat(?int $commissionEtat): self
    {
        $this->commissionEtat = $commissionEtat;

        return $this;
    }

    public function getCommissionSysteme(): ?int
    {
        return $this->commissionSysteme;
    }

    public function setCommissionSysteme(?int $commissionSysteme): self
    {
        $this->commissionSysteme = $commissionSysteme;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(?\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;

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

    public function getTelRecepteur(): ?int
    {
        return $this->telRecepteur;
    }

    public function setTelRecepteur(?int $telRecepteur): self
    {
        $this->telRecepteur = $telRecepteur;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getTypePieceRecepteur(): ?int
    {
        return $this->typePieceRecepteur;
    }

    public function setTypePieceRecepteur(?int $typePieceRecepteur): self
    {
        $this->typePieceRecepteur = $typePieceRecepteur;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getUserRetrait(): ?User
    {
        return $this->user_Retrait;
    }

    public function setUserRetrait(?User $user_Retrait): self
    {
        $this->user_Retrait = $user_Retrait;

        return $this;
    }

    public function getCompteRetrait(): ?Compte
    {
        return $this->compte_retrait;
    }

    public function setCompteRetrait(?Compte $compte_retrait): self
    {
        $this->compte_retrait = $compte_retrait;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->MontantTotal;
    }

    public function setMontantTotal(float $MontantTotal): self
    {
        $this->MontantTotal = $MontantTotal;

        return $this;
    }
}
