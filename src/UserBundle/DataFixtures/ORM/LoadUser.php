<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use UserBundle\Entity\User;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 *
 */
class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Set loading order.
     *
     * @return int
     */
    public function getOrder()
    {
        return 4;
    }


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(User::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = new User();
        $this->addReference('_reference_UserBundleEntityUser1', $item1);
        $item1->setUsername("clement");
        $item1->setUsernameCanonical("clement");
        $item1->setEmail("clement.correia34@gmail.com");
        $item1->setEmailCanonical("clement.correia34@gmail.com");
        $item1->setEnabled(true);
        $item1->setPassword("\$2y\$13\$InU//vDp1bSZGuaF7mfQZOMQYs4z8LXOXH3qeYfGEk84cWdYj7IzG");
        $item1->setLastLogin(new \DateTime("2017-11-29 13:37:05"));
        $item1->setRoles(unserialize('a:1:{i:0;s:10:"ROLE_ADMIN";}'));

        $manager->persist($item1);

        $item3 = new User();
        $this->addReference('_reference_UserBundleEntityUser3', $item3);
        $item3->setJoueur($this->getReference('_reference_LCSBundleEntityJoueur8'));
        $item3->setUsername("vannier");
        $item3->setUsernameCanonical("vannier");
        $item3->setEmail("thepv66@gmail.com");
        $item3->setEmailCanonical("thepv66@gmail.com");
        $item3->setEnabled(true);
        $item3->setPassword("\$2y\$13\$RhuNlxMkrAp1/qPr0biTeOyds38KhueTwRmbSI50SzsIQ4Mvutj7i");
        $item3->setLastLogin(new \DateTime("2017-11-27 12:18:51"));
        $item3->setRoles(unserialize('a:1:{i:0;s:10:"ROLE_ADMIN";}'));

        $manager->persist($item3);

        $item7 = new User();
        $this->addReference('_reference_UserBundleEntityUser7', $item7);
        $item7->setJoueur($this->getReference('_reference_LCSBundleEntityJoueur13'));
        $item7->setUsername("lopez");
        $item7->setUsernameCanonical("lopez");
        $item7->setEmail("remi.lopez@etu.umontpellier.fr");
        $item7->setEmailCanonical("remi.lopez@etu.umontpellier.fr");
        $item7->setPassword("\$2y\$13\$lXHoB8iRIWLZ8tC.5lMfuOQBKNUyvQgipc7Qh9kU2fpn6qwyU59ri");

        $manager->persist($item7);

        $item8 = new User();
        $this->addReference('_reference_UserBundleEntityUser8', $item8);
        $item8->setJoueur($this->getReference('_reference_LCSBundleEntityJoueur14'));
        $item8->setUsername("mazel");
        $item8->setUsernameCanonical("mazel");
        $item8->setEmail("guilhem.mazel@etu.umontpellier.fr");
        $item8->setEmailCanonical("guilhem.mazel@etu.umontpellier.fr");
        $item8->setPassword("\$2y\$13\$.a7lbyM2Oz.b6RpqrcYmiuVUKquxDECFnMxY1ekrxJnDnNlarx5rW");

        $manager->persist($item8);

        $item9 = new User();
        $this->addReference('_reference_UserBundleEntityUser9', $item9);
        $item9->setJoueur($this->getReference('_reference_LCSBundleEntityJoueur15'));
        $item9->setUsername("morandini");
        $item9->setUsernameCanonical("morandini");
        $item9->setEmail("eric.morandini@etu.umontpellier.fr");
        $item9->setEmailCanonical("eric.morandini@etu.umontpellier.fr");
        $item9->setPassword("\$2y\$13\$XYwkeLjVkZiKc/Gfq/A4NuRgLueJsdqPJmuf/ZNGcK5B5v8ZuEcLS");
        $item9->setRoles(unserialize('a:1:{i:0;s:10:"ROLE_ADMIN";}'));

        $manager->persist($item9);

        $item10 = new User();
        $this->addReference('_reference_UserBundleEntityUser10', $item10);
        $item10->setJoueur($this->getReference('_reference_LCSBundleEntityJoueur16'));
        $item10->setUsername("cisterne");
        $item10->setUsernameCanonical("cisterne");
        $item10->setEmail("clement.cisterne@etu.umontpellier.fr");
        $item10->setEmailCanonical("clement.cisterne@etu.umontpellier.fr");
        $item10->setPassword("\$2y\$13\$94nVY6IU9Zb4eA4NyDPiuua2ANXpTs0.EavimzemZhk/NP3LFUihu");

        $manager->persist($item10);

    
        $manager->flush();
    }

}
