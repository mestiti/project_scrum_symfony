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

class InterventionController extends Controller
{

    public function readTableAction()
    {

        $formation = $this->getDoctrine()
            ->getRepository(Intervention::class)->findAll();
        return $this->render('WiemBundle:Intervention:Create.html.twig', array('f' => $formation));


    }


    public function createAction()
    {
        $a=$this->affreq();

        return $this->render('WiemBundle:Intervention:Create.html.twig',array('a'=>$a));
    }

    public function ajoutAction(Request $request,$id)
    {

        return $this->render('WiemBundle:Intervention:ajout.html.twig',array('id'=>$id));
        return $id;
    }

    public function add4Action(Request $request)
    {
        $desc=$request->query->get('desc');
        $date=$request->query->get('date');
        $id=$request->query->get('id');

        $sql = "INSERT INTO `intervention` (`description_intervention`,`date_intervention`,`ide_reclamation`) VALUES (:dom, :dom1, :dom2)";


        $params[':dom'] = $desc;
        $params[':dom1'] = $date;
        $params[':dom2'] = $id;


        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("createI");
    }

    public function updateR(){
          $em = $this->getDoctrine()->getManager();

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('readI');

    }


    public function readAction()
    {

         $Intervention = $this->getDoctrine()
            ->getRepository(Intervention::class)->findAll();
        return $this->render('WiemBundle:Intervention:Read.html.twig', array('f' => $Intervention));


    }


    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $intervention = $this->getDoctrine()
            -> getRepository(Intervention::class)->find($id);
        $em->remove($intervention);
        $em ->flush();
        return $this->redirectToRoute("add_in");
    }


    public function updateAction(Request $request,$id)
    {   $em = $this->getDoctrine()->getManager();
        $Intervention= $em->getRepository(Intervention::class)->find($id);
        $form = $this->createForm(FormationType::class, $Intervention);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('readI');
        }
        return $this->render('WiemBundle:Intervention:Update.html.twig', array('f' => $form->createView()));
    }

    public function affreq()
    {
        $em = $this->getDoctrine()->getManager();
        $sql="select * from reclamation";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $a = $stmt->fetchAll();
        return $a;
    }





}
