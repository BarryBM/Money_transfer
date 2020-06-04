<?php

namespace App\Repository;

use App\Entity\Agence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Agence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agence[]    findAll()
 * @method Agence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agence::class);
    }
 
    public function getIdAgence($pays)
    {
        $request=$this->createQueryBuilder('a')
                ->join('a.pays', 'p')
                ->where('p.codePays = :pays')->setParameter('pays', $pays->getcodePays())
                ->orderBy('a.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

        if (empty($request)){
            $code = ($pays->getcodePays());
            $idAgence = str_pad(1,4,0,STR_PAD_LEFT);
            return $pays->getcodePays().$idAgence;
        }
        else{
            $code = str_replace($pays->getcodePays(),'',$request->getIdAgence()) + 1;
            $idAgence = str_pad($code,4,0,STR_PAD_LEFT);
            return $pays->getcodePays().$idAgence;
        }    
    }
    

    // /**
    //  * @return Agence[] Returns an array of Agence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
}
