<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Manche
 *
 * @ORM\Table(name="manche")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\MancheRepository")
 */
class Manche
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
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=true)
     */
    private $win;
    
    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=true)
     */
    private $lose;

    /**
     * @var Time
     *
     * @ORM\Column(name="duree", type="time", nullable=true)
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Game", inversedBy="manches")
     * @ORM\JoinColumn(nullable=true)
     */
    private $game;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\StatistiqueEquipe", mappedBy="manche", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistiquesEquipes;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\StatistiqueJoueur", mappedBy="manche", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistiquesJoueurs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->statistiquesEquipes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statistiquesJoueurs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
        return "".$this->id;
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set game
     *
     * @param \LCSBundle\Entity\Game $game
     *
     * @return Manche
     */
    public function setGame(\LCSBundle\Entity\Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \LCSBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set duree
     *
     * @param \DateTime $duree
     *
     * @return Manche
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return \DateTime
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set win
     *
     * @param \LCSBundle\Entity\Equipe $win
     *
     * @return Manche
     */
    public function setWin(\LCSBundle\Entity\Equipe $win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return \LCSBundle\Entity\Equipe
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set lose
     *
     * @param \LCSBundle\Entity\Equipe $lose
     *
     * @return Manche
     */
    public function setLose(\LCSBundle\Entity\Equipe $lose)
    {
        $this->lose = $lose;

        return $this;
    }

    /**
     * Get lose
     *
     * @return \LCSBundle\Entity\Equipe
     */
    public function getLose()
    {
        return $this->lose;
    }
    
    /**
     * Add statistiquesEquipe
     *
     * @param \LCSBundle\Entity\StatistiqueEquipe $statistiquesEquipe
     *
     * @return Game
     */
    public function addStatistiquesEquipe(\LCSBundle\Entity\StatistiqueEquipe $statistiquesEquipe)
    {
        $this->statistiquesEquipes[] = $statistiquesEquipe;

        return $this;
    }

    /**
     * Remove statistiquesEquipe
     *
     * @param \LCSBundle\Entity\StatistiqueEquipe $statistiquesEquipe
     */
    public function removeStatistiquesEquipe(\LCSBundle\Entity\StatistiqueEquipe $statistiquesEquipe)
    {
        $this->statistiquesEquipes->removeElement($statistiquesEquipe);
    }

    /**
     * Get statistiquesEquipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatistiquesEquipes()
    {
        return $this->statistiquesEquipes;
    }

    /**
     * Add statistiquesJoueur
     *
     * @param \LCSBundle\Entity\StatistiqueJoueur $statistiquesJoueur
     *
     * @return Manche
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
}
