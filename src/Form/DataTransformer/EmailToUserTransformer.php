<?php


namespace App\Form\DataTransformer;


use App\Repository\UserRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EmailToUserTransformer implements DataTransformerInterface
{

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var callable
     */
    private $finderCallback;

    public function __construct(UserRepository $userRepository, callable $finderCallback)
    {
        $this->userRepository = $userRepository;
        $this->finderCallback = $finderCallback;
    }

    public function transform($value)
    {
        if(null === $value){
            return '';
        }

        if(!$value instanceof User){
            throw new \LogicException('The UserSelectTextType can only be used with User objects');
        }

        return $value->getEmail();
    }


    public function reverseTransform($value)
    {
        $callback = $this->finderCallback;
        $user = $callback($this->userRepository, $value);

        if(!$user){
            return;
        }

        return $user;

    }
}