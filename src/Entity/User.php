<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Civilite")
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $complement;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $cp;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_naissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_attempt_password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_last_attempt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_connect;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valid;

    /**
     * @ORM\Column(type="boolean")
     */
    private $locked;

    /**
     * @ORM\Column(type="boolean")
     */
    private $adherent;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * @ORM\Column(type="string", unique=true, length=150, nullable=true)
     */
    private $processKey;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_expiration_key;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=150)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stage", mappedBy="users")
     */
    private $stages;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->nbr_attempt_password = 0;
        $this->date_last_attempt = new \DateTime();
        $this->last_connect = new \DateTime();
        $this->valid = false;
        $this->locked = false;
        $this->adherent = false;
        $this->role = 'ROLE_GLOBAL';
        $this->stages = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param mixed $civilite
     */
    public function setCivilite($civilite): void
    {
        $this->civilite = $civilite;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param mixed $complement
     */
    public function setComplement($complement): void
    {
        $this->complement = $complement;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp): void
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getDateDeNaissance()
    {
        return $this->date_de_naissance;
    }

    /**
     * @param mixed $date_de_naissance
     */
    public function setDateDeNaissance($date_de_naissance): void
    {
        $this->date_de_naissance = $date_de_naissance;
    }

    /**
     * @return mixed
     */
    public function getNbrAttemptPassword()
    {
        return $this->nbr_attempt_password;
    }

    /**
     * @param mixed $nbr_attempt_password
     */
    public function setNbrAttemptPassword($nbr_attempt_password): void
    {
        $this->nbr_attempt_password = $nbr_attempt_password;
    }

    /**
     * @return mixed
     */
    public function getDateLastAttempt()
    {
        return $this->date_last_attempt;
    }

    /**
     * @param mixed $date_last_attempt
     */
    public function setDateLastAttempt($date_last_attempt): void
    {
        $this->date_last_attempt = $date_last_attempt;
    }

    /**
     * @return mixed
     */
    public function getLastConnect()
    {
        return $this->last_connect;
    }

    /**
     * @param mixed $last_connect
     */
    public function setLastConnect($last_connect): void
    {
        $this->last_connect = $last_connect;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid): void
    {
        $this->valid = $valid;
    }

    /**
     * @return mixed
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * @param mixed $locked
     */
    public function setLocked($locked): void
    {
        $this->locked = $locked;
    }

    /**
     * @return mixed
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * @param mixed $adherent
     */
    public function setAdherent($adherent): void
    {
        $this->adherent = $adherent;
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
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return array($this->getRole());
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
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

    /**
     * @return mixed
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * @param mixed $stages
     */
    public function setStages($stages): void
    {
        $this->stages = $stages;
    }

    public function addStage(Stage $stage)
    {
        $this->stages[] = $stage;
    }

    public function removeStage(Stage $stage)
    {
        $this->stages->removeElement($stage);
    }

    /**
     * @return mixed
     */
    public function getProcessKey()
    {
        return $this->processKey;
    }

    /**
     * @return mixed
     */
    public function getDateExpirationKey()
    {
        return $this->date_expiration_key;
    }

    /**
     * @param mixed $date_expiration_key
     */
    public function setDateExpirationKey($date_expiration_key): void
    {
        $this->date_expiration_key = $date_expiration_key;
    }

    /**
     * @param mixed $processKey
     */
    public function setProcessKey($processKey): void
    {
        $this->processKey = $processKey;
    }

    /**
     * Génére une clé d'activation
     *
     * @throws \Exception
     */
    public function generateProcessKey() {
        $this->processKey = Uuid::uuid4();
        $this->date_expiration_key = new \DateTime('+1 day');
    }

    /**
     * Ajoute une tentative de connexion et bloque si le nombre de tentative est à 5
     */
    public function addAttempt() {
        $this->nbr_attempt_password = $this->nbr_attempt_password + 1;
        $this->date_last_attempt = new \DateTime();

        if ($this->nbr_attempt_password >= 5) {
            $this->locked = true;
        }
    }
    /**
     * Réinitialise le nombre de tentative de connexion
     */
    public function resetAttempt() {
        $this->nbr_attempt_password = 0;
    }
}
