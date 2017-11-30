<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\JoueurRepository")
 */
class Joueur
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
     * @ORM\Column(name="pseudo", type="string", length=30, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Poste")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poste;

    /**
     * @ORM\ManyToOne(targetEntity="LCSBundle\Entity\Rang")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rang;

    /**
     * @ORM\OneToMany(targetEntity="LCSBundle\Entity\StatistiqueJoueur", mappedBy="joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistiques;

    /**
     * Affichage de l'objet
     */
    public function __toString()
    {
        return $this->pseudo;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->statistiques = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Joueur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Joueur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Joueur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Joueur
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
     * Set poste
     *
     * @param \LCSBundle\Entity\Poste $poste
     *
     * @return Joueur
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
     * Set rang
     *
     * @param \LCSBundle\Entity\Rang $rang
     *
     * @return Joueur
     */
    public function setRang(\LCSBundle\Entity\Rang $rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return \LCSBundle\Entity\Rang
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Add statistique
     *
     * @param \LCSBundle\Entity\StatistiqueJoueur $statistique
     *
     * @return Joueur
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
