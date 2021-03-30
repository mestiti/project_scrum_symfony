<?php

namespace MeetingBundle\Controller;
use EntitiesBundle\Entity\Tache;
use EntitiesBundle\Form\TacheType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class tacheController extends Controller
{
    public function ajouter_tacheAction(Request $request)
    {

        $tache=new tache();
        $form=$this->createForm(TacheType::class,$tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $tache -> setEtat("TODO");

            $em->persist($tache);
            $em->flush();

            return $this->redirectToRoute('afficher_tache_sm');
        }
        return $this->render('@Meeting/tache/ajouter_tache.html.twig', array(
            'tache' => $tache,
            'form' => $form->createView(),
        ));


    }


    public function indexAction(Request $request)
    {
        return $this->render('@Meeting\tache\index.html.twig');
    }

    public function todoAction (Request $request, $id)
    {
        $em = $this -> getDoctrine() -> getManager();
        $tache = $em -> getRepository('EntitiesBundle:Tache')->find($id);
        $tache -> setEtat("TODO");
        $em->persist($tache);
        $em->flush();
        return $this->redirectToRoute("afficher_tache_team");

    }
    public function doingAction (Request $request, $id)
    {

        $em = $this -> getDoctrine() -> getManager();
        $tache = $em -> getRepository('EntitiesBundle:Tache')->find($id);
        $tache -> setEtat("DOING");
        $em->persist($tache);
        $em->flush();
        return $this->redirectToRoute("afficher_tache_team");

    }
    public function doneAction (Request $request, $id)
    {

        $em = $this -> getDoctrine() -> getManager();
        $tache = $em -> getRepository('EntitiesBundle:Tache')->find($id);
        $tache -> setEtat("DONE");
        $em->persist($tache);
        $em->flush();
        return $this->redirectToRoute("afficher_tache_team");

    }
    public function afficher_tache_smAction(Request $request)
    {
        $user = $this->getUser();

        //$en = $this->getDoctrine()->getManager();
        //$tache = $en->getRepository('EntitiesBundle:Tache')->findTacheDQL($this->getUser()->getId());
        $repository=$this->getDoctrine()->getManager()->getRepository('EntitiesBundle:Tache');
        $doing = $repository->finddoing();

        $repository=$this->getDoctrine()->getManager()->getRepository('EntitiesBundle:Tache');
        $done = $repository->finddone();

        $repository=$this->getDoctrine()->getManager()->getRepository('EntitiesBundle:Tache');
        $todo = $repository->findtodo();

        return $this->render('@Meeting\tache\afficher_tache_sm.html.twig',array(
            'todo' => $todo, 'doing' => $doing, 'done' => $done,'user' => $user
        ));
    }
    public function afficher_tache_teamAction(Request $request)
    {
        $user = $this->getUser();

        //$en = $this->getDoctrine()->getManager();
        //$tache = $en->getRepository('EntitiesBundle:Tache')->findTacheDQL($this->getUser()->getId());
        $en = $this->getDoctrine()->getManager();
        $doing = $en->getRepository('EntitiesBundle:Tache')->findUserdoing($this->getUser()->getId());

        $en = $this->getDoctrine()->getManager();
        $done = $en->getRepository('EntitiesBundle:Tache')->findUserdone($this->getUser()->getId());

        $en = $this->getDoctrine()->getManager();
        $todo = $en->getRepository('EntitiesBundle:Tache')->findUsertodo($this->getUser()->getId());

        return $this->render('@Meeting\tache\afficher_tache_team.html.twig',array(
            'todo' => $todo, 'doing' => $doing, 'done' => $done,'user' => $user
        ));
    }

}
