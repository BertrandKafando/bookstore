<?php
namespace App\Repository;

use App\Data\Searchdata;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    public function findSearch(Searchdata $searchdatadata): array
    {
        $query= $this
        ->createQueryBuilder('p')
        ->select('g','p','a')
        ->join('p.genres','g')
        ->join('p.auteurs','a');

        if(!empty($searchdatadata->q)){
            $query=$query
                ->andWhere('p.titre LIKE :q')
                ->setParameter('q',"%{$searchdatadata->q}%");
        }


        if (!empty($searchdatadata->min)){
            $query=$query
                ->andWhere('p.note >= :q')
                ->setParameter('q',"{$searchdatadata->min}");
        }

        if (!empty($searchdatadata->max)){
            $query=$query
                ->andWhere('p.note <= :q')
                ->setParameter('q',"{$searchdatadata->max}");
        }

        if(!empty($searchdatadata->genres)){
            $query=$query
                ->andWhere('g.id IN(:genres)')
                ->setParameter('genres',$searchdatadata->genres);

        }

        if(!empty($searchdatadata->auteurs)){
            $query=$query
                ->andWhere('a.id IN(:auteurs)')
                ->setParameter('auteurs',$searchdatadata->auteurs);
        }

        return $query->getQuery()->getResult();
    }


    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
