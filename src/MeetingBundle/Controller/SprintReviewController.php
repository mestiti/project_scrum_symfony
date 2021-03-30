<?php

namespace MeetingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EntitiesBundle\Entity\SprintReview;
use EntitiesBundle\Form\SprintReviewType;

class SprintReviewController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeetingBundle:Default:index.html.twig');
    }



    public function ajout_spAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $spp = $em->getRepository('EntitiesBundle:SprintReview')->findAll();


        $sp = new SprintReview();
        $form = $this->createForm(SprintReviewType::class, $sp);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($sp);
            $em->flush();
            /**sms**/
     /*      $basic  = new \Nexmo\Client\Credentials\Basic('4ee3bf6f', 'xZhlD1B5d7f5sbDN');
              $client = new \Nexmo\Client($basic);

             $message = $client->message()->send([
           'to' => '21620739885',
           'from' => 'WEMANAGE',
           'text' => 'Invitation Pour Sprint Review '
              ]);*/
            /**Email**/

                $sp->getDateSprintReview();
              $message = \Swift_Message::newInstance()
                  ->setSubject('Invitation SPRINT REVIEW')
                  ->setFrom('youssefdarderi@gmail.com')
                  ->setTo('youssefdarderi@gmail.com')
                  ->setBody('Invitation Pour le sprint Review');
              $this->get('mailer')->send($message);
              $this->addFlash('info','Mail sent successfully');
            return $this->redirectToRoute('ajoutersp');
        }
        return $this->render('@Meeting/SprintReview/ajoutsprint_review.html.twig', array(
            'f' => $form->createView(),
            'sp' => $spp
        ));

    }

    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository('EntitiesBundle:SprintReview')->find($id);
        $em->remove($absence);
        $em->flush();
        return $this->redirectToRoute("ajoutersp");
    }

    public function updateAction($id,Request $request)
    {



        $em = $this->getDoctrine()->getManager();
        $sp = $em->getRepository('EntitiesBundle:SprintReview')->find($id);
        $form = $this->createForm(SprintReviewType::class, $sp);
        $form = $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('ajoutersp');}

        return $this->render('@Meeting/SprintReview/update_sp.html.twig',array('f' => $form->createView()));

    }
}