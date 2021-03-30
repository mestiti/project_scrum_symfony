<?php

namespace MeetingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeetingBundle:Default:index.html.twig');
    }
    public function sendsmsAction()
    {
        $message = new \DocDocDoc\NexmoBundle\Message\Simple("SenderId", "21620739885", "content of your sms");
        $nexmoResponse = $this->container->get('doc_doc_doc_nexmo')->send($message);
    }
}
