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
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLimiteInscription", type="date", nullable=true)
     */
    private $dateLimiteInscription;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEquipeMin", type="integer", nullable=false)
     */
    private $nbEquipeMin;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEquipeMax", type="integer", nullable=false)
     */
    private $nbEquipeMax;

    /**
     * @var int
     *
     * @ORM\Column(name="nbEquipeSortantes", type="integer", nullable=false)
     */
    //private $nbEquipeSortantes;*/

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allowCaptainRegister", type="boolean")
     */
    private $allowCaptainRegister;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isGroupMatchesGenerated", type="boolean")
     */
    private $isGroupMatchesGenerated;

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
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\Tour", mappedBy="competition")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tours;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateDebut = new \DateTime();
        $this->poules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->nom;
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

    /**
     * Set allowCaptainRegister
     *
     * @param boolean $allowCaptainRegister
     *
     * @return Competition
     */
    public function setAllowCaptainRegister($allowCaptainRegister)
    {
        $this->allowCaptainRegister = $allowCaptainRegister;

        return $this;
    }

    /**
     * Get allowCaptainRegister
     *
     * @return boolean
     */
    public function getAllowCaptainRegister()
    {
        return $this->allowCaptainRegister;
    }

    /**
     * Set dateLimiteInscription
     *
     * @param \DateTime $dateLimiteInscription
     *
     * @return Competition
     */
    public function setDateLimiteInscription($dateLimiteInscription)
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    /**
     * Get dateLimiteInscription
     *
     * @return \DateTime
     */
    public function getDateLimiteInscription()
    {
        return $this->dateLimiteInscription;
    }

    /**
     * Add tour
     *
     * @param \LCSBundle\Entity\Tour $tour
     *
     * @return Competition
     */
    public function addTour(\LCSBundle\Entity\Tour $tour)
    {
        $this->tours[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param \LCSBundle\Entity\Tour $tour
     */
    public function removeTour(\LCSBundle\Entity\Tour $tour)
    {
        $this->tours->removeElement($tour);
    }

    /**
     * Get tours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTours()
    {
        return $this->tours;
    }

    /**
     * Set isGroupMatchesGenerated
     *
     * @param boolean $isGroupMatchesGenerated
     *
     * @return Competition
     */
    public function setIsGroupMatchesGenerated($isGroupMatchesGenerated)
    {
        $this->isGroupMatchesGenerated = $isGroupMatchesGenerated;

        return $this;
    }

    /**
     * Get isGroupMatchesGenerated
     *
     * @return boolean
     */
    public function getIsGroupMatchesGenerated()
    {
        return $this->isGroupMatchesGenerated;
    }
}
