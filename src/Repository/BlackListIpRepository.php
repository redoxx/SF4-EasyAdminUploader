<?php

namespace App\Repository;

use App\Entity\BlackListIp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BlackListIp|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlackListIp|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlackListIp[]    findAll()
 * @method BlackListIp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlackListIpRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BlackListIp::class);
    }

//    /**
//     * @return BlackListIp[] Returns an array of BlackListIp objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlackListIp
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
