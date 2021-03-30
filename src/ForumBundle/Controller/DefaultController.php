<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render('@Forum/Default/index.html.twig', array(
            'user' => $user,));
    }
}
