<?php

namespace EntitiesBundle\Repository;
use Doctrine\ORM\EntityRepository;


class UserStoryBacklogProduitRepository extends EntityRepository{

    public function getbacklog_user($nom)
    {$qb=$this->getEntityManager()->createQuery(" select b.idBacklogFeature, b.feature,p.nomProjet,u.idUserStoryBacklogProduit,u.userStoryBp,u.priorityBp from EntitiesBundle:BacklogProduit b join EntitiesBundle:UserStoryBacklogProduit u WITH  b.idBacklogFeature=u.ideBacklogFeat  join  EntitiesBundle:Projets p WITH p.idProjet=b.ideProjet where p.nomProjet=:titre");

        $qb->setParameter('titre',$nom);


        return $query=$qb->getResult();


    }
    public function getuser_prio1($nom)
    {$qb=$this->getEntityManager()->createQuery(" select COUNT(u.priorityBp)  from EntitiesBundle:BacklogProduit b join EntitiesBundle:UserStoryBacklogProduit u WITH  b.idBacklogFeature=u.ideBacklogFeat  join  EntitiesBundle:Projets p WITH p.idProjet=b.ideProjet where u.priorityBp=1 and  p.nomProjet=:titre");


        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }
    public function getuser_prio30($nom)
    {$qb=$this->getEntityManager()->createQuery(" select COUNT(u.priorityBp)  from EntitiesBundle:BacklogProduit b join EntitiesBundle:UserStoryBacklogProduit u WITH  b.idBacklogFeature=u.ideBacklogFeat  join  EntitiesBundle:Projets p WITH p.idProjet=b.ideProjet where  p.nomProjet=:titre and u.priorityBp=30");


        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }
    public function getuser_prio60($nom)
    {$qb=$this->getEntityManager()->createQuery(" select COUNT(u.priorityBp)  from EntitiesBundle:BacklogProduit b join EntitiesBundle:UserStoryBacklogProduit u WITH  b.idBacklogFeature=u.ideBacklogFeat  join  EntitiesBundle:Projets p WITH p.idProjet=b.ideProjet where  p.nomProjet=:titre and u.priorityBp=60");

        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }
    public function getnbsprint($nom)
    {

        $qb=$this->getEntityManager()->createQuery(" select COUNT(s.idSprint)  from EntitiesBundle:Sprint s join EntitiesBundle:BacklogSprint b WITH  b.idBs=s.idBs  join  EntitiesBundle:Projets p WITH p.idProjet=b.idProjet where  p.nomProjet=:titre ");

        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }

    public function getnbtache($nom)
    {

        $qb=$this->getEntityManager()->createQuery(" select COUNT(t.idTache)  from EntitiesBundle:Tache t join  EntitiesBundle:BacklogSprint b WITH  t.ideUserStoryBs=b.idBs  join  EntitiesBundle:Projets p WITH p.idProjet=b.idProjet where  p.nomProjet=:titre ");

        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }
    public function getnbtachetodo($nom)
    {

        $qb=$this->getEntityManager()->createQuery("  select COUNT(t.idTache)  from EntitiesBundle:Tache t join  EntitiesBundle:BacklogSprint b WITH  t.ideUserStoryBs=b.idBs  join  EntitiesBundle:Projets p WITH p.idProjet=b.idProjet where  p.nomProjet=:titre  and t.etat='to do'");

        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }
    public function getnbtachedoing($nom)
    {

        $qb=$this->getEntityManager()->createQuery("  select COUNT(t.idTache)  from EntitiesBundle:Tache t join  EntitiesBundle:BacklogSprint b WITH  t.ideUserStoryBs=b.idBs  join  EntitiesBundle:Projets p WITH p.idProjet=b.idProjet where  p.nomProjet=:titre and t.etat='doing' ");

        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }
    public function getnbtachedone($nom)
    {

        $qb=$this->getEntityManager()->createQuery("  select COUNT(t.idTache)  from EntitiesBundle:Tache t join  EntitiesBundle:BacklogSprint b WITH  t.ideUserStoryBs=b.idBs  join  EntitiesBundle:Projets p WITH p.idProjet=b.idProjet where  p.nomProjet=:titre  and t.etat='done'");

        $qb->setParameter('titre',$nom);



        return $query=$qb->getSingleScalarResult();

    }

    public function getRecentlyUpdatedEvents()
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.updatedAt > :since')
            ->setParameter('since', new \DateTime('24 hours ago'))
            ->getQuery()
            ->execute();
    }


}