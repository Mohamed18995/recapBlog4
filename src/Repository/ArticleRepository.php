<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByNom($nom){

    return $this->createQueryBuilder('a')
        ->andWhere('a.nom like = :nom')
        ->setParameter('nom', $nom)
        ->orderBy('a.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
    ;
}

public function findByYear($year)
    {
        $dateTime = new \DateTime();
        $dateTime->setDate($year->format('Y') +1, "01", "01");

        $q = $this->createQueryBuilder('a')
        ->where('a.dateDeCreation between :thisDate AND :dateTime')
        ->setParameter('thisDate', $year)
        ->setParameter('dateTime', $dateTime)
        ->orderBy('a.dateDeCreation', 'ASC')
        ->getQuery()
    ;
        return $q->execute();
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findByContenu($contenu = "magique")
    {
        return $this->createQueryBuilder('a')
            ->where('a.contenu like  :contenu')
            ->setParameter('contenu', '%'. $contenu.'%')
            ->orderBy('a.contenu', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

}
