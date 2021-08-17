<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
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

    public function searchByTerm($term)
    {
        $queryBuilder = $this->createQueryBuilder('article');

        $query = $queryBuilder
            ->select('article')
            ->where('article.title LIKE :term')
            ->orWhere('article.content LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->getQuery();

        return $query->getResult();
    }

}
