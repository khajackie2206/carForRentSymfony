<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CarRequest extends BaseRequest
{
    public const DEFAULT_LIMIT = 10;
    public const DEFAULT_STRING = '';
    public const DEFAULT_INT = 0;
    public const SEATS_LIST = [4, 7, 16];
    public const ORDER_TYPE_LIST = ['createdAt', 'price'];
    public const ORDER_BY_LIST = ['asc', 'desc'];
    public const DEFAULT_ORDER_TYPE = 'createdAt';
    public const DEFAULT_ORDER_BY = 'desc';

    #[Assert\Type('string')]
    private ?string $brand = self::DEFAULT_STRING;

    #[Assert\Type('string')]
    private ?string $color = self::DEFAULT_STRING;

    #[Assert\Type('integer')]
    #[Assert\Choice(
        choices: self::SEATS_LIST
    )]
    private ?int $seats = self::DEFAULT_INT;

    #[Assert\Choice(
        choices: self::ORDER_BY_LIST,
    )]
    private ?string $orderBy = self::DEFAULT_ORDER_BY;

    #[Assert\Choice(
        choices: self::ORDER_TYPE_LIST,
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
