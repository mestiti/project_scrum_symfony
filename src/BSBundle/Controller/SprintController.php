<?php

namespace BSBundle\Controller;

use EntitiesBundle\Entity\Sprint;
use EntitiesBundle\Form\SprintType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class SprintController extends Controller
{
    public function sprintvAction()
    {
        return $this->render('BSBundle:BS:Sprintv.html.twig');
    }

    public function createAction(Request $request)
    {
        $user = $this->getUser()->getUsername();
        $em = $this->getDoctrine()->getManager();
        $sql = "select sprint.id_sprint,sprint.description,sprint.date_debut_sprint,sprint.date_fin_sprint,sprint.liste_user_sroty_bs,projets.nom_projet,equipe.nom_equipe,backlog_sprint.id_bs,fos_user.id from fos_user inner join equipe on equipe.ide_scrum_master=fos_user.id  INNER join projets inner join backlog_sprint on projets.id_projet=backlog_sprint.id_projet and equipe.ide_projet=projets.id_projet inner join sprint on sprint.id_bs=backlog_sprint.id_bs where fos_user.username=:dom";
        $params[':dom'] = $user;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        $b=$this->afficher($user);

        $Sprint = new Sprint();
        $form=$this->createForm(SprintType::class,$Sprint);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Sprint);
            $em->flush();
            return $this->redirectToRoute('Sprintv');
        }
        return $this->render('BSBundle:BS:Sprintv.html.twig',array('form'=>$form->createView(),'a'=>$a,'b'=>$b));
    }

    public function updateAction(Request $request , $id)
    {
        $em= $this->getDoctrine()->getManager();
        $club = $em->getRepository(Sprint::class)->find($id);
        $form=$this->createForm(SprintType::class,$club);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('Sprintv');
        }
        return $this->render('BSBundle:BS:Sprintv1.html.twig',array('f'=>$form->createView()));
    }

    public function deleteAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $club = $this->getDoctrine()->getRepository(Sprint::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute("Sprintv");
    }

    public function afficher($nom)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select * from backlog_sprint INNER join projets on backlog_sprint.id_projet=projets.id_projet INNER JOIN equipe on equipe.ide_projet=projets.id_projet INNER JOIN fos_user on fos_user.id=equipe.ide_scrum_master WHERE fos_user.username=:dom";
        $params[':dom'] = $nom;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        return $a;
    }

}
