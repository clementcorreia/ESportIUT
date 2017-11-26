<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, unique=true)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEquipeMin", type="integer", nullable=true)
     */
    private $nbEquipeMin;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEquipeMax", type="integer", nullable=true)
     */
    private $nbEquipeMax;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\Poule", mappedBy="competition")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poules;

    /**
     * @ORM\ManyToMany(targetEntity="LCSBundle\Entity\Equipe", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->poules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Competition
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Competition
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Competition
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set nbEquipeMin
     *
     * @param integer $nbEquipeMin
     *
     * @return Competition
     */
    public function setNbEquipeMin($nbEquipeMin)
    {
        $this->nbEquipeMin = $nbEquipeMin;

        return $this;
    }

    /**
     * Get nbEquipeMin
     *
     * @return integer
     */
    public function getNbEquipeMin()
    {
        return $this->nbEquipeMin;
    }

    /**
     * Set nbEquipeMax
     *
     * @param integer $nbEquipeMax
     *
     * @return Competition
     */
    public function setNbEquipeMax($nbEquipeMax)
    {
        $this->nbEquipeMax = $nbEquipeMax;

        return $this;
    }

    /**
     * Get nbEquipeMax
     *
     * @return integer
     */
    public function getNbEquipeMax()
    {
        return $this->nbEquipeMax;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Competition
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add poule
     *
     * @param \LCSBundle\Entity\Poule $poule
     *
     * @return Competition
     */
    public function addPoule(\LCSBundle\Entity\Poule $poule)
    {
        $this->poules[] = $poule;

        return $this;
    }

    /**
     * Remove poule
     *
     * @param \LCSBundle\Entity\Poule $poule
     */
    public function removePoule(\LCSBundle\Entity\Poule $poule)
    {
        $this->poules->removeElement($poule);
    }

    /**
     * Get poules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPoules()
    {
        return $this->poules;
    }

    /**
     * Add equipe
     *
     * @param \LCSBundle\Entity\Equipe $equipe
     *
     * @return Competition
     */
    public function addEquipe(\LCSBundle\Entity\Equipe $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe
     *
     * @param \LCSBundle\Entity\Equipe $equipe
     */
    public function removeEquipe(\LCSBundle\Entity\Equipe $equipe)
    {
        $this->equipes->removeElement($equipe);
    }

    /**
     * Get equipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipes()
    {
        return $this->equipes;
    }
}
