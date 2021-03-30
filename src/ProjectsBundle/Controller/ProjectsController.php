<?php

namespace ProjectsBundle\Controller;

use EntitiesBundle\Entity\Projets;
use EntitiesBundle\Form\ProjetsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectsController extends Controller
{
    public function addAction(Request $request)
    {
        $Sprint = new Projets();
        $form=$this->createForm(ProjetsType::class,$Sprint);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Sprint);
            $em->flush();
            return $this->redirectToRoute('add_project');
        }
        $a=$this->afficher();
        return $this->render('ProjectsBundle:Projects:add_project.html.twig',array('form'=>$form->createView(),'forums'=>$a));
    }

    public function afficher()
    {
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "SELECT *,fos_user.username from projets inner join fos_user on fos_user.id=projets.ide_product_owner";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $a = $statement->fetchAll();
        return $a;
    }
    public function deleteAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $club = $this->getDoctrine()->getRepository(Projets::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute("add_project");
    }
}
