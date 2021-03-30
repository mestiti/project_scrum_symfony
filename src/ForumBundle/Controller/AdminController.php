<?php

namespace ForumBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use EntitiesBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use EntitiesBundle\Entity\Metapost;
use EntitiesBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use EntitiesBundle\EntitiesBundle;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;

class AdminController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('EntitiesBundle:Post')->findAll();

        return $this->render('@Forum/post/adminindex.html.twig', array(
            'posts' => $posts,
            'user' => $user
        ));
    }

    public  function showAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('EntitiesBundle:Post')->findAll();

        return $this->render('@Forum/post/adminindex.html.twig', array(
            'posts' => $posts,
            'user' => $user
        ));
    }

    public function admindeleteAction(Request $request, Post $post, $id)
    {
        $user = $this->getUser();
        $post = $this -> getDoctrine() -> getRepository(post::class) -> find($id);
        $em = $this -> getDoctrine() -> getManager();
        $em -> remove($post);
        $em -> flush();
        return $this -> redirectToRoute("forumdash");
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


    private function createDeleteForm(Post $post)
    {
        $user = $this->getUser();
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function statAction()
    {
        $user = $this->getUser();
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $classes = $em->getRepository('EntitiesBundle:Post')->findAll();
        $totallike=0;
        foreach($classes as $post) {
            $totallike=$totallike+$post->getVotecount();
        }

        $data= array();
        $stat=['post', 'nbrlike'];
        $nb=0;
        array_push($data,$stat);
        foreach($classes as $post) {
            $stat=array();
            array_push($stat,$post->getTitle(),(($post->getVotecount()) ));
            $nb=($post->getVotecount());
            $stat=[$post->getTitle(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Likes per post');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('@Forum/post/stat.html.twig', array('pieChart' => $pieChart,'user' => $user));
    }
}

