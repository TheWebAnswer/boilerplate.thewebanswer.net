<?php

namespace App\Entity\Traits\Bool;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait IsConfirmedTrait
{
    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $isConfirmed = false;

    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }
}
