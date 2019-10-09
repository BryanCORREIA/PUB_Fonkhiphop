<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnulationRepository")
 */
class Annulation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cours")
     * @ORM\JoinColumn(name="cour_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $cour;

    /**
     * @ORM\Column(type="date")
     */
    private $date_annulation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAnnulation(): ?\DateTimeInterface
    {
        return $this->date_annulation;
    }

    public function setDateAnnulation(\DateTimeInterface $date_annulation): self
    {
        $this->date_annulation = $date_annulation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCour()
    {
        return $this->cour;
    }

    /**
     * @param mixed $cour
     */
    public function setCour($cour): void
    {
        $this->cour = $cour;
    }
}
