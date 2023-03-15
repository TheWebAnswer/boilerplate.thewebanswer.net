<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait JobTrait
{
    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(
        message: "Cette valeur ne doit pas être vide."
    )]
    #[Assert\Length(
        min: 2,
        max: 250,
        minMessage: 'Votre profession doit comporter au moins {{ limit }} caractères.',
        maxMessage: 'Votre profession ne peut pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\Type('string')]
    private ?string $job = null;

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }
}
