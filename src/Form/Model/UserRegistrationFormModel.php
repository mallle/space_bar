<?php


namespace App\Form\Model;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\UniqueUser;


class UserRegistrationFormModel
{
    /**
     * @Assert\NotBlank(message="Please enter an email")
     * @Assert\Email()
     * @UniqueUser()
     */
    public $email;

    /**
     * @Assert\NotBlank(message="Choose a password")
     * @Assert\Length(min=3, minMessage="Come on, you can think of a password longer than that!")
     */
    public $plainPassword;

    /**
     * @Assert\IsTrue(message="I know, it's silly, but you mus agree to our terms.")
     */
    public $agreeTerms;



}