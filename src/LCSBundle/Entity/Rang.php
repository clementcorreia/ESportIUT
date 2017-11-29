<?php

namespace LCSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rang
 *
 * @ORM\Table(name="rang")
 * @ORM\Entity(repositoryClass="LCSBundle\Repository\RangRepository")
 */
class Rang
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
     * @ORM\Column(name="nom", type="string", length=15, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=7, unique=true)
     */
    private $couleur;

    /**
     * @var int
     *
     * @ORM\Column(name="valeur", type="integer", unique=true)
     */
    private $valeur;


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
     * @return Rang
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
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Rang
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set valeur
     *
     * @param integer $valeur
     *
     * @return Rang
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return int
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}

