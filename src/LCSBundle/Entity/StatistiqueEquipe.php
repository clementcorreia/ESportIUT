<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatistiqueEquipe
 *
 * @ORM\Table(name="statistique_equipe")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\StatistiqueEquipeRepository")
 */
class StatistiqueEquipe
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
     * @ORM\Column(name="barons", type="integer", nullable=true)
     */
    private $barons;

    /**
     * @var int
     *
     * @ORM\Column(name="drakes", type="integer", nullable=true)
     */
    private $drakes;

    /**
     * @var int
     *
     * @ORM\Column(name="tours", type="integer", nullable=true)
     */
    private $tours;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Game", inversedBy="statistiquesEquipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Equipe", inversedBy="statistiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipe;
    

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
     * Set barons
     *
     * @param integer $barons
     *
     * @return StatistiqueEquipe
     */
    public function setBarons($barons)
    {
        $this->barons = $barons;

        return $this;
    }

    /**
     * Get barons
     *
     * @return integer
     */
    public function getBarons()
    {
        return $this->barons;
    }

    /**
     * Set drakes
     *
     * @param integer $drakes
     *
     * @return StatistiqueEquipe
     */
    public function setDrakes($drakes)
    {
        $this->drakes = $drakes;

        return $this;
    }

    /**
     * Get drakes
     *
     * @return integer
     */
    public function getDrakes()
    {
        return $this->drakes;
    }

    /**
     * Set tours
     *
     * @param integer $tours
     *
     * @return StatistiqueEquipe
     */
    public function setTours($tours)
    {
        $this->tours = $tours;

        return $this;
    }

    /**
     * Get tours
     *
     * @return integer
     */
    public function getTours()
    {
        return $this->tours;
    }

    /**
     * Set game
     *
     * @param \LCSBundle\Entity\Game $game
     *
     * @return StatistiqueEquipe
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
     * Set equipe
     *
     * @param \LCSBundle\Entity\Equipe $equipe
     *
     * @return StatistiqueEquipe
     */
    public function setEquipe(\LCSBundle\Entity\Equipe $equipe)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \LCSBundle\Entity\Equipe
     */
    public function getEquipe()
    {
        return $this->equipe;
    }
}
