<?php

namespace ProjectsBundle\Controller;

use EntitiesBundle\Entity\Equipe;
use EntitiesBundle\Form\EquipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    public function addteamAction(Request $request)
    {
        $b = $this->getDoctrine()->getRepository(Equipe::class)->findAll();


        $Sprint = new Equipe();
        $form=$this->createForm(EquipeType::class,$Sprint);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Sprint);
            $em->flush();
            return $this->redirectToRoute('add_team');
        }
        return $this->render('ProjectsBundle:Projects:team.html.twig',array('form'=>$form->createView(),'b'=>$b));
    }
    public function deleteAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $club = $this->getDoctrine()->getRepository(Equipe::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute("add_team");
    }
}
