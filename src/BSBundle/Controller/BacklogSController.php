<?php

namespace BSBundle\Controller;
use EntitiesBundle\Entity\BacklogSprint;
use EntitiesBundle\Form\BacklogSprintType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BacklogSController extends Controller
{
    public function testAction()
    {
        $user=$this->getUser();
        return $this->render('BSBundle:BS:test.html.twig',array('user'=>$user));
    }

    public function updatebsAction($id,$nbr)
    {

    return $this->render('BSBundle:BS:test1.html.twig', array('id'=>$id,'nbr'=>$nbr));
    }


    public function afficherpAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "SELECT projets.nom_projet,equipe.nom_equipe,backlog_sprint.liste_sprint,backlog_sprint.id_bs,projets.id_projet FROM backlog_sprint INNER JOIN projets on projets.id_projet=backlog_sprint.id_projet INNER JOIN equipe on projets.id_projet=equipe.ide_projet";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $forums = $statement->fetchAll();
        $a = $this->afficher();
        return $this->render('BSBundle:BS:test.html.twig', array('forums' => $forums,'a'=>$a));
    }

    public function afficher()
    {
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "SELECT * from projets";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $a = $statement->fetchAll();
        return $a;
    }
    public function add3Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "INSERT INTO `backlog_sprint` (`id_equipe`, `id_sm`, `id_projet`, `liste_sprint`) VALUES ('1', '1', '1', '1')";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        return $this->test4();
    }
    public function createAction(Request $request)
    {
        $club = new BacklogSprint();
        $form=$this->createForm(BacklogSprintType::class,$club);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em= $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('BSBundle:BS:ajoutbs.html.twig');
        }
        return $this->render('BSBundle:BS:ajoutbs.html.twig',array('form'=>$form->createView()));
    }

    public function ajouterAction(Request $request)
    {
        $bs = new BacklogSprint();
        $bs->setIdProjet(1);
        $bs->setIdEquipe(1);
        $bs->setIdSm(1);
        $bs->setListeSprint(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($bs);
        $em->flush();
        return $this->render('BSBundle:BS:test.html.twig');
    }

    public function test4()
    {
        return $this->render('BSBundle:BS:test.html.twig');
    }

    public function add4Action(Request $request)
    {
        $id=$request->query->get('idp');
        $nbr=$request->query->get('nbr');
        $sql = "INSERT INTO `backlog_sprint` (`id_equipe`, `id_sm`, `id_projet`, `liste_sprint`) VALUES (:dom, :dom, :dom, :dom1) ";
        $params[':dom'] = $id;
        $params[':dom1'] = $nbr;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("test-bs");
    }

    public function deletebsAction($id)
    {
        $sql = "delete from backlog_sprint where id_bs=:dom";
        $params[':dom'] = $id;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("test-bs");
    }
    public function modifAction(Request $request)
    {
        $nbr=$request->query->get('nbr');
        $id=$request->query->get('id');
        $sql = "update backlog_sprint set liste_sprint=:dom1 where id_bs=:dom  ";
        $params[':dom'] = $id;
        $params[':dom1'] = $nbr;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("test-bs");
    }
}



