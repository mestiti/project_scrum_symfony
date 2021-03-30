<?php

namespace WiemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WiemBundle:Default:index.html.twig');
    }
}
