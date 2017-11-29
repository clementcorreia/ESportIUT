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
class LoadUserBundleEntityUser extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Set loading order.
     *
     * @return int
     */
    public function getOrder()
    {
        return 2;
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
        $item1->setPassword("\$2y\$13\$vuggHX54WKpG27YymdoO7Og7ySwWs55NqgWDmHmjTRc/njNgTjG7a");
        $item1->setLastLogin(new \DateTime("2017-11-24 14:39:11"));

        $manager->persist($item1);

    
        $manager->flush();
    }

}
