<?php

namespace App\Repository;

use App\Entity\Prprety;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Prprety|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prprety|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prprety[]    findAll()
 * @method Prprety[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrpretyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prprety::class);
    }

    /**
     * @return QueryBuilder
     *
     */

    public function findvisible():QueryBuilder{

        return $this->findallquery()


            ;

    }


    /**
     * @return prprety[]
     */
    public function findlatest():array {

        return $this->findallquery()
            ->setMaxResults('4')
            ->getQuery()
            ->getResult()
            ;

    }

    private function findallquery(): QueryBuilder{
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');

    }
    // /**
    //  * @return Prprety[] Returns an array of Prprety objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prprety
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
