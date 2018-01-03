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
     * @var int
     *
     * @ORM\Column(name="scoreEquipeA", type="integer")
     */
    private $scoreEquipeA;

    /**
     * @var int
     *
     * @ORM\Column(name="scoreEquipeB", type="integer")
     */
    private $scoreEquipeB;

    /**
     * @var Time
     *
     * @ORM\Column(name="duree", type="time")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Game", inversedBy="manches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;


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
     * Set scoreEquipeA
     *
     * @param integer $scoreEquipeA
     *
     * @return Manche
     */
    public function setScoreEquipeA($scoreEquipeA)
    {
        $this->scoreEquipeA = $scoreEquipeA;

        return $this;
    }

    /**
     * Get scoreEquipeA
     *
     * @return int
     */
    public function getScoreEquipeA()
    {
        return $this->scoreEquipeA;
    }

    /**
     * Set scoreEquipeB
     *
     * @param integer $scoreEquipeB
     *
     * @return Manche
     */
    public function setScoreEquipeB($scoreEquipeB)
    {
        $this->scoreEquipeB = $scoreEquipeB;

        return $this;
    }

    /**
     * Get scoreEquipeB
     *
     * @return int
     */
    public function getScoreEquipeB()
    {
        return $this->scoreEquipeB;
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
}
