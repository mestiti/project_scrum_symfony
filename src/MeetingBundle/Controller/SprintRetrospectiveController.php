<?php

namespace MeetingBundle\Controller;

use EntitiesBundle\Entity\SprintRetrospective;
use EntitiesBundle\Form\SprintRetrospectiveType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EntitiesBundle\Entity\SprintReview;
use EntitiesBundle\Form\SprintReviewType;

class SprintRetrospectiveController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeetingBundle:Default:index.html.twig');
    }


    public function ajout_srAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $spp = $em->getRepository('EntitiesBundle:SprintRetrospective')->findAll();


        $sp = new SprintRetrospective();
        $form = $this->createForm(SprintRetrospectiveType::class, $sp);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($sp);
            $em->flush();
            return $this->redirectToRoute('ajoutsr');
        }
        return $this->render('@Meeting/SprintRetrospective/ajoutsprint_retro.html.twig', array(
            'f' => $form->createView(),
            'sp' => $spp
        ));

    }
    public function deletesrAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository('EntitiesBundle:SprintRetrospective')->find($id);
        $em->remove($absence);
        $em->flush();
        return $this->redirectToRoute("ajoutsr");
    }

    public function updatesrAction($id,Request $request)
    {



        $em = $this->getDoctrine()->getManager();
        $sp = $em->getRepository('EntitiesBundle:SprintRetrospective')->find($id);
        $form = $this->createForm(SprintRetrospectiveType::class, $sp);
        $form = $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('ajoutsr');}

        return $this->render('@Meeting/SprintRetrospective/update_sr.html.twig',array('f' => $form->createView()));

    }

}