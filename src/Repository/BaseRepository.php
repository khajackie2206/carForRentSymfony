<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\BaseEntity;
use Doctrine\ORM\QueryBuilder;

class BaseRepository extends ServiceEntityRepository
{
    protected string $alias;

    public function __construct(ManagerRegistry $registry, string $entityClass = '', $alias = '')
    {
        parent::__construct($registry, $entityClass);
        $this->alias = $alias;
    }

    public function save(BaseEntity $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(BaseEntity $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    protected function filter(QueryBuilder $cars, string $field, mixed $value): QueryBuilder
    {
        if (empty($value)) {
            return $cars;
        }

        return $cars->where($this->alias . ".$field = :$field")->setParameter($field, $value);
    }

    protected function moreFilter(QueryBuilder $cars, string $field, mixed $value): QueryBuilder
    {
        if (empty($value)) {
            return $cars;
        }

        return $cars->andWhere($this->alias . ".$field = :$field")->setParameter($field, $value);
    }

    protected function orderBy(QueryBuilder $cars, string $orderType, string $orderBy): QueryBuilder
    {
        if (empty($orderBy) || empty($orderType)) {
            return $cars;
        }

        return $cars->orderBy($this->alias . ".$orderType", $orderBy);
    }
}
