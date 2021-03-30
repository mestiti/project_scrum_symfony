<?php

namespace BSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TacheController extends Controller
{
    public function homeAction($id)
    {
        $user = $this->getUser()->getUsername();
        $b=$this->trah($user);
        return $this->render('BSBundle:BS:tache.html.twig',array('b'=>$b,'id'=>$id));
    }

    public function tache_teamAction()
    {
        $user = $this->getUser()->getUsername();
        $b=$this->trah($user);
        $a=$this->affiteam($user);
        $notif=$this->notif();
        $count=$this->count();
        return $this->render('BSBundle:BS:tache5.html.twig',array('b'=>$b,'a'=>$a,'notif'=>$notif,'count'=>$count));
    }
    public function go_notifAction()
    {
        $notif=$this->notif();
        return $this->render('BSBundle:BS:notif.html.twig',array('notif'=>$notif));
    }
    public function go_notif2Action()
    {
        $notif=$this->notif();
        return $this->render('BSBundle:BS:notif2.html.twig',array('notif'=>$notif));
    }

    public function affAction()
    {
        $user = $this->getUser()->getUsername();
        $b=$this->trah($user);
        $a=$this->affi($user);
        $notif=$this->notif();
        $count=$this->count();
        $count_tasks=$this->affall($user);
        $diff1=$this->affext($user);
        $diff2=$this->affhard($user);
        $diff3=$this->affmed($user);
        $diff4=$this->affeasy($user);

        $crit=$this->affcrit($user);
        $mid=$this->affmed1($user);
        $high=$this->affhigh($user);
        $low=$this->afflow($user);


        return $this->render('BSBundle:BS:tache1.html.twig',array('b'=>$b,'a'=>$a,'notif'=>$notif,'count'=>$count,'ex'=>$diff1,'med'=>$diff3,'hard'=>$diff2,'ez'=>$diff4,'all'=>$count_tasks,'crit'=>$crit,'high'=>$high,'med1'=>$mid,'low'=>$low));
    }

    public function modifAction($id,$nom,$desc,$prio,$diff)
    {
        $user = $this->getUser()->getUsername();
        $b=$id;
        $a=$nom;
        $c=$desc;
        return $this->render('BSBundle:BS:tache3.html.twig',array('b'=>$b,'a'=>$a,'c'=>$c));
    }

    public function opaAction()
    {
        return $this->redirect('https://localhost:8444/workspace/312/view/5417');
    }
    public function idequipe($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql="SELECT equipe.id_equipe FROM equipe INNER JOIN fos_user on fos_user.id=equipe.ide_scrum_master WHERE fos_user.username=:dom";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function notif()
    {
        $em = $this->getDoctrine()->getManager();
        $sql="SELECT * from notif";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $a = $stmt->fetchAll();
        return $a;
    }
    public function count()
    {
        $em = $this->getDoctrine()->getManager();
        $sql="SELECT COUNT(*) as opa FROM notif";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $a = $stmt->fetchAll();
        return $a;
    }
    public function trah($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select fos_user.username,fos_user.id FROM fos_user INNER join equipe ON fos_user.id=equipe.ide_scrum_master Or fos_user.id=equipe.ide_scrum_master Or fos_user.id=equipe.ide_perso_1 Or fos_user.id=equipe.ide_perso_2 Or fos_user.id=equipe.ide_perso_3 Or fos_user.id=equipe.ide_perso_4 Or fos_user.id=equipe.ide_perso_5 Or fos_user.id=equipe.ide_perso_6 WHERE equipe.id_equipe=(SELECT equipe.id_equipe FROM equipe INNER JOIN fos_user on fos_user.id=equipe.ide_scrum_master WHERE fos_user.username=:dom)";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function addAction(Request $request)
    {
        $a=$request->query->get('idus');
        $b=$request->query->get('prio');
        $c=$request->query->get('date');
        $d=$request->query->get('nom');
        $e=$request->query->get('diff');
        $f=$request->query->get('ass');
        $g=$request->query->get('desc');
        $h=0;
        $i=$request->query->get('nbr');
        $j='to do';
        $k=$request->query->get('ass');
        $sql = "INSERT INTO tache(ide_user_story_bs,priotity,date_fin_tache,nom_tache, type_tache,liste_Personnel, description_tache, progress, moyenne_estimation, etat,liste_nbre_heure, user) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:i,:k)";
        $params[':a'] = $a;
        $params[':b'] = $b;
        $params[':c'] = $c;
        $params[':d'] = $d;
        $params[':e'] = $e;
        $params[':f'] = $f;
        $params[':g'] = $g;
        $params[':h'] = $h;
        $params[':i'] = $i;
        $params[':j'] = $j;
        $params[':k'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $this->addnotif($d,$g,$b);
        return $this->redirectToRoute("aff_tache");
    }

    public function addnotif($nom,$desc,$prio)
    {
        $time = date('H:i:s \O\n d/m/Y');
        $sql = "INSERT INTO notif(nom_notif,desc_notif,prio_notif,date_notif) VALUES (:a,:b,:c,:d)";
        $params[':a'] = $nom;
        $params[':b'] = $desc;
        $params[':c'] = $prio;
        $params[':d'] = $time;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }

    public function affi($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select projets.nom_projet,tache.*,fos_user.username,equipe.id_equipe from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom)";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }
    public function affiteam($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select tache.*,fos_user.username from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint WHERE fos_user.username=:dom";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function afftask($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT tache.*,sprint.description,user_story_backlog_sprint.description_user_story_bs FROM tache INNER JOIN user_story_backlog_sprint ON tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint on sprint.id_sprint=user_story_backlog_sprint.id_sprint WHERE tache.id_Tache=:dom";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function aff2Action(Request $request,$id)
    {
        $user = $this->getUser()->getUsername();
        $b=$this->trah($user);
        $a=$this->afftask($id);
        return $this->render('BSBundle:BS:tache2.html.twig',array('b'=>$b,'a'=>$a));
    }
    public function aff4Action(Request $request,$id)
    {
        $user = $this->getUser()->getUsername();
        $b=$this->trah($user);
        $a=$this->afftask($id);
        return $this->render('BSBundle:BS:tache7.html.twig',array('b'=>$b,'a'=>$a));
    }
    public function make_progAction(Request $request,$id,$prog)
    {

        return $this->render('BSBundle:BS:tache6.html.twig',array('id'=>$id,'prog'=>$prog));
    }
    public function aff3Action(Request $request,$id)
    {
        $user = $this->getUser()->getUsername();
        $b=$this->trah($user);

        return $this->render('BSBundle:BS:tache4.html.twig',array('b'=>$b,'id'=>$id));
    }
    public function upAction(Request $request)
    {
        $id=$request->query->get('id');
        $nom=$request->query->get('nom');
        $desc=$request->query->get('desc');
        $prio=$request->query->get('prio');
        $diff=$request->query->get('diff');
        $sql = "UPDATE tache SET nom_tache=:dom1,description_tache=:dom2,priotity=:dom3,type_tache=:dom4 WHERE id_Tache=:dom ";
        $params[':dom'] = $id;
        $params[':dom1'] = $nom;
        $params[':dom2'] = $desc;
        $params[':dom3'] = $prio;
        $params[':dom4'] = $diff;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("aff_tache");
    }
    public function assignAction(Request $request)
    {
        $id=$request->query->get('id');
        $id2=$request->query->get('idu');
        $sql = "UPDATE tache SET user=:dom1 WHERE id_Tache=:dom ";
        $params[':dom'] = $id;
        $params[':dom1'] = $id2;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("aff_tache");
    }

    public function deleteAction($id)
    {
        $sql = "delete from tache where id_Tache=:dom";
        $params[':dom'] = $id;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("aff_tache");
    }
    public function modifier_progAction(Request $request)
    {
        $id=$request->query->get('id');
        $prog=$request->query->get('prog');
        $sql = "UPDATE tache SET progress=:dom1 WHERE id_Tache=:dom ";
        $params[':dom'] = $id;
        $params[':dom1'] = $prog;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("tache_team");
    }

    public function cleanAction(Request $request)
    {
        $sql = "DELETE  FROM `notif` WHERE seen=0";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->redirectToRoute("tache_team");
    }


    public function smart_progAction(Request $request)
    {
        $id=$request->query->get('id');
        $nbr1=$request->query->get('nbr1');
        $nbr2=$request->query->get('nbr2');
        $est=($nbr2/$nbr1)*100;
        return $this->render('BSBundle:BS:tache8.html.twig',array('est'=>$est,'id'=>$id));
    }
    public function affext($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.type_tache='extreme'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }
    public function affhard($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.type_tache='hard'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }
    public function affmed($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.type_tache='meduim'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }
    public function affeasy($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.type_tache='easy'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function affall($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) ";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function affcrit($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.priotity='Critical'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

    public function affmed1($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.priotity='Meduim'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }
    public function affhigh($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.priotity='High'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }
    public function afflow($k)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select COUNT(*) AS f from tache INNER JOIN fos_user on tache.user=fos_user.id INNER JOIN user_story_backlog_sprint on tache.ide_user_story_bs=user_story_backlog_sprint.id_user_story_bs INNER JOIN sprint ON sprint.id_sprint=user_story_backlog_sprint.id_sprint INNER join backlog_sprint on backlog_sprint.id_bs=sprint.id_bs INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe ON  equipe.ide_scrum_master=(SELECT fos_user.id FROM fos_user WHERE fos_user.username=:dom) WHERE tache.priotity='low'";
        $params[':dom'] = $k;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

}
