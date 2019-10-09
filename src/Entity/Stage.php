<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_pers;

    /**
     * @ORM\Column(type="integer")
     */
    private $age_min;

    /**
     * @ORM\Column(type="integer")
     */
    private $age_max;

    /**
     * @ORM\Column(type="boolean")
     */
    private $privated;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $style_danse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cp;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $prix;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="stages")
     * @ORM\JoinTable(name="participants")
     */
    private $users;

    /**
     * Stage constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbrPers(): ?int
    {
        return $this->nbr_pers;
    }

    public function setNbrPers(int $nbr_pers): self
    {
        $this->nbr_pers = $nbr_pers;

        return $this;
    }

    public function getAgeMin(): ?int
    {
        return $this->age_min;
    }

    public function setAgeMin(int $age_min): self
    {
        $this->age_min = $age_min;

        return $this;
    }

    public function getAgeMax(): ?int
    {
        return $this->age_max;
    }

    public function setAgeMax(int $age_max): self
    {
        $this->age_max = $age_max;

        return $this;
    }

    public function getPrivated(): ?bool
    {
        return $this->privated;
    }

    public function setPrivated(bool $privated): self
    {
        $this->privated = $privated;

        return $this;
    }

    public function getStyleDanse(): ?string
    {
        return $this->style_danse;
    }

    public function setStyleDanse(string $style_danse): self
    {
        $this->style_danse = $style_danse;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }
}
