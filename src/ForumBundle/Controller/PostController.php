<?php

namespace ForumBundle\Controller;

use Dompdf\Dompdf;
use EntitiesBundle\Entity\Metapost;
use EntitiesBundle\Entity\Post;
use EntitiesBundle\Entity\Comment;
use Nexmo\Client;
use Nexmo;
use EntitiesBundle\EntitiesBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EntitiesBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;



class PostController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('EntitiesBundle:Post')->findAll();

        return $this->render('@Forum/post/index.html.twig', array(
            'posts' => $posts,
            'user' => $user
        ));
    }



    public function newAction(Request $request)
    {
        /*pdf*/
        /* $dompdf = new Dompdf();
        $dompdf->load_html('hajer kotti my love');
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('document.pdf');*/


        /**Email**/

      /*  $message = \Swift_Message::newInstance()
            ->setSubject('q')
            ->setFrom('youssefdarderi@gmail.com')
            ->setTo('youssefdarderi@gmail.com')
            ->setBody('aman');
        $this->get('mailer')->send($message);
        $this->addFlash('info','Mail sent successfully');*/
        /*$basic  = new \Nexmo\Client\Credentials\Basic('4ee3bf6f', 'xZhlD1B5d7f5sbDN');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '21620739885',
            'from' => 'WEMANAGE',
            'text' => 'Invitation Pour Sprint '
        ]);*/
        $user = $this->getUser();
        $post = new \EntitiesBundle\Entity\Post();

        $form = $this->createForm('EntitiesBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setDateadded(new \DateTime("now"));
            $post->setSolved(false);
            $user = $this->getUser();
            $post->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_show', array('id' => $post->getId()));
        }

        return $this->render('@Forum/post/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    /**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function showAction(Post $post)
    {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($post);
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('EntitiesBundle:Comment')->findDQL($post->getId());
        $metapost = $em->getRepository('EntitiesBundle:Metapost')->findMetaDQL($post->getId());
        $b = false;
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            if (!empty($metapost)) {
                foreach($metapost as $meta)
                {
                    if ($meta->getUser()->getId() == $user->getId()) {
                        $b = true;
                    }
                }
            }
        }
        return $this->render('@Forum/post/show.html.twig', array(
            'post' => $post,
            'delete_form' => $deleteForm->createView(),
            'user' => $user,
            'comments'=>$comments,
            'metapost'=>$metapost,'b'=>$b,

        ));
    }

    public function editAction(Request $request, Post $post)
    {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('EntitiesBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_edit', array('id' => $post->getId()));
        }

        return $this->render('@Forum/post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'user' => $user
        ));
    }

    public function deleteAction(Request $request, Post $post)
    {
        $user = $this->getUser();
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();

        }

        return $this->redirectToRoute('post_index');
    }
    /**
     * Creates a form to delete a post entity.
     *
     * @param \EntitiesBundle\Entity\Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function commentAction(Request $request, Post $postid)
    {
        $user = $this->getUser();
        $comment = new Comment();
        $form = $this->createForm('EntitiesBundle\Form\CommentType', $comment);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('EntitiesBundle:Post')->find($postid);
        // dump($post);
        // exit();

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $comment->setUser($user);
            $comment->setPost($post);
            $comment->setDateadded(new \DateTime("now"));
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
    public function upvoteAction(Request $request, Post $postid)
    {
        $user = $this->getUser();
        $metapost = new Metapost();

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('EntitiesBundle:Post')->find($postid);
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('EntitiesBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        $user = $this->getUser();
        $postid->setVotecount($postid->getVotecount()+1);

        $metapost->setUser($user);
        $metapost->setPost($post);
        $metapost->setVotetype(false);
        $em->persist($metapost);
        $em->flush();
        return $this->redirectToRoute('post_show', array('id' => $post->getId()));
    }




    public function searchAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('p');
        $post =  $em->getRepository('EntitiesBundle:Post')->findEntitiesByString($requestString);
        if(!$post) {
            $result['post']['error'] = "Post Not found.";
        } else {
            $result['post'] = $this->getRealEntities($post);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($post){
        foreach ($post as $post){
            $realEntities[$post->getId()] = [$post->getTitle()];

        }
        return $realEntities;
    }
    public function solvedAction(Request $request, Post $post)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('EntitiesBundle:Post')->find($post);
        $post->setSolved(true);

        $editForm = $this->createForm('EntitiesBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        $em->persist($post);
        $em->flush();
        return $this->redirectToRoute('post_show', array('id' => $post->getId()));

    }
}
