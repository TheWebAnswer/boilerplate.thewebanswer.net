<?php

namespace App\Entity\Traits\Bool;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait IsDoneTrait
{
    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $isDone = false;

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }
}
