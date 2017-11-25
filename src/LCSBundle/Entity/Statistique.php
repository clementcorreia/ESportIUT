<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\StatistiqueRepository")
 */
class Statistique
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
     * @ORM\Column(name="kills", type="integer", nullable=true)
     */
    private $kills;

    /**
     * @var int
     *
     * @ORM\Column(name="assists", type="integer", nullable=true)
     */
    private $assists;

    /**
     * @var int
     *
     * @ORM\Column(name="deaths", type="integer", nullable=true)
     */
    private $deaths;

    /**
     * @var int
     *
     * @ORM\Column(name="cs", type="integer", nullable=true)
     */
    private $cs;

    /**
     * @var int
     *
     * @ORM\Column(name="gold", type="integer", nullable=true)
     */
    private $gold;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Game", inversedBy="statistiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Poste")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poste;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Champion", inversedBy="statistiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $champion;


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
     * Set kills
     *
     * @param integer $kills
     *
     * @return Statistique
     */
    public function setKills($kills)
    {
        $this->kills = $kills;

        return $this;
    }

    /**
     * Get kills
     *
     * @return int
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     *
     * @return Statistique
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return int
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set deaths
     *
     * @param integer $deaths
     *
     * @return Statistique
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }

    /**
     * Get deaths
     *
     * @return int
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set cs
     *
     * @param integer $cs
     *
     * @return Statistique
     */
    public function setCs($cs)
    {
        $this->cs = $cs;

        return $this;
    }

    /**
     * Get cs
     *
     * @return int
     */
    public function getCs()
    {
        return $this->cs;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     *
     * @return Statistique
     */
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get gold
     *
     * @return int
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set game
     *
     * @param \LCSBundle\Entity\Game $game
     *
     * @return Statistique
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
     * Set poste
     *
     * @param \LCSBundle\Entity\Poste $poste
     *
     * @return Statistique
     */
    public function setPoste(\LCSBundle\Entity\Poste $poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return \LCSBundle\Entity\Poste
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set champion
     *
     * @param \LCSBundle\Entity\Champion $champion
     *
     * @return Statistique
     */
    public function setChampion(\LCSBundle\Entity\Champion $champion)
    {
        $this->champion = $champion;

        return $this;
    }

    /**
     * Get champion
     *
     * @return \LCSBundle\Entity\Champion
     */
    public function getChampion()
    {
        return $this->champion;
    }
}
