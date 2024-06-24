<?php

namespace App\Entity;

use AllowDynamicProperties;
use Symfony\Component\Validator\Constraints as Assert;


#[AllowDynamicProperties]
class Contact
{
    #[Assert\NotBlank(message: 'Name is required.')]
    #[Assert\Length(max: 255)]
    private string $name;

    #[Assert\NotBlank(message: 'Email is required.')]
    #[Assert\Email(message: 'The email {{ value }} is not a valid email.')]
    private string $email;

    #[Assert\NotBlank(message: 'Phone number is required.')]
    #[Assert\Length(max: 15)]
    private string $phone;

    #[Assert\NotBlank(message: 'Topic is required.')]
    #[Assert\Length(max: 255)]
    private string $topic;

    #[Assert\NotBlank(message: 'Message is required.')]
    private string $message;

    // Getters and Setters
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): void
    {
        $this->topic = $topic;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
