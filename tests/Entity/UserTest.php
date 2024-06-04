<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testSetGetFirstname()
    {
        // we create an instance of User
        $user = new User();

        // we assign a name to this instance
        $user->setFirstname('Firstname');

        // We check that the method returns the correct value
        $this->assertEquals('Firstname', $user->getFirstname());
    }
    public function testSetGetLastname()
    {
        // we create an instance of User
        $user = new User();

        // we assign a name to this instance
        $user->setLastname('Lastname');

        // We check that the method returns the correct value
        $this->assertEquals('Lastname', $user->getLastname());
    }
    public function testSetGetEmail()
    {
        // we create an instance of User
        $user = new User();

        // we check that the email exist
        $this->assertNull($user->getEmail());

        // we assign a email to this instance
        $email = 'arcadia@test.fr';
        $user->setEmail($email);

        // we check that the method returns the correct value
        $this->assertEquals($email, $user->getEmail());
    }

    public function testSetGetRoles()
    {
        // we create an instance of User
        $user = new User();

        // we assign a role to this instance
        $role = ['ROLE_ADMIN'];
        $user->setRoles($role);

        // we assign ROLE_USER to this instance and check that the method returns the correct value
        $this->assertEquals(array_merge($role, ['ROLE_USER']),$user->getRoles());

        // we assign more roles
        $additionnalRoles = ['ROLE_EMPLOYE','ROLE_VETERINAIRE'];
        $expectedRole = array_merge($role,$additionnalRoles,['ROLE_USER']);
        $user->setRoles($expectedRole);

        // we check that the method returns the correct value

        $this->assertEquals($expectedRole,$user->getRoles());
    }
    public function testAnException(): void
    {
        $this->expectException(\TypeError::class);

        $user = new User();
        $user->setFirstName([10]);
    }
}
