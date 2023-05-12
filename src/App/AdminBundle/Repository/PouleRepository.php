<?php

namespace App\AdminBundle\Repository;

/**
 * PouleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PouleRepository extends \Doctrine\ORM\EntityRepository
{
    function findPoulebyid($id){
        return $query = $this->createQueryBuilder('p')
                ->leftJoin('p.equipe', 'e')
                ->leftJoin('p.tournoi', 't')
                ->addSelect('t')
                ->addSelect('e')
                ->where('p.id=:id')
                ->setParameter('id', $id)
                ->getQuery()->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }
    
    function getlistmatch($id) {
        return $query = $this->createQueryBuilder('p')
                        ->leftJoin('AppAdminBundle:Matchs', 'm', 'WITH', 'p.id=m.poule')
                        ->addSelect('m')
                        ->where('p.id=:id')
                        ->setParameter('id', $id)
                        ->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_SCALAR);
    }
    
    function getpoule(){
        return $query = $this->createQueryBuilder('p')
                ->getQuery()->getArrayResult();
    }

    function getEquipeexist(){
        $equipeexist = array();
         $data = $this->createQueryBuilder('p')
            ->leftJoin('p.equipe','e')
            ->addSelect('e')
            ->getQuery()->getArrayResult();
        foreach($data as $k=>$v){
            $equipeexist = array($v['equipe']);
        }
        return $equipeexist;
    }
    
    function getEquipebyidpoule($id)
    {
        $query = $this->createQueryBuilder('p')
                ->leftJoin('p.equipe','e')
                ->where('p.id=:id')
                ->setParameter('id', $id)
                ->addSelect('e')
                ->getQuery()->getArrayResult();
        $data =[];
        foreach ($query as $k=>$v)
        {
            $data = $v['equipe'];
            
        }
        return $data;
    }

    public function getPoulebyIdtournoi($id)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.tournoi','t')
            ->where('t.id=:id')
            ->setParameter('id',$id)
            ->getQuery()->getArrayResult();
        return $query;
    }
}