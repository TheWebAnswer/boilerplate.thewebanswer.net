<?php

namespace App\Entity;

use App\Entity\Trait\AvatarTrait;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\EmailTrait;
use App\Entity\Trait\FirstNameTrait;
use App\Entity\Trait\IsVerifiedTrait;
use App\Entity\Trait\LastNameTrait;
use App\Entity\Trait\PasswordTrait;
use App\Entity\Trait\RolesTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Entity\Trait\UuidTrait;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use UuidTrait;
    use EmailTrait;
    use PasswordTrait;
    use RolesTrait;
    use IsVerifiedTrait;
    use AvatarTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use LastNameTrait;
    use FirstNameTrait;

    public function __construct()
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->email;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->setAvatar($this->email);
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->setAvatar($this->email);
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


}
