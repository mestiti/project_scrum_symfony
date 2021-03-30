<?php

namespace ForumBundle\Controller;

use EntitiesBundle\Entity\Metacomment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Metacomment controller.
 *
 * @Route("metacomment")
 */
class MetacommentController extends Controller
{

    public function indexAction()
    {
        $user =$this->getUser();
        $em = $this->getDoctrine()->getManager();

        $metacomments = $em->getRepository('EntitiesBundle:Metacomment')->findAll();

        return $this->render('@Forum/metacomment/index.html.twig', array(
            'metacomments' => $metacomments,
            'user' => $user
        ));
    }

    public function newAction(Request $request)
    {
        $user =$this->getUser();
        $metacomment = new Metacomment();
        $form = $this->createForm('EntitiesBundle\Form\MetacommentType', $metacomment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($metacomment);
            $em->flush();

            return $this->redirectToRoute('metacomment_show', array('id' => $metacomment->getId()));
        }

        return $this->render('@Forum/metacomment/new.html.twig', array(
            'metacomment' => $metacomment,
            'form' => $form->createView(),
            'user' => $user
        ));
    }


    public function showAction(Metacomment $metacomment)
    {
        $user =$this->getUser();
        $deleteForm = $this->createDeleteForm($metacomment);

        return $this->render('@Forum/metacomment/show.html.twig', array(
            'metacomment' => $metacomment,
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }


    public function editAction(Request $request, Metacomment $metacomment)
    {
        $user =$this->getUser();
        $deleteForm = $this->createDeleteForm($metacomment);
        $editForm = $this->createForm('EntitiesBundle\Form\MetacommentType', $metacomment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('metacomment_edit', array('id' => $metacomment->getId()));
        }

        return $this->render('@Forum/metacomment/edit.html.twig', array(
            'metacomment' => $metacomment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }


    public function deleteAction(Request $request, Metacomment $metacomment)
    {
        $form = $this->createDeleteForm($metacomment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($metacomment);
            $em->flush();
        }

        return $this->redirectToRoute('metacomment_index');
    }

    /**
     * Creates a form to delete a metacomment entity.
     *
     * @param Metacomment $metacomment The metacomment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Metacomment $metacomment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('metacomment_delete', array('id' => $metacomment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
