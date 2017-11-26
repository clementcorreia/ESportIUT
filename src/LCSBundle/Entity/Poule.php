<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poule
 *
 * @ORM\Table(name="poule")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\PouleRepository")
 */
class Poule
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
     * @ORM\Column(name="nom", type="string", length=20)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Competition", inversedBy="poules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;
    
    /**
     * @ORM\ManyToMany(targetEntity="LCSBundle\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipes;
    
    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\Game", mappedBy="poule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $games;
    

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Poule
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
     * Set type
     *
     * @param integer $type
     *
     * @return Poule
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set competition
     *
     * @param \LCSBundle\Entity\Competition $competition
     *
     * @return Poule
     */
    public function setCompetition(\LCSBundle\Entity\Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \LCSBundle\Entity\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Add equipe
     *
     * @param \LCSBundle\Entity\Equipe $equipe
     *
     * @return Poule
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
     * Add game
     *
     * @param \LCSBundle\Entity\Game $game
     *
     * @return Poule
     */
    public function addGame(\LCSBundle\Entity\Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \LCSBundle\Entity\Game $game
     */
    public function removeGame(\LCSBundle\Entity\Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
}
