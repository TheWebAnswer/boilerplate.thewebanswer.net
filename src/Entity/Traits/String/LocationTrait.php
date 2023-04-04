<?php

namespace App\Entity\Traits\String;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait LocationTrait
{
    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(
        message: "Cette valeur ne doit pas être vide."
    )]
    #[Assert\Length(
        min: 2,
        max: 250,
        minMessage: 'Votre ville doit comporter au moins {{ limit }} caractères.',
        maxMessage: 'Votre ville ne peut pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Type('string')]
    private ?string $city = null;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(
        message: "Cette valeur ne doit pas être vide."
    )]
    #[Assert\Length(
        min: 2,
        max: 250,
        minMessage: 'Votre pays doit comporter au moins {{ limit }} caractères.',
        maxMessage: 'Votre pays ne peut pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Type('string')]
    private ?string $country = null;

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    #[Assert\Type('string')]
    private ?string $countryFlag = null;

    public function getCountryFlag(): ?string
    {
        return $this->countryFlag = 'https://countryflagsapi.com/png/'.$this->country;
    }

    public function setCountryFlag(): self
    {
        $this->countryFlag = 'https://countryflagsapi.com/png/'.$this->country;

        return $this;
    }
}
