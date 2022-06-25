<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CarRequest extends BaseRequest
{
    public const DEFAULT_LIMIT = 10;
    public const SEATS_LIST = [4, 7, 16];
    public const ORDER_TYPE_LIST = ['createdAt', 'price'];
    public const ORDER_BY_LIST = ['asc', 'desc'];
    public const DEFAULT_ORDER_TYPE = 'createdAt';
    public const DEFAULT_ORDER_BY = 'desc';

    #[Assert\Type('string')]
    private $brand;

    #[Assert\Type('string')]
    private $color;

    #[Assert\Type('integer')]
    #[Assert\Choice(
        choices: self::SEATS_LIST )]
    private $seats;

    #[Assert\Choice(
        choices: self::ORDER_BY_LIST,
    )]
    #[Assert\Type('string')]
    private ?string $orderBy = self::DEFAULT_ORDER_BY;

    #[Assert\Choice(
        choices: self::ORDER_TYPE_LIST,
    )]
    #[Assert\Type('string')]
    private ?string $orderType = self::DEFAULT_ORDER_TYPE;

    #[Assert\Type('int')]
    private ?int $limit = self::DEFAULT_LIMIT;

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
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats($seats): void
    {
        $this->seats = is_numeric($seats) ? (int)$seats : $seats;
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
}
