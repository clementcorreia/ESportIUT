<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\EquipeRepository")
 */
class Equipe
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
     * @var string
     *
     * @ORM\Column(name="slogan", type="string", length=255, nullable=true)
     */
    private $slogan;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $capitaine;

    /**
     * @ORM\ManyToMany(targetEntity="LCSBundle\Entity\Joueur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueurs;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\StatistiqueEquipe", mappedBy="equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistiques;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->joueurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statistiques = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Equipe
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
     * Set slogan
     *
     * @param string $slogan
     *
     * @return Equipe
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }

    /**
     * Get slogan
     *
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Equipe
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
     * Set capitaine
     *
     * @param \LCSBundle\Entity\Joueur $capitaine
     *
     * @return Equipe
     */
    public function setCapitaine(\LCSBundle\Entity\Joueur $capitaine)
    {
        $this->capitaine = $capitaine;

        return $this;
    }

    /**
     * Get capitaine
     *
     * @return \LCSBundle\Entity\Joueur
     */
    public function getCapitaine()
    {
        return $this->capitaine;
    }

    /**
     * Add joueur
     *
     * @param \LCSBundle\Entity\Joueur $joueur
     *
     * @return Equipe
     */
    public function addJoueur(\LCSBundle\Entity\Joueur $joueur)
    {
        $this->joueurs[] = $joueur;

        return $this;
    }

    /**
     * Remove joueur
     *
     * @param \LCSBundle\Entity\Joueur $joueur
     */
    public function removeJoueur(\LCSBundle\Entity\Joueur $joueur)
    {
        $this->joueurs->removeElement($joueur);
    }

    /**
     * Get joueurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }

    /**
     * Add statistique
     *
     * @param \LCSBundle\Entity\StatistiqueEquipe $statistique
     *
     * @return Equipe
     */
    public function addStatistique(\LCSBundle\Entity\StatistiqueEquipe $statistique)
    {
        $this->statistiques[] = $statistique;

        return $this;
    }

    /**
     * Remove statistique
     *
     * @param \LCSBundle\Entity\StatistiqueEquipe $statistique
     */
    public function removeStatistique(\LCSBundle\Entity\StatistiqueEquipe $statistique)
    {
        $this->statistiques->removeElement($statistique);
    }

    /**
     * Get statistiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatistiques()
    {
        return $this->statistiques;
    }
}
