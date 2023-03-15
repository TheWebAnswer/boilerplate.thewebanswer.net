<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait LastNameTrait
{
	#[ORM\Column(type: Types::STRING, length: 255)]
	#[Assert\NotBlank(
		message: "Cette valeur ne doit pas être vide."
	)]
	#[Assert\Length(
		min: 2,
		max: 60,
		minMessage: 'Votre nom doit comporter au moins {{ limit }} caractères.',
		maxMessage: 'Votre nom ne peut pas dépasser {{ limit }} caractères.',
	)]
	#[Assert\Type('string')]
	private ?string $lastName = null;

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function setLastName(string $lastName): self
	{
		$this->lastName = $lastName;

		return $this;
	}
}
