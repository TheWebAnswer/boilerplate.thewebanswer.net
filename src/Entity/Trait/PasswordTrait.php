<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait PasswordTrait
{
	#[ORM\Column(type: Types::STRING)]
	private ?string $password = null;

	#[Assert\NotCompromisedPassword(
		message: "Ce mot de passe a été divulgué lors d'une violation de données, il ne doit pas être utilisé. Veuillez utiliser un autre mot de passe.",
		skipOnError: true
	)]
	private ?string $plainPassword = null;

	public function getPlainPassword(): ?string
	{
		return $this->plainPassword;
	}

	public function setPlainPassword(?string $plainPassword): self
	{
		$this->plainPassword = $plainPassword;

		return $this;
	}

	/**
	 * @see PasswordAuthenticatedUserInterface
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	public function setPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}
}
