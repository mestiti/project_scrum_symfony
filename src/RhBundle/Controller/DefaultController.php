<?php

namespace RhBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RhBundle:Default:index.html.twig');
    }
}
