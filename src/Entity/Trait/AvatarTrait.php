<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait AvatarTrait
{
	#[ORM\Column(type: Types::STRING, length: 255)]
	private ?string $avatar = null;

	public function getAvatar(): ?string
	{
		return $this->avatar;
	}

	public function setAvatar(string $avatar): self
	{
		$this->avatar = 'https://api.dicebear.com/5.x/identicon/svg?seed='.$avatar.'&scale=70&backgroundType=gradientLinear,solid&backgroundColor=d1d4f9,c0aede,b6e3f4,ffd5dc,ffdfbf';

		return $this;
	}
}
