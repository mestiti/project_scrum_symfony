<?php

namespace ProjectsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectsBundle:Default:index.html.twig');
    }
}
