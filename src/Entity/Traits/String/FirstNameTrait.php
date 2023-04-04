<?php

namespace App\Entity\Traits\String;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait FirstNameTrait
{
	#[ORM\Column(type: Types::STRING, length: 255)]
	#[Assert\NotBlank(
		message: "Cette valeur ne doit pas être vide."
	)]
	#[Assert\Length(
		min: 2,
		max: 50,
		minMessage: 'Votre prénom doit comporter au moins {{ limit }} caractères.',
		maxMessage: 'Votre prénom ne peut pas dépasser {{ limit }} caractères.',
	)]
	#[Assert\Type('string')]
	private ?string $firstName = null;

	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	public function setFirstName(string $firstName): self
	{
		$this->firstName = $firstName;

		return $this;
	}
}
