<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;



/**
 * @ApiResource(
 *        collectionOperations={
 *        "post"={"access_control"="is_granted('POST', object)"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;
    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="userCreat")
     */
    private $comptes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="userDepot")
     */
    private $depots;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    private $roles=[];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire")
     */
    private $partenaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="user")
     */
    private $users;


    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->depots = new ArrayCollection();
        $this->user_id = new ArrayCollection();
        $this->isActive = true;
        $this->users = new ArrayCollection();
    }
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }
    public function getRoles()
    {
        return $this->getRoles = [('ROLE_'.strtoupper($this->getRole()->getLib()))];
    }


     public function getIsActive(): ?bool
     {
         return $this->isActive;
     }

     public function setIsActive(bool $isActive): self
     {
         $this->isActive = $isActive;

         return $this;
     }

     /**
      * @return Collection|Compte[]
      */
     public function getComptes(): Collection
     {
         return $this->comptes;
     }

     public function addCompte(Compte $compte): self
     {
         if (!$this->comptes->contains($compte)) {
             $this->comptes[] = $compte;
             $compte->setUserCreat($this);
         }

         return $this;
     }

     public function removeCompte(Compte $compte): self
     {
         if ($this->comptes->contains($compte)) {
             $this->comptes->removeElement($compte);
             // set the owning side to null (unless already changed)
             if ($compte->getUserCreat() === $this) {
                 $compte->setUserCreat(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection|Depot[]
      */
     public function getDepots(): Collection
     {
         return $this->depots;
     }

     public function addDepot(Depot $depot): self
     {
         if (!$this->depots->contains($depot)) {
             $this->depots[] = $depot;
             $depot->setUserDepot($this);
         }

         return $this;
     }

     public function removeDepot(Depot $depot): self
     {
         if ($this->depots->contains($depot)) {
             $this->depots->removeElement($depot);
             // set the owning side to null (unless already changed)
             if ($depot->getUserDepot() === $this) {
                 $depot->setUserDepot(null);
             }
         }

         return $this;
     }

     public function getImages(): ?string
     {
         return $this->image;
     }

     public function setImages(string $image): self
     {
         $this->image = $image;

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

     public function getPartenaire(): ?Partenaire
     {
         return $this->partenaire;
     }

     public function setPartenaire(?Partenaire $partenaire): self
     {
         $this->partenaire = $partenaire;

         return $this;
     }

     /**
      * @return Collection|Transaction[]
      */
     public function getUsers(): Collection
     {
         return $this->users;
     }

     public function addUser(Transaction $user): self
     {
         if (!$this->users->contains($user)) {
             $this->users[] = $user;
             $user->setUser($this);
         }

         return $this;
     }

     public function removeUser(Transaction $user): self
     {
         if ($this->users->contains($user)) {
             $this->users->removeElement($user);
             // set the owning side to null (unless already changed)
             if ($user->getUser() === $this) {
                 $user->setUser(null);
             }
         }

         return $this;
     }

     
     
    
}
