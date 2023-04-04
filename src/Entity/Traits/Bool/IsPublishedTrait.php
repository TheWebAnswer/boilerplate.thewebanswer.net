<?php

namespace App\Entity\Traits\Bool;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait IsPublishedTrait
{
    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $isPublished = false;

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
