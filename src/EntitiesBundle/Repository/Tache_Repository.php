<?php

namespace EntitiesBundle\Repository;


class Tache_Repository extends \Doctrine\ORM\EntityRepository
{
    public function findUsertodo($idCurrentUser)
    {
        $dqlresult = $this->getEntityManager()
            ->createQuery("SELECT t
                               FROM 
                                    EntitiesBundle:Tache t
                               WHERE
                                    t.user = '$idCurrentUser' AND  t.etat=:todo
                                    
                              ")
            ->setParameters(array('todo' => "TODO" ));

        return $dqlresult->getResult();
    }

    public function findUserdoing($idCurrentUser)
    {
        $dqlresult = $this->getEntityManager()
            ->createQuery("SELECT t
                               FROM 
                                    EntitiesBundle:Tache t
                               WHERE
                                    t.user = '$idCurrentUser' AND  t.etat=:doing
                                    
                              ")
            ->setParameters(array('doing' => "DOING" ));

        return $dqlresult->getResult();
    }

    public function findUserdone($idCurrentUser)
    {
        $dqlresult = $this->getEntityManager()
            ->createQuery("SELECT t
                               FROM 
                                    EntitiesBundle:Tache t
                               WHERE
                                    t.user = '$idCurrentUser' AND  t.etat=:done
                                    
                              ")
            ->setParameters(array('done' => "DONE" ));

        return $dqlresult->getResult();
    }

    public function findtodo()
    {

        $qb = $this->getEntityManager()
            ->createQuery("select t from EntitiesBundle:Tache t where t.etat=:todo  ")
            ->setParameters(array('todo' => "TODO" ));
        return $query = $qb->getResult();

    }

    public function finddoing()
{

    $qb = $this->getEntityManager()
        ->createQuery("select t from EntitiesBundle:Tache t where t.etat=:doing ")
        ->setParameters(array('doing' => "DOING" ));
    return $query = $qb->getResult();

}
    public function finddone()
    {

        $qb = $this->getEntityManager()
            ->createQuery("select t from EntitiesBundle:Tache t where t.etat=:done ")
            ->setParameters(array('done' => "DONE" ));
        return $query = $qb->getResult();

    }
}
