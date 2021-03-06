<?php

namespace App\Repository;

use App\Entity\Formateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Formateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formateur[]    findAll()
 * @method Formateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormateurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Formateur::class);
    }

    public function getAll(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                'SELECT f 
                 FROM App\Entity\Formateur f'                                        
        );
        return $query->execute();
    }
    // /**
    //  * @return Formateur[] Returns an array of Formateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formateur
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function search($search){

        return $this->createQueryBuilder('f')
        ->orWhere('f.nom LIKE :q')
        ->orWhere('f.prenom LIKE :q')
        ->orWhere('f.dateNaissance LIKE :q')
        ->orWhere('f.adresse LIKE :q')
        ->orWhere('f.ville LIKE :q')
        ->orWhere('f.codePostal LIKE :q')
        ->orWhere('f.mail LIKE :q')
        ->orWhere('f.telephone LIKE :q')
        
        
        ->setParameter('q', '%'.$search.'%')
        ->getQuery()
        ->getResult()
        ;

    }
}
