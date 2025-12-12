<?php

namespace App\Repository;

use App\Entity\InstrumentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InstrumentType>
 *
 * @method InstrumentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstrumentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstrumentType[]    findAll()
 * @method InstrumentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstrumentTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstrumentType::class);
    }

    //    /**
    //     * @return InstrumentType[] Returns an array of InstrumentType objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?InstrumentType
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
