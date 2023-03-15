<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\DescriptionTrait;
use App\Entity\Trait\IsDoneTrait;
use App\Entity\Trait\LinkTrait;
use App\Entity\Trait\SlugTrait;
use App\Entity\Trait\TitleTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Entity\Trait\UuidTrait;
use App\Repository\FeatureRepository;
use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeatureRepository::class)]
class Feature
{
    use UuidTrait;
    use TitleTrait;
    use DescriptionTrait;
    use SlugTrait;
    use IsDoneTrait;
    use LinkTrait;
    use UpdatedAtTrait;
    use CreatedAtTrait;

    public function __construct()
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->title;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->slug = (new Slugify())->slugify($this->title);
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->slug = (new Slugify())->slugify($this->title);
    }

}
