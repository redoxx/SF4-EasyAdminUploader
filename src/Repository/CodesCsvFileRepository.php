<?php

namespace App\Repository;

use App\Entity\CodesCsvFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CodesCsvFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodesCsvFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodesCsvFile[]    findAll()
 * @method CodesCsvFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodesCsvFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CodesCsvFile::class);
    }

//    /**
//     * @return CodesCsvFile[] Returns an array of CodesCsvFile objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CodesCsvFile
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
