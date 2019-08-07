<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{

    private $i = 0;

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany1(10, 'main_users', function($i) {
        $user = new User();
        $user->setEmail(sprintf('spacebar%d@example.com', $i));
        $user->setFirstName($this->faker->firstName);
        return $user;
    });

        $manager->flush();
    }
}
