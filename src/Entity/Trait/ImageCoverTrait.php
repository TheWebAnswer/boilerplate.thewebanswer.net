<?php

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
trait ImageCoverTrait
{
    #[Vich\UploadableField(mapping: 'post_image_cover', fileNameProperty: '$imageCoverName', size: '$imageCoverSize')]
    private ?File $imageCoverFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageCoverName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageCoverSize = null;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|null $imageCoverFile
     */
    public function setImageFile(?File $imageCoverFile = null): void
    {
        $this->imageCoverFile = $imageCoverFile;

        if (null !== $imageCoverFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageCoverFile(): ?File
    {
        return $this->imageCoverFile;
    }

    public function setImageCoverName(?string $imageCoverName): void
    {
        $this->imageCoverName = $imageCoverName;
    }

    public function getImageCoverName(): ?string
    {
        return $this->imageCoverName;
    }

    public function setImageCoverSize(?int $imageCoverSize): void
    {
        $this->imageCoverSize = $imageCoverSize;
    }

    public function getImageCoverSize(): ?int
    {
        return $this->imageCoverSize;
    }
}
