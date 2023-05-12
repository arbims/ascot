<?php

namespace App\AdminBundle\Repository;

/**
 * ResultatRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResultatRepository extends \Doctrine\ORM\EntityRepository
{
    public function classment($poule)
    {
        $query = "select * "
                . " from result r "
                . " where r.poule_id = ? "
                . " group by r.equipe ,r.result , r.wons "
                . " order by r.result desc ";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $req = $stmt->fetchAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        return $req;
    }
}