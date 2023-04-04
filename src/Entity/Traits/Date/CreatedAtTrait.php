<?php

namespace App\Entity\Traits\Date;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait CreatedAtTrait
{

	#[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
	#[Assert\NotNull]
	private \DateTimeImmutable $createdAt;

	public function getCreatedAt(): \DateTimeImmutable
	{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTimeImmutable $createdAt): self
	{
		$this->createdAt = $createdAt;

		return $this;
	}

}
