<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $counter = 4;
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ){}
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        // we create a user "ADMIN" for demo
        $user = new User();
        $user->setEmail('admin@test.fr');
        $user->setFirstname('John');
        $user->setLastname('DOE');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setIsVerified(true);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'admin')        );
        $this->addReference('user-1', $user);
        $manager->persist($user);

        // we create a user "EMPLOYE" for demo
        $user = new User();
        $user->setEmail('employe@test.fr');
        $user->setFirstname('Jean');
        $user->setLastname('FORT');
        $user->setRoles(["ROLE_EMPLOYE"]);
        $user->setIsVerified(true);
        $user->setPassword( $this->passwordEncoder->hashPassword($user, 'employe')        );
        $this->addReference('user-2', $user);
        $manager->persist($user);

        // we create a user "VETERINAIRE" for demo
        $user = new User();
        $user->setEmail('veterinaire@test.fr');
        $user->setFirstname('Jeanne');
        $user->setLastname('FORTE');
        $user->setRoles(["ROLE_VETERINAIRE"]);
        $user->setIsVerified(true);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'veterinaire')        );
        $this->addReference('user-3', $user);
        $manager->persist($user);

        // we create 3 users "VETERINAIRE"
        for ($i = 2; $i <= 5; $i++)
        {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setRoles(["ROLE_VETERINAIRE"]);
            $user->setIsVerified(true);
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'secret')        );
            $this->addReference('user-'.$this->counter, $user);
            $this->counter++;
            $manager->persist($user);
        }
        // we create 10 users "EMPLOYE"
        for ($i = 2; $i <=10; $i++)
        {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setRoles(["ROLE_EMPLOYE"]);
            $user->setIsVerified(true);
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'secret')        );
            $this->addReference('employe-'.$this->counter, $user);
            $this->counter++;
            $manager->persist($user);
        }
        // we create an users "EMPLOYE" not verified

        $user = new User();
        $user->setFirstname($faker->firstName);
        $user->setLastname($faker->lastName);
        $user->setEmail($faker->email);
        $user->setRoles(["ROLE_EMPLOYE"]);
        $user->setIsVerified(false);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'secret')        );
        $this->addReference('employe-'.$this->counter, $user);
        $this->counter++;
        $manager->persist($user);

        // We send the data to the database
        $manager->flush();
    }
}
