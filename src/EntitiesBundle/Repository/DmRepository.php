<?php


namespace EntitiesBundle\Repository;


use Doctrine\ORM\EntityRepository;

class DmRepository  extends EntityRepository
{
    public function finduid()
    {

        $qb = $this->getEntityManager()
            ->createQuery("select c from EntitiesBundle:User c where c.UID=:num or c.UID=:ui")
            ->setParameters(array('num' => 1 , 'ui'=> 2));
        return $query = $qb->getResult();

    }
}