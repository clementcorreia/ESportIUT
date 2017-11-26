<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="LCSBundle\Entity\Joueur", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $joueur;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = array('ROLE_JOUEUR');
    }

    /**
     * Set joueur
     *
     * @param \LCSBundle\Entity\Joueur $joueur
     *
     * @return User
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
}
