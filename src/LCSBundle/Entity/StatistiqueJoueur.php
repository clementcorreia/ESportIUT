<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique_joueur")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\StatistiqueRepository")
 */
class StatistiqueJoueur
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
     * @ORM\Column(name="deaths", type="integer", nullable=true)
     */
    private $deaths;

    /**
     * @var int
     *
     * @ORM\Column(name="assists", type="integer", nullable=true)
     */
    private $assists;

    /**
     * @var int
     *
     * @ORM\Column(name="degats", type="integer", nullable=true)
     */
    private $degats;

    /**
     * @var int
     *
     * @ORM\Column(name="controlWard", type="integer", nullable=true)
     */
    private $controlWard;

    /**
     * @var int
     *
     * @ORM\Column(name="balisesPlacees", type="integer", nullable=true)
     */
    private $balisesPlacees;

    /**
     * @var int
     *
     * @ORM\Column(name="balisesDetruites", type="integer", nullable=true)
     */
    private $balisesDetruites;

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
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Champion", inversedBy="statistiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $champion;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Poste")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poste;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Manche", inversedBy="statistiquesJoueurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manche;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Joueur", inversedBy="statistiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur;
    

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
     * Set kills
     *
     * @param integer $kills
     *
     * @return StatistiqueJoueur
     */
    public function setKills($kills)
    {
        $this->kills = $kills;

        return $this;
    }

    /**
     * Get kills
     *
     * @return integer
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set deaths
     *
     * @param integer $deaths
     *
     * @return StatistiqueJoueur
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }

    /**
     * Get deaths
     *
     * @return integer
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     *
     * @return StatistiqueJoueur
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return integer
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set degats
     *
     * @param integer $degats
     *
     * @return StatistiqueJoueur
     */
    public function setDegats($degats)
    {
        $this->degats = $degats;

        return $this;
    }

    /**
     * Get degats
     *
     * @return integer
     */
    public function getDegats()
    {
        return $this->degats;
    }

    /**
     * Set controlWard
     *
     * @param integer $controlWard
     *
     * @return StatistiqueJoueur
     */
    public function setControlWard($controlWard)
    {
        $this->controlWard = $controlWard;

        return $this;
    }

    /**
     * Get controlWard
     *
     * @return integer
     */
    public function getControlWard()
    {
        return $this->controlWard;
    }

    /**
     * Set balisesPlacees
     *
     * @param integer $balisesPlacees
     *
     * @return StatistiqueJoueur
     */
    public function setBalisesPlacees($balisesPlacees)
    {
        $this->balisesPlacees = $balisesPlacees;

        return $this;
    }

    /**
     * Get balisesPlacees
     *
     * @return integer
     */
    public function getBalisesPlacees()
    {
        return $this->balisesPlacees;
    }

    /**
     * Set balisesDetruites
     *
     * @param integer $balisesDetruites
     *
     * @return StatistiqueJoueur
     */
    public function setBalisesDetruites($balisesDetruites)
    {
        $this->balisesDetruites = $balisesDetruites;

        return $this;
    }

    /**
     * Get balisesDetruites
     *
     * @return integer
     */
    public function getBalisesDetruites()
    {
        return $this->balisesDetruites;
    }

    /**
     * Set cs
     *
     * @param integer $cs
     *
     * @return StatistiqueJoueur
     */
    public function setCs($cs)
    {
        $this->cs = $cs;

        return $this;
    }

    /**
     * Get cs
     *
     * @return integer
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
     * @return StatistiqueJoueur
     */
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get gold
     *
     * @return integer
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set champion
     *
     * @param \LCSBundle\Entity\Champion $champion
     *
     * @return StatistiqueJoueur
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

    /**
     * Set poste
     *
     * @param \LCSBundle\Entity\Poste $poste
     *
     * @return StatistiqueJoueur
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
     * Set game
     *
     * @param \LCSBundle\Entity\Game $game
     *
     * @return StatistiqueJoueur
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
     * Set joueur
     *
     * @param \LCSBundle\Entity\Joueur $joueur
     *
     * @return StatistiqueJoueur
     */
    public function setJoueur(\LCSBundle\Entity\Joueur $joueur)
    {
        $this->joueur = $joueur;

        return $this;
    }

    /**
     * Get joueur
     *
     * @return \LCSBundle\Entity\Joueur
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * Set manche
     *
     * @param \LCSBundle\Entity\Manche $manche
     *
     * @return StatistiqueJoueur
     */
    public function setManche(\LCSBundle\Entity\Manche $manche)
    {
        $this->manche = $manche;

        return $this;
    }

    /**
     * Get manche
     *
     * @return \LCSBundle\Entity\Manche
     */
    public function getManche()
    {
        return $this->manche;
    }
}
