<?php

namespace ForumBundle\Controller;

use EntitiesBundle\Entity\Metapost;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Metapost controller.
 *
 * @Route("metapost")
 */
class MetapostController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $metaposts = $em->getRepository('EntitiesBundle:Metapost')->findAll();

        return $this->render('@Forum/metapost/index.html.twig', array(
            'metaposts' => $metaposts,
            'user' => $user
        ));
    }


    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $metapost = new Metapost();
        $form = $this->createForm('EntitiesBundle\Form\MetapostType', $metapost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($metapost);
            $em->flush();

            return $this->redirectToRoute('metapost_show', array('id' => $metapost->getId()));
        }

        return $this->render('@Forum/metapost/new.html.twig', array(
            'metapost' => $metapost,
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    public function showAction(Metapost $metapost)
    {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($metapost);

        return $this->render('@Forum/metapost/show.html.twig', array(
            'metapost' => $metapost,
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }


    public function editAction(Request $request, Metapost $metapost)
    {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($metapost);
        $editForm = $this->createForm('EntitiesBundle\Form\MetapostType', $metapost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('metapost_edit', array('id' => $metapost->getId()));
        }

        return $this->render('@Forum/metapost/edit.html.twig', array(
            'metapost' => $metapost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }


    public function deleteAction(Request $request, Metapost $metapost)
    {
        $form = $this->createDeleteForm($metapost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($metapost);
            $em->flush();
        }

        return $this->redirectToRoute('metapost_index');
    }

    /**
     * Creates a form to delete a metapost entity.
     *
     * @param Metapost $metapost The metapost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Metapost $metapost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('metapost_delete', array('id' => $metapost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
