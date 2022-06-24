<?php

namespace App\Request;
use Symfony\Component\Validator\Constraints as Assert;

class RentRequest extends BaseRequest
{
    #[Assert\Type('int')]
    private $carID;

    #[Assert\Type('int')]
    private $userID;

    #[Assert\Type('int')]
    private $status;

    #[Assert\Type('string')]
    private $startDate;

    /**
     * @return mixed
     */
    public function getCarID()
    {
        return $this->carID;
    }

    /**
     * @param mixed $carID
     */
    public function setCarID($carID): void
    {
        $this->carID = $carID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    #[Assert\Type('string')]
    private $endDate;

}
