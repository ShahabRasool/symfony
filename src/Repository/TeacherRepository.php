<?php

namespace App\Repository;

use App\Entity\Teacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @extends ServiceEntityRepository<Teacher>
 */
class TeacherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry ,private EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Teacher::class);
    }
    public function add(Teacher $teacher , bool $flush= false){
        $this->entityManagerInterface->persist($teacher);
        if ($flush) {
            $this->entityManagerInterface->flush();
        }
    }
    
    public function remove(Teacher $teacher){
        $this->entityManagerInterface->remove($teacher);
        $this->entityManagerInterface->flush();
    }
    //    /**
    //     * @return Teacher[] Returns an array of Teacher objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Teacher
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findAllwithPaginationSupport(){
        $query = $this->createQueryBuilder('teacher')
        ->getQuery();
        return new Pagerfanta(new QueryAdapter($query));
    }
}
