<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    private $i = 0;

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany1(10, 'main_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('spacebar%d@example.com', $i));
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'engage'));
            $user->setFirstName($this->faker->firstName);
            if ($this->faker->boolean) {
                $user->setTwitterUsername($this->faker->userName);
            }
            return $user;

        });

        $this->createMany1(3, 'admin_users', function ($i){
            $user  = new User();
            $user->setEmail(sprintf('admin%d@thespacebar.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;

        });

        $manager->flush();
    }
}
