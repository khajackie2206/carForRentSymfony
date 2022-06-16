<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $path;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\OneToOne(mappedBy: 'thumbnail', targetEntity: Car::class, cascade: ['persist', 'remove'])]
    private $car;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(Car $car): self
    {
        // set the owning side of the relation if necessary
        if ($car->getThumbnail() !== $this) {
            $car->setThumbnail($this);
        }
        $this->car = $car;

        return $this;
    }

    public function jsonParse(): array
    {
        return [
            'id' => $this->getId(),
            'path' => $this->getPath()
        ];
    }
}
