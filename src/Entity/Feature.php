<?php

namespace App\Entity;

use App\Entity\Traits\Date\CreatedAtTrait;
use App\Entity\Traits\Text\DescriptionTrait;
use App\Entity\Traits\Bool\IsDoneTrait;
use App\Entity\Traits\Url\LinkTrait;
use App\Entity\Traits\SlugTrait;
use App\Entity\Traits\String\TitleTrait;
use App\Entity\Traits\Date\UpdatedAtTrait;
use App\Entity\Traits\UuidTrait;
use App\Repository\FeatureRepository;
use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeatureRepository::class)]
#[ORM\HasLifecycleCallbacks]
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
