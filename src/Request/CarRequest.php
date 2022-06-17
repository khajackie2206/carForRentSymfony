<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CarRequest extends BaseRequest
{
    const DEFAULT_LIMIT = 10;
    const DEFAULT_STRING = '';
    const DEFAULT_INT = 0;
    const DEFAULT_ORDER_TYPE = 'asc';
    const DEFAULT_ORDER_BY = 'createdAt';

    #[Assert\Type('string')]
    private ?string $brand = self::DEFAULT_STRING;

    #[Assert\Type('string')]
    private ?string $color = self::DEFAULT_STRING;

    #[Assert\Type('integer')]
    private ?int $seats = self::DEFAULT_INT;

    #[Assert\Choice(
        choices: ['created', 'price'],
    )]
    private ?string $orderBy = self::DEFAULT_ORDER_BY;

    #[Assert\Choice(
        choices: ['asc', 'esc'],
    )]
    private ?string $orderType = self::DEFAULT_ORDER_TYPE;

    #[Assert\Type('int')]
    private ?int $limit = self::DEFAULT_LIMIT;

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
    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    /**
     * @param string|null $orderType
     */
    public function setOrderType(?string $orderType): void
    {
        $this->orderType = $orderType;
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
    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
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
}
