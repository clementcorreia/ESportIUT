<?php

namespace LCSBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use LCSBundle\Entity\Joueur;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 *
 */
class LoadJoueur extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Set loading order.
     *
     * @return int
     */
    public function getOrder()
    {
        return ;
    }


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Joueur::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item17 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur17', $item17);
        $item17->setPseudo("ThePowerVoid");
        $item17->setNom("Vannier");
        $item17->setPrenom("Pierre");
        $item17->setPoste($this->getReference('_reference_LCSBundleEntityPoste83'));
        $item17->setRang($this->getReference('_reference_LCSBundleEntityRang82'));

        $manager->persist($item17);

        $item18 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur18', $item18);
        $item18->setPseudo("Spk Angelus");
        $item18->setNom("Lopez");
        $item18->setPrenom("Rémi");
        $item18->setPoste($this->getReference('_reference_LCSBundleEntityPoste81'));
        $item18->setRang($this->getReference('_reference_LCSBundleEntityRang81'));

        $manager->persist($item18);

        $item19 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur19', $item19);
        $item19->setPseudo("Toutruche");
        $item19->setNom("Mazel");
        $item19->setPrenom("Guilhem");
        $item19->setPoste($this->getReference('_reference_LCSBundleEntityPoste85'));
        $item19->setRang($this->getReference('_reference_LCSBundleEntityRang84'));

        $manager->persist($item19);

        $item20 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur20', $item20);
        $item20->setPseudo("Howrus");
        $item20->setNom("Morandini");
        $item20->setPrenom("Eric");
        $item20->setPoste($this->getReference('_reference_LCSBundleEntityPoste82'));
        $item20->setRang($this->getReference('_reference_LCSBundleEntityRang82'));

        $manager->persist($item20);

        $item21 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur21', $item21);
        $item21->setPseudo("Lamouche XXI");
        $item21->setNom("Cisterne");
        $item21->setPrenom("Clément");
        $item21->setPoste($this->getReference('_reference_LCSBundleEntityPoste84'));
        $item21->setRang($this->getReference('_reference_LCSBundleEntityRang82'));

        $manager->persist($item21);

        $item27 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur27', $item27);
        $item27->setPseudo("Evilox");
        $item27->setNom("grard");
        $item27->setPrenom("corentin");
        $item27->setPoste($this->getReference('_reference_LCSBundleEntityPoste81'));
        $item27->setRang($this->getReference('_reference_LCSBundleEntityRang83'));

        $manager->persist($item27);

        $item28 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur28', $item28);
        $item28->setPseudo("Nnoitra Jirga");
        $item28->setNom("reynaud");
        $item28->setPrenom("erwan");
        $item28->setPoste($this->getReference('_reference_LCSBundleEntityPoste85'));
        $item28->setRang($this->getReference('_reference_LCSBundleEntityRang82'));

        $manager->persist($item28);

        $item29 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur29', $item29);
        $item29->setPseudo("Retto74");
        $item29->setNom("rakotorina");
        $item29->setPrenom("joyss");
        $item29->setPoste($this->getReference('_reference_LCSBundleEntityPoste82'));
        $item29->setRang($this->getReference('_reference_LCSBundleEntityRang82'));

        $manager->persist($item29);

        $item30 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur30', $item30);
        $item30->setPseudo("MatCom974");
        $item30->setNom("commins");
        $item30->setPrenom("matthieu");
        $item30->setPoste($this->getReference('_reference_LCSBundleEntityPoste83'));
        $item30->setRang($this->getReference('_reference_LCSBundleEntityRang79'));

        $manager->persist($item30);

        $item31 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur31', $item31);
        $item31->setPseudo("NightYano");
        $item31->setNom("dejesus-martin");
        $item31->setPrenom("david");
        $item31->setPoste($this->getReference('_reference_LCSBundleEntityPoste84'));
        $item31->setRang($this->getReference('_reference_LCSBundleEntityRang79'));

        $manager->persist($item31);

        $item32 = new Joueur();
        $this->addReference('_reference_LCSBundleEntityJoueur32', $item32);
        $item32->setPseudo("Mornyan");
        $item32->setNom("phun-vong");
        $item32->setPrenom("morgane");
        $item32->setPoste($this->getReference('_reference_LCSBundleEntityPoste84'));
        $item32->setRang($this->getReference('_reference_LCSBundleEntityRang82'));

        $manager->persist($item32);

    
        $manager->flush();
    }

}
