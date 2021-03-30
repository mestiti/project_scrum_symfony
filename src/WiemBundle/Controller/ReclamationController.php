<?php

namespace WiemBundle\Controller;

use EntitiesBundle\Entity\Formation;
use EntitiesBundle\Entity\Intervention;
use EntitiesBundle\Entity\Reclamation;
use EntitiesBundle\Form\FormationType;
use EntitiesBundle\Form\InterventionType;
use EntitiesBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ReclamationController extends Controller
{

    public function createAction(Request $request)
    {
        $reclamation = new Reclamation();
        $form=$this->createForm(ReclamationType::class,$reclamation);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted()) {
            $reclamation->setEtat("Non traitée");
            $em= $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('readR');
        }
        return $this->render('WiemBundle:Reclamation:Create.html.twig',array('f'=>$form->createView()));
    }

    public function readAction()
    {

        $formation = $this->getDoctrine()
            ->getRepository(Reclamation::class)->findAll();
        return $this->render('WiemBundle:Reclamation:Read.html.twig', array('f' => $formation));


    }


    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $reclamation = $this->getDoctrine()
            -> getRepository(Reclamation::class)->find($id);
        $em->remove($reclamation);
        $em ->flush();
        return $this->redirectToRoute("readR");
    }


    public function updateAction(Request $request,$id)
    {   $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('readR');
        }
        return $this->render('WiemBundle:Reclamation:Update.html.twig', array('f' => $form->createView()));
    }
}
