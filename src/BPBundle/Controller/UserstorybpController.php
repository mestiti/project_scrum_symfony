<?php


namespace BPBundle\Controller;




use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use EntitiesBundle\Form\BacklogProduitType;
use EntitiesBundle\Entity\UserStoryBacklogProduit;
use EntitiesBundle\Form\UserStoryBacklogProduitType;

class UserstorybpController extends Controller
{

    public function featuserAction()
    {
        $user = $this->getUser()->getUsername();

        $sql = "select backlog_produit.feature ,user_story_backlog_produit.id_user_story_backlog_produit,user_story_backlog_produit.user_story_bp,user_story_backlog_produit.priority_bp from user_story_backlog_produit inner join backlog_produit  on user_story_backlog_produit.ide_backlog_feat=backlog_produit.id_backlog_feature INNER join projets  on projets.id_projet=backlog_produit.ide_projet INNER join fos_user on projets.ide_product_owner=fos_user.id WHERE fos_user.username=:dom ";
        $params[':dom'] = $user;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();


        return $this->render('@BP\backlogpd\Userstorybp.html.twig', array( 'a'=>$a));
    }

    public function suppuserbpAction($id)
    {
        $em = $this ->getDoctrine()->getManager();
        $userstorybp = $em ->getRepository(UserStoryBacklogProduit :: class)->find($id);


        $em ->remove($userstorybp);
        $em->flush();

        return $this->redirectToRoute("bp_useraff");
    }

    public function ajouteruserbpAction(Request $request)
    {$userbp=new UserStoryBacklogProduit();

        $form=$this->createForm( UserStoryBacklogProduitType::class,$userbp);
        $form=$form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {$em=$this->getDoctrine()->getManager();
            $em->persist($userbp);
            $em->flush();
            return $this->redirectToRoute('bp_useraff');}
        return $this->render( '@BP\backlogpd\Userbpformulaire.html.twig',array('f' => $form->createView()));

    }

    public function modifyuserbpAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $userbp = $em->getRepository(UserStoryBacklogProduit::class)->find($id);
        $form = $this -> createForm( UserStoryBacklogProduitType::class, $userbp);
        $form =  $form ->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $em  = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('bp_useraff');
        }
        return $this->render( '@BP\backlogpd\Userbpformulaire.html.twig',array('f' => $form->createView()));
    }

}
