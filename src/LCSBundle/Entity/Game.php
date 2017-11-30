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
     * @ORM\Column(name="numero", type="string", length=10, unique=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\StatistiqueJoueur", mappedBy="game")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistiquesJoueurs;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\StatistiqueEquipe", mappedBy="game")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistiquesEquipes;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Poule", inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poule;

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
        $this->statistiquesJoueurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statistiquesEquipes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numero
     *
     * @param string $numero
     *
     * @return Game
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
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
     * Add equipe
     *
     * @param \LCSBundle\Entity\Equipe $equipe
     *
     * @return Game
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
