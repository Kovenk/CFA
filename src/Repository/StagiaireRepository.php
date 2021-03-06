<?php

namespace App\Repository;

use App\Entity\Stagiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stagiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stagiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stagiaire[]    findAll()
 * @method Stagiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagiaireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stagiaire::class);
    }

    public function getAll(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                'SELECT s 
                 FROM App\Entity\Stagiaire s'
                                                         
        );
        return $query->execute();
    }

    // /**
    //  * @return Stagiaire[] Returns an array of Stagiaire objects
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
    public function findOneBySomeField($value): ?Stagiaire
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function search($search){

        return $this->createQueryBuilder('s')
        ->orWhere('s.nom LIKE :q')
        ->orWhere('s.prenom LIKE :q')
        ->orWhere('s.dateNaissance LIKE :q')
        ->orWhere('s.adresse LIKE :q')
        ->orWhere('s.ville LIKE :q')
        ->orWhere('s.codePostal LIKE :q')
        ->orWhere('s.mail LIKE :q')
        ->orWhere('s.telephone LIKE :q')
        
        
        ->setParameter('q', '%'.$search.'%')
        ->getQuery()
        ->getResult()
        ;

    }
}
