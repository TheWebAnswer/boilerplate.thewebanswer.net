<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait UpdatedAtTrait
{
	#[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
	#[Assert\NotNull]
	private \DateTimeImmutable $updatedAt;

	public function getUpdatedAt(): \DateTimeImmutable
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

}
