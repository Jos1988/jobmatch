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

    /**
     * Get batch of patterns.
     *
     * @param int $first
     * @param int $size
     *
     * @return mixed|Pattern[]
     */
    public function getBatch(int $first, int $size)
    {
        return $this->createQueryBuilder('p')
            ->setFirstResult($first)
            ->setMaxResults($size)
            ->getQuery()
            ->getResult();
    }

}
