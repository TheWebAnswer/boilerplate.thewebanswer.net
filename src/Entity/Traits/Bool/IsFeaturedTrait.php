<?php

namespace App\Entity\Traits\Bool;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait IsFeaturedTrait
{
    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $isFeatured = false;

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }
}
