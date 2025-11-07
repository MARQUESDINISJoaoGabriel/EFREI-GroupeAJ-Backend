<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Ecurie;
use App\Entity\Pilote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        /////////////////// ADMIN ///////////////////
        $admin = new User();
        $admin->setEmail('admin@f1api.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        $ecuriesData = [
            ['Ferrari', 'Ferrari Engine'],
            ['Red Bull Racing', 'Honda'],
            ['Mercedes AMG', 'Mercedes']
        ];


        ////////////////// ECURIES  ///////////////////
        $ecuries = [];

        foreach ($ecuriesData as [$nom, $moteur]) {
            $ecurie = new Ecurie();
            $ecurie->setNom($nom);
            $ecurie->setMoteur($moteur);
            $manager->persist($ecurie);
            $ecuries[] = $ecurie;
        }
        ////////////////// PILOTES  ///////////////////
        $prenoms = ['Charles', 'Carlos', 'Max', 'Sergio', 'Lewis', 'George', 'Pierre', 'Lando', 'Fernando']; 
        $noms = ['Leclerc', 'Sainz', 'Verstappen', 'Pérez', 'Hamilton', 'Russell', 'Gasly', 'Norris', 'Alonso'];

        $i = 0; 
        foreach ($ecuries as $ecurie) { // 3 par écuries
            for ($j = 0; $j < 3; $j++) {
                $pilote = new Pilote();
                $pilote->setPrenom($prenoms[$i % count($prenoms)]);
                $pilote->setNom($noms[$i % count($noms)]);
                $pilote->setPoints(12);
                $pilote->setStatut($j == 2 ? 'réserviste' : 'titulaire');
                $pilote->setDateDebutF1(new \DateTime('20' . rand(10, 20) . '-01-01'));
                $pilote->setEcurie($ecurie);
                $manager->persist($pilote);
                $i++;
            }
        }

        $manager->flush();
    }
}
