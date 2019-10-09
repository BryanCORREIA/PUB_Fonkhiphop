<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Jours", inversedBy="cours")
     */
    private $jour;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $libelle;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_deb;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_fin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDeb(): ?\DateTimeInterface
    {
        return $this->heure_deb;
    }

    public function setHeureDeb(\DateTimeInterface $heure_deb): self
    {
        $this->heure_deb = $heure_deb;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): self
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    /**
     * @return Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * @param mixed $groupe
     */
    public function setGroupe($groupe): void
    {
        $this->groupe = $groupe;
    }

    /**
     * @return Jours
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour): void
    {
        $this->jour = $jour;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle): void
    {
        $this->libelle = $libelle;
    }
}
