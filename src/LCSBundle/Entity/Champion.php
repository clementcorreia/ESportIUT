<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Champion
 *
 * @ORM\Table(name="champion")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\ChampionRepository")
 */
class Champion
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
     * @ORM\Column(name="nom", type="string", length=20, unique=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\StatistiqueJoueur", mappedBy="champion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistiques;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return Champion
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
     * Add statistique
     *
     * @param \LCSBundle\Entity\StatistiqueJoueur $statistique
     *
     * @return Champion
     */
    public function addStatistique(\LCSBundle\Entity\StatistiqueJoueur $statistique)
    {
        $this->statistiques[] = $statistique;

        return $this;
    }

    /**
     * Remove statistique
     *
     * @param \LCSBundle\Entity\StatistiqueJoueur $statistique
     */
    public function removeStatistique(\LCSBundle\Entity\StatistiqueJoueur $statistique)
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
