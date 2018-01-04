<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\GameRepository")
 */
class Game
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Poule", inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poule;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Tour", inversedBy="games")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tour;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipeA;
    
    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipeB;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\Manche", mappedBy="game")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manches;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->statistiquesJoueurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statistiquesEquipes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->manches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->equipeA.' VS '.$this->equipeB;
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
     * @return Game
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
     * Set description
     *
     * @param string $description
     *
     * @return Game
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
     * Add statistiquesJoueur
     *
     * @param \LCSBundle\Entity\StatistiqueJoueur $statistiquesJoueur
     *
     * @return Game
     */
    public function addStatistiquesJoueur(\LCSBundle\Entity\StatistiqueJoueur $statistiquesJoueur)
    {
        $this->statistiquesJoueurs[] = $statistiquesJoueur;

        return $this;
    }

    /**
     * Remove statistiquesJoueur
     *
     * @param \LCSBundle\Entity\StatistiqueJoueur $statistiquesJoueur
     */
    public function removeStatistiquesJoueur(\LCSBundle\Entity\StatistiqueJoueur $statistiquesJoueur)
    {
        $this->statistiquesJoueurs->removeElement($statistiquesJoueur);
    }

    /**
     * Get statistiquesJoueurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatistiquesJoueurs()
    {
        return $this->statistiquesJoueurs;
    }

    /**
     * Set poule
     *
     * @param \LCSBundle\Entity\Poule $poule
     *
     * @return Game
     */
    public function setPoule(\LCSBundle\Entity\Poule $poule)
    {
        $this->poule = $poule;

        return $this;
    }

    /**
     * Get poule
     *
     * @return \LCSBundle\Entity\Poule
     */
    public function getPoule()
    {
        return $this->poule;
    }

    /**
     * Add manch
     *
     * @param \LCSBundle\Entity\Manche $manch
     *
     * @return Game
     */
    public function addManch(\LCSBundle\Entity\Manche $manch)
    {
        $this->manches[] = $manch;

        return $this;
    }

    /**
     * Remove manch
     *
     * @param \LCSBundle\Entity\Manche $manch
     */
    public function removeManch(\LCSBundle\Entity\Manche $manch)
    {
        $this->manches->removeElement($manch);
    }

    /**
     * Get manches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManches()
    {
        return $this->manches;
    }

    /**
     * Set tour
     *
     * @param \LCSBundle\Entity\Tour $tour
     *
     * @return Game
     */
    public function setTour(\LCSBundle\Entity\Tour $tour)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \LCSBundle\Entity\Tour
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Set equipeA
     *
     * @param \LCSBundle\Entity\Equipe $equipeA
     *
     * @return Game
     */
    public function setEquipeA(\LCSBundle\Entity\Equipe $equipeA)
    {
        $this->equipeA = $equipeA;

        return $this;
    }

    /**
     * Get equipeA
     *
     * @return \LCSBundle\Entity\Equipe
     */
    public function getEquipeA()
    {
        return $this->equipeA;
    }

    /**
     * Set equipeB
     *
     * @param \LCSBundle\Entity\Equipe $equipeB
     *
     * @return Game
     */
    public function setEquipeB(\LCSBundle\Entity\Equipe $equipeB)
    {
        $this->equipeB = $equipeB;

        return $this;
    }

    /**
     * Get equipeB
     *
     * @return \LCSBundle\Entity\Equipe
     */
    public function getEquipeB()
    {
        return $this->equipeB;
    }
    
    public function getScoreEquipeA() {
        $cpt = 0;
        foreach($this->manches as $manche) {
            if($manche->getWin() == $this->getEquipeA()) {
                $cpt++;
            }
        }
    }
    
    public function getScoreEquipeB() {
        $cpt = 0;
        foreach($this->manches as $manche) {
            if($manche->getWin() == $this->getEquipeB()) {
                $cpt++;
            }
        }
    }
}
