<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $supAdmin = new Role();
        $supAdmin->setLib("SUP_ADMIN");
        $manager->persist($supAdmin);

        $Admin = new Role();
        $Admin->setLib("ADMIN");
        $manager->persist($Admin);

        $Caissier = new Role();
        $Caissier->setLib("CAISSIER");
        $manager->persist($Caissier);

        $partenaire = new Role();
        $partenaire->setLib("PARTENAIRE");
        $manager->persist($partenaire);

        $manager->flush();

        $this->addReference('role_sup_admin', $supAdmin);
        $this->addReference('role_admin', $Admin);
        $this->addReference('role_caissier', $Caissier);
        $this->addReference('role_partenaire', $Caissier);

        $rolAdmin = $this->getReference('role_sup_admin');
        $rolSupAdmin = $this->getReference('role_admin');
        $rolCaissier = $this->getReference('role_caissier');
        $rolPartenaire = $this->getReference('role_partenaire');
        
        $user = new User();
        // $user->setRoles(json_encode(array("SUPER_ADMIN")));
        $user->setEmail("mame@gmail.com");
        $user->setPassword($this->passwordEncoder->encodePassword($user, "mame"));
        $user->setRole($rolAdmin);
        $user->setPrenom("Mame fatou");
        $user->setIsActive(TRUE);
        $user->setnom("ngom");
        $user->setimages("n.jpg");
        $manager->persist($user);
        $manager->flush();
    }

  
}
