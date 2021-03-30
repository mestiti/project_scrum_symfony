<?php

namespace ForumBundle\Controller;

use EntitiesBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Comment controller.
 *
 * @Route("comment")
 */
class CommentController extends Controller
{

    public function indexAction()
    {
        $user =$this->getUser();
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('EntitiesBundle:Comment')->findAll();

        return $this->render('@Forum/comment/index.html.twig', array(
            'comments' => $comments,
            'user' => $user
        ));
    }

    public function newAction(Request $request)
    {
        $user =$this->getUser();
        $comment = new Comment();
        $form = $this->createForm('EntitiesBundle\Form\CommentType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comment_show', array('id' => $comment->getId()));
        }

        return $this->render('@Forum/comment/new.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    public function showAction(Comment $comment)
    {
        $user =$this->getUser();
        $deleteForm = $this->createDeleteForm($comment);
        $user = $this->getUser();
        return $this->render('@Forum/comment/show.html.twig', array(
            'comment' => $comment,'user' => $user,
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }

    public function editAction(Request $request, Comment $comment)
    {
        $user =$this->getUser();
        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->createForm('EntitiesBundle\Form\CommentType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_edit', array('id' => $comment->getId()));
        }

        return $this->render('@Forum/comment/edit.html.twig', array(
            'comment' => $comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }

    public function deleteAction(Request $request, Comment $comment)
    {
        $form = $this->createDeleteForm($comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comment_index');
    }

    private function createDeleteForm(Comment $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $comment->getId())))
            ->setMethod('DELETE')
            ->getForm();

    }
}
