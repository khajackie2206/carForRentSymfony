<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateCarRequest extends BaseRequest
{
    public const SEATS_LIST = [4, 7, 16];

    #[Assert\Type('string')]
    private $name;

    #[Assert\Type('string')]
    private $color;

    #[Assert\Type('string')]
    private $brand;

    #[Assert\Type('numeric', message: 'price is invalid!!')]
    private $price ;

    #[Assert\Type('string')]
    private $description;

    #[Assert\Type('integer')]
    #[Assert\Choice(
        choices: self::SEATS_LIST ,
    )]
    private $seats;

    #[Assert\Type('integer')]
    private $year;

    #[Assert\Type('integer')]
    private $createdUser;

    #[Assert\Type('integer')]
    private $thumbnail;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats($seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getCreatedUser()
    {
        return $this->createdUser;
    }

    /**
     * @param mixed $createdUser
     */
    public function setCreatedUser($createdUser): void
    {
        $this->createdUser = $createdUser;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }
}
