<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {

        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');
    // generate data by calling methods
        $user = new User();
        $user->setUsername($faker->name());
        $user->setEmail('usertest@gmail.com');
        $user->setRoles(array('ROLE_ADMIN'));

        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);
        $manager->persist($user);

        $tabG=  array();
        for($i=0;$i<10;$i++){
            $genre=new Genre();
            $genre->setNom($faker->sentence(2,true));
            $tabG[$i]=$genre;
            $manager->persist($genre);
        }
        $tabA=array();
        for ($i=0;$i<20;$i++){
            $gender = $faker->randomElement(['male', 'female']);
            $auteur=new Auteur();
            $auteur->setNomPrenom($faker->name($gender));
            $auteur->setDateNaissance($faker->dateTimeBetween('-90 years','-30',null));
            if($gender=='male') $auteur->setSexe("M");
            else $auteur->setSexe("F");
            $auteur->setNationalite($faker->country());
            $tabA[$i]=$auteur;
            $manager->persist($auteur);

        }
        for($i=0;$i<50;$i++){
            $livre=new Livre();
            $livre->setIsbn($faker->isbn13());
            $livre->setTitre($faker->sentence(6,true));
            $livre->setNombrePages($faker->randomNumber(3,false));
            $livre->setDateParution(($faker->dateTimeBetween('-121 years','now')));
            $livre->setNote($faker->randomFloat(2,0,20));
            $livre->setUser($user);
           $lenghtA=random_int(1,3);
            $lenghtG=random_int(1,3);
            for($j=0;$j<$lenghtA;$j++){
                $livre->addAuteur($tabA[random_int(0,19)]);
            }
            for($j=0;$j<$lenghtG;$j++){
                $livre->addGenre($tabG[random_int(0,9)]);
            }

            $manager->persist($livre);

        }



        $manager->flush();
    }
}
