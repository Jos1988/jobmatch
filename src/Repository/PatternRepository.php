<?php

namespace App\Repository;

use App\Entity\Pattern;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pattern|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pattern|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pattern[]    findAll()
 * @method Pattern[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatternRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pattern::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
