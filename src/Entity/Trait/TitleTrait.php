<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait TitleTrait
{
    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(
        message: "Cette valeur ne doit pas être vide."
    )]
    #[Assert\Type('string')]
    private ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
