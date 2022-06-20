<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Request\CarRequest;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends BaseRepository
{
    const CAR_ALIAS = 'p';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class, static::CAR_ALIAS);
    }

    public function getAll(CarRequest $carRequest): array
    {
        $cars = $this->createQueryBuilder(self::CAR_ALIAS);
        $cars = $this->filter($cars, 'color', $carRequest->getColor());
        $cars = $this->moreFilter($cars, 'brand', $carRequest->getBrand());
        $cars = $this->moreFilter($cars, 'seats', $carRequest->getSeats());
        $cars = $this->orderBy($cars, $carRequest->getOrderType(), $carRequest->getOrderBy());
        $cars->setMaxResults($carRequest->getLimit())->setFirstResult(0);
        return $cars->getQuery()->getResult();
    }
}
