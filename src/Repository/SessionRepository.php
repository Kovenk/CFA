<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function getAll(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                'SELECT s 
                 FROM App\Entity\Session s'                                        
        );
        return $query->execute();
    }

    
    // /**
    //  * @return Session[] Returns an array of Session objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Session
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function search($search = null, $dated = null, $datef = null){

        $qb = $this->createQueryBuilder('s');
        if($search){
           $qb->where('s.intitule LIKE :q')
              ->orWhere('s.placeTotale LIKE :q')
              ->setParameter('q', '%'.$search.'%');
        }
        if($search && $dated && $datef){
            $qb->where('s.intitule LIKE :q')
            ->orWhere('s.placeTotale LIKE :q')

            ->andWhere('s.dateDebut >= :dd')
            ->andWhere('s.dateFin <= :df')
            ->setParameter("dd", $dated)
            ->setParameter('df', $datef)            
            ->setParameter('q', '%'.$search.'%');
        }
        else{
           $qb->where('s.dateDebut >= :dd')
              ->andWhere('s.dateFin <= :df')
              ->setParameter("dd", $dated)
              ->setParameter('df', $datef);
        }
        
        return $qb->getQuery()
                  ->getResult()
        ;

    }

}
