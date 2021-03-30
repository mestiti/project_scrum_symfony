<?php

namespace BSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserstController extends Controller
{
    public function homeAction()
    {
        return $this->render('BSBundle:BS:Userstory.html.twig');
    }
    public function affiAction(Request $request)
    {
        $user = $this->getUser()->getUsername();
        $em = $this->getDoctrine()->getManager();
        $sql = "select user_story_backlog_sprint.id_user_story_bs,user_story_backlog_sprint.id_sprint,user_story_backlog_sprint.description_user_story_bs, sprint.id_sprint,sprint.description,projets.nom_projet,equipe.nom_equipe,fos_user.id from fos_user inner join equipe on equipe.ide_scrum_master=fos_user.id INNER join projets on projets.id_projet=equipe.ide_projet INNER JOIN backlog_sprint on backlog_sprint.id_projet=projets.id_projet inner join sprint on sprint.id_bs=backlog_sprint.id_bs inner join user_story_backlog_sprint ON user_story_backlog_sprint.id_sprint=sprint.id_sprint where fos_user.username=:dom";
        $params[':dom'] = $user;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        $b=$this->trah($user);
        $c=$this->trah2($user);
        return $this->render('BSBundle:BS:Userstory.html.twig',array('a'=>$a,'b'=>$b,'c'=>$c));
    }
    public function add5Action(Request $request)
    {
        $id=$request->query->get('ids');
        $nbr=$request->query->get('userst');

        $sql = "INSERT INTO `user_story_backlog_sprint` (`id_sprint`,`description_user_story_bs`) VALUES (:dom, :dom1)";
        $params[':dom'] = $id;
        $params[':dom1'] = $nbr;
        $this->setus($nbr);
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("user_story");
    }
    public function trah($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select sprint.id_sprint,sprint.description,sprint.date_debut_sprint,sprint.date_fin_sprint,sprint.liste_user_sroty_bs,projets.nom_projet,equipe.nom_equipe,backlog_sprint.id_bs,fos_user.id from fos_user inner join equipe on equipe.ide_scrum_master=fos_user.id  INNER join projets inner join backlog_sprint on projets.id_projet=backlog_sprint.id_projet and equipe.ide_projet=projets.id_projet inner join sprint on sprint.id_bs=backlog_sprint.id_bs where fos_user.username=:dom";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }
    public function trah2($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select user_story_backlog_produit.id_user_story_backlog_produit,user_story_backlog_produit.user_story_bp,user_story_backlog_produit.ide_backlog_feat from user_story_backlog_produit INNER join fos_user inner join equipe on equipe.ide_scrum_master=fos_user.id INNER join projets on projets.id_projet=equipe.ide_projet inner join backlog_produit on projets.id_projet=backlog_produit.ide_projet and equipe.ide_projet=projets.id_projet  WHERE user_story_backlog_produit.ide_backlog_feat=backlog_produit.id_backlog_feature and fos_user.username=:dom and user_story_backlog_produit.etat=0";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function setus($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "UPDATE user_story_backlog_produit SET user_story_backlog_produit.etat=1 WHERE user_story_backlog_produit.user_story_bp=:dom";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }
    public function updateusAction($id,$desc1,$desc2)
    {
        $user = $this->getUser()->getUsername();
        $b=$this->trah($user);
        $c=$this->trah2($user);
        return $this->render('BSBundle:BS:Userstory1.html.twig', array('id'=>$id,'desc1'=>$desc1,'desc2'=>$desc2,'b'=>$b,'c'=>$c));
    }

    public function updateAction(Request $request)
    {
        $id=$request->query->get('id');
        $ids=$request->query->get('ids');
        $desc=$request->query->get('desc');
        $sql = "UPDATE user_story_backlog_sprint SET id_sprint=:dom1 ,description_user_story_bs=:dom2 WHERE id_user_story_bs=:dom ";
        $params[':dom'] = $id;
        $params[':dom1'] = $ids;
        $params[':dom2'] = $desc;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("user_story");
    }
    public function deleteAction($id)
    {
        $sql = "delete from user_story_backlog_sprint where id_user_story_bs=:dom";
        $params[':dom'] = $id;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("user_story");
    }
}
