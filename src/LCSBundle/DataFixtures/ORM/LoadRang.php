<?php

namespace LCSBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use LCSBundle\Entity\Rang;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 *
 */
class LoadRang extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Set loading order.
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Rang::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = new Rang();
        $this->addReference('_reference_LCSBundleEntityRang1', $item1);
        $item1->setNom("Unranked");
        $item1->setCouleur("#FFFFFF");
        $item1->setValeur(0);

        $manager->persist($item1);

        $item2 = new Rang();
        $this->addReference('_reference_LCSBundleEntityRang2', $item2);
        $item2->setNom("Bronze");
        $item2->setCouleur("#7F6000");
        $item2->setValeur(1);

        $manager->persist($item2);

        $item3 = new Rang();
        $this->addReference('_reference_LCSBundleEntityRang3', $item3);
        $item3->setNom("Silver");
        $item3->setCouleur("#CCCCCC");
        $item3->setValeur(2);

        $manager->persist($item3);

        $item4 = new Rang();
        $this->addReference('_reference_LCSBundleEntityRang4', $item4);
        $item4->setNom("Gold");
        $item4->setCouleur("#F1C232");
        $item4->setValeur(3);

        $manager->persist($item4);

        $item5 = new Rang();
        $this->addReference('_reference_LCSBundleEntityRang5', $item5);
        $item5->setNom("Platine");
        $item5->setCouleur("#00FFFF");
        $item5->setValeur(4);

        $manager->persist($item5);

        $item6 = new Rang();
        $this->addReference('_reference_LCSBundleEntityRang6', $item6);
        $item6->setNom("Diamant");
        $item6->setCouleur("#4A86E8");
        $item6->setValeur(5);

        $manager->persist($item6);

    
        $manager->flush();
    }

}