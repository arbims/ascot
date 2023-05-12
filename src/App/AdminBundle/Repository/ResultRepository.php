<?php

namespace App\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ResultRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResultRepository extends EntityRepository
{
     public function classment($poule)
    {
        $query = "select * "
                . " from result r "
                . " where r.poule_id =$poule"
                . " group by r.equipe ,r.result , r.wons "
                . " order by r.result desc ";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $req = $stmt->fetchAll();
        return $req;
    }
}