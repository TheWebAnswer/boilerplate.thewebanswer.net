<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait EmailTrait
{
	#[ORM\Column(type: Types::STRING, length: 180, unique: true)]
	#[Assert\NotBlank()]
	#[Assert\Email(
		message: "Le mail : {{ value }} n'est pas un valide.",
	)]
	private ?string $email = null;

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}
}
