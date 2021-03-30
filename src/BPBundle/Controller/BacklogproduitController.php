<?php

namespace BPBundle\Controller;

use EntitiesBundle\Form\BacklogProduitType;
use EntitiesBundle\Entity\BacklogProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BacklogproduitController extends Controller
{


    public function featAction()
    {
        $user = $this->getUser()->getUsername();

        $sql = "select backlog_produit.id_backlog_feature,backlog_produit.feature from backlog_produit  INNER join projets  on projets.id_projet=backlog_produit.ide_projet INNER join fos_user on projets.ide_product_owner=fos_user.id WHERE fos_user.username=:dom ";
        $params[':dom'] = $user;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();


        return $this->render('@BP\backlogpd\Backlogpd.html.twig', array( 'a'=>$a));
    }

    public function suppbpAction($id)
    {
        $em = $this ->getDoctrine()->getManager();
        $backlogpd = $em ->getRepository(BacklogProduit :: class)->find($id);


        $em ->remove($backlogpd);
        $em->flush();

        return $this->redirectToRoute("bp_affichage");
    }

    public function ajouterbpAction(Request $request)
    {$backlogpd=new BacklogProduit();

        $form=$this->createForm( BacklogProduitType::class,$backlogpd);
        $form=$form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())

        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($backlogpd);

            $em->flush();
            return $this->redirectToRoute('bp_affichage');}

        return $this->render( '@BP\backlogpd\backlogformulaire.html.twig',array('f' => $form->createView()));
    }


    public function modifybpAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $bp = $em->getRepository(BacklogProduit::class)->find($id);
        $form = $this -> createForm( BacklogProduitType::class, $bp);
        $form =  $form ->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $em  = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('bp_affichage');
        }
        return $this->render( '@BP\backlogpd\backlogformulaire.html.twig',array('f' => $form->createView()));
    }
}
