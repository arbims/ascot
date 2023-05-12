<?php

namespace App\UserBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    function getuserbyid($id){
        return $query = $this->createQueryBuilder('u')
            ->where('u.id=:id')
            ->setParameter('id',$id)
            ->getQuery()->getArrayResult();
    }
    
    function findallbycompteadmin()
    {
        $query = $this->createQueryBuilder('u')
                ->where("u.type=1")
                ->andWhere("u.roles LIKE '%ROLE_SUPER_ADMIN%'")
                ->getQuery()->getArrayResult();
        return $query;
    }
}
