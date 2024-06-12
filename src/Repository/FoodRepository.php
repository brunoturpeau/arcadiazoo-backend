<?php

namespace App\Repository;

use App\Entity\Food;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Food>
 */
class FoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Food::class);
    }

    public function findLastFiveMeals($animal_id) : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT food.id, food.animal_id, food.time, food.created_at, user_id, firstname, lastname
            FROM `food` INNER JOIN user ON user.id = food.user_id 
            WHERE `animal_id` = :animal_id 
            ORDER BY food.created_at DESC 
            LIMIT 5 ;
            ';

        $resultSet = $conn->executeQuery($sql, ['animal_id' => $animal_id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findEatingInMeals($animal_id) : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT *
            FROM `eating` 
            JOIN food ON food.id = eating.food_id
            WHERE `animal_id` = :animal_id
            ';

        $resultSet = $conn->executeQuery($sql, ['animal_id' => $animal_id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }



    //    /**
    //     * @return Food[] Returns an array of Food objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Food
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
