<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use App\Entity\User;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }


    /**
     * @return Article[] Returns an array of Article linked to the User
     */
    function findForUser(User $user)
    {
        return $this->createQueryBuilder('a')
            ->join(User::class, 'u', \Doctrine\ORM\Query\Expr\Join::WITH, 'a.idUser = u.id')
            ->where('u.id = ' . $user->getId())
            ->orderBy('a.dateAdded', 'DESC')
            ->getQuery()
            ->getResult();
    }
    
    public function findByTitle($value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.title LIKE :val')
            ->setParameter('val', "%" . $value . "%")
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}