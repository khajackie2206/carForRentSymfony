<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $color;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $brand;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'float')]
    private $price;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'integer')]
    private $seats;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'integer')]
    private $year;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\OneToOne(inversedBy: 'car', targetEntity: Image::class , cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $thumbnail;

    #[ORM\ManyToOne(targetEntity: User::class , inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private $createdUser;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Rent::class )]
    private $rents;

    public function __construct()
    {
        $this->rents = new ArrayCollection();
        $this->createdAt = new() \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(? \DateTimeImmutable $createdAt) : self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getThumbnail(): ?Image
    {
        return $this->thumbnail;
    }

    public function setThumbnail(Image $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getCreatedUser(): ?User
    {
        return $this->createdUser;
    }

    public function setCreatedUser(?User $createdUser): self
    {
        $this->createdUser = $createdUser;

        return $this;
    }

    /**
     * @return Collection<int, Rent>
     */
    public function getRents(): Collection
    {
        return $this->rents;
    }

    public function addRent(Rent $rent): self
    {
        if (!$this->rents->contains($rent)) {
            $this->rents[] = $rent;
            $rent->setCar($this);
        }

        return $this;
    }

    public function removeRent(Rent $rent): self
    {
        if ($this->rents->removeElement($rent)) {
            if ($rent->getCar() === $this) {
                $rent->setCar(null);
            }
        }

        return $this;
    }
}
