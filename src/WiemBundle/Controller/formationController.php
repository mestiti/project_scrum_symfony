<?php

namespace WiemBundle\Controller;

use clubBundle\Entity\Club;
use clubBundle\Form\ClubType;
use EntitiesBundle\Entity\Formation;
use EntitiesBundle\Entity\Reclamation;
use EntitiesBundle\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class formationController extends Controller
{
    public function homeAction()
    {
        return $this->render('WiemBundle:Formation:formation.html.twig');
    }
    public function create1Action(Request $request)
    {
        $Sprint = new Formation();
        $form=$this->createForm(FormationType::class,$Sprint);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Sprint);
            $em->flush();
            return $this->redirectToRoute('read');
        }
        return $this->render('WiemBundle:Formation:Create.html.twig',array('f'=>$form->createView()));
    }



    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "SELECT * from fos_user where roles='a:1:{i:0;s:10:\"ROLE_ADMIN\";}'";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $a = $statement->fetchAll();
        $b = $this->trah();

        return $this->render('WiemBundle:Formation:Create2.html.twig',array('a'=>$a,'b'=>$b));
    }

    public function trah()
    {
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "SELECT * from fos_user";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $a = $statement->fetchAll();
        return $a;
    }




    public function readAction()
    {

        $formation = $this->getDoctrine()
            ->getRepository(Formation::class)->findAll();
        return $this->render('WiemBundle:Formation:formation.html.twig', array('f' => $formation));


    }

    public function readfAdminAction()
    {

        $formation = $this->getDoctrine()
            ->getRepository(Formation::class)->findAll();
        return $this->render('WiemBundle:Formation:ReadfAdmin.html.twig', array('f' => $formation));


    }


    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $clubs = $this->getDoctrine()
            -> getRepository(Formation::class)->find($id);
        $em->remove($clubs);
        $em ->flush();
        return $this->redirectToRoute("readfAdmin");
    }


    public function updateAction(Request $request,$id)
    {   $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository(Formation::class)->find($id);
        $form = $this->createForm(FormationType::class, $formation);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('readfAdmin');
        }
        return $this->render('WiemBundle:Formation:Update.html.twig', array('f' => $form->createView()));


    }

    public function ajout_formationAction(Request $request)
    {
        $nom=$request->query->get('nom');
        $sujet=$request->query->get('sujet');
        $idp=$request->query->get('idp');
        $liste=$request->query->get('liste');
        $date=$request->query->get('date');
        $t1=$request->query->get('t1');
        $t2=$request->query->get('t2');

        $sql = "INSERT INTO formation(sujet_formation, liste_personne, time_debut, time_fin, nom_formation, Date, ide_formateur) VALUES (:dom,:dom1,:dom2,:dom3,:dom4,:dom5,:dom6)";
        $params[':dom'] = $sujet;
        $params[':dom1'] = $liste;
        $params[':dom2'] = $t1;
        $params[':dom3'] = $t2;
        $params[':dom4'] = $nom;
        $params[':dom5'] = $date;
        $params[':dom6'] = $idp;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $this->redirectToRoute("read");
    }
}
