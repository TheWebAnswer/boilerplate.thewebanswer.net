<?php

namespace App\Entity;

use App\Entity\Traits\Date\CreatedAtTrait;
use App\Entity\Traits\Date\UpdatedAtTrait;
use App\Entity\Traits\IdTrait;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\SlugTrait;
use App\Repository\ImageRepository;
use Cocur\Slugify\Slugify;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Image
{
    use IdTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    use ImageTrait;
    use SlugTrait;

    #[ORM\OneToOne(mappedBy: 'avatar', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->updatedAt = new DateTimeImmutable();
        $this->createdAt = new DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->imageName;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->updatedAt = new DateTimeImmutable();
        $this->slug = (new Slugify())->slugify($this->imageName);
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new DateTimeImmutable();
        $this->slug = (new Slugify())->slugify($this->imageName);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setAvatar(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getAvatar() !== $this) {
            $user->setAvatar($this);
        }

        $this->user = $user;

        return $this;
    }
}
