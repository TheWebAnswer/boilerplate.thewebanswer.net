<?php

namespace App\Entity;

use App\Entity\Traits\Bool\IsVerifiedTrait;
use App\Entity\Traits\Date\CreatedAtTrait;
use App\Entity\Traits\Date\UpdatedAtTrait;
use App\Entity\Traits\PasswordTrait;
use App\Entity\Traits\RolesTrait;
use App\Entity\Traits\String\EmailTrait;
use App\Entity\Traits\String\FirstNameTrait;
use App\Entity\Traits\String\LastNameTrait;
use App\Entity\Traits\UuidTrait;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use UuidTrait;
    use EmailTrait;
    use PasswordTrait;
    use RolesTrait;
    use IsVerifiedTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use LastNameTrait;
    use FirstNameTrait;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Image $avatar = null;

    public function __construct()
    {
        $this->updatedAt = new DateTimeImmutable();
        $this->createdAt = new DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function __sleep()
    {
        // Retourne la liste des propriétés à sérialiser, en excluant 'avatar'
        return array_diff(array_keys(get_object_vars($this)), ['avatar']);
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAvatar(): ?Image
    {
        return $this->avatar;
    }

    public function setAvatar(?Image $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
