<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CarRequest extends BaseRequest
{
    #[Assert\Type('string')]
    private ?string $color='';

    #[Assert\Type('int')]
    private ?int $seats=0;

    #[Assert\Type('string')]
    private ?string $brand = '';

    #[Assert\Choice(
        choices: ['created', 'price'],
    )]
    private ?string $orderBy = 'created.asc';

    #[Assert\Type('int')]
    private ?int $limit = 10;

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param string|null $orderBy
     */
    public function setOrderBy(?string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     */
    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int|null
     */
    public function getSeats(): ?int
    {
        return $this->seats;
    }

    /**
     * @param int|null $seats
     */
    public function setSeats(?int $seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     */
    public function setLimit(?int $limit = 10): void
    {
        $this->limit = $limit;
    }
}
