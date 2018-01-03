<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tour
 *
 * @ORM\Table(name="tour")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\TourRepository")
 */
class Tour
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var \Date
     *
     * @ORM\Column(name="semaine", type="date", nullable=true)
     */
    private $semaine;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\Game", mappedBy="tour")
     * @ORM\JoinColumn(nullable=false)
     */
    private $games;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Competition", inversedBy="tours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;
    
    public function __toString() {
        return $this->nom;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Tour
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
     * Set semaine
     *
     * @param \DateTime $semaine
     *
     * @return Tour
     */
    public function setSemaine($semaine)
    {
        $this->semaine = $semaine;

        return $this;
    }

    /**
     * Get semaine
     *
     * @return \DateTime
     */
    public function getSemaine()
    {
        return $this->semaine;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add game
     *
     * @param \LCSBundle\Entity\Game $game
     *
     * @return Tour
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

    /**
     * Set competition
     *
     * @param \LCSBundle\Entity\Competition $competition
     *
     * @return Tour
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
}
