<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {   $user=$this->getUser();
        if ($user == null){
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'connected' => $this->getUser()
            ]);
        } elseif ($user->hasRole('ROLE_ADMIN')){
            return $this->render('default/Admin.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'connected' => $this->getUser()
            ]);
        } elseif ($user->hasRole('ROLE_SM')){
            return $this->render('default/Admin.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'connected' => $this->getUser()
            ]);
        } elseif ($user->hasRole('ROLE_TEAM')){
            return $this->render('default/Admin.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'connected' => $this->getUser()
            ]);
        } elseif ($user->hasRole('ROLE_PO')){
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'connected' => $this->getUser()
            ]);
        }else{
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'connected' => $this->getUser()
            ]);
        }
    }
    public function index1Action(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need

        return $this->render('default/index.html.twig', array(
            'user' => $user,
        ));
    }
    public function backAction(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need

        return $this->render('default/Admin.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * @Route("/backSM", name="backSM")
     */
    public function backSMAction(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need

        return $this->render('default/SM.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * @Route("/backTeam", name="backTeam")
     */
    public function backTeamAction(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need

        return $this->render('back.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * @Route("/backe", name="backe")
     */
    public function backeAction(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need

        return $this->render('back.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * @Route("/backeSM", name="backeSM")
     */
    public function backeSMAction(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need

        return $this->render('backSM.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * @Route("/backeTeam", name="backeTeam")
     */
    public function backeTeamAction(Request $request)
    {
        $user = $this->getUser();
        // replace this example code with whatever you need

        return $this->render('backTeam.html.twig', array(
            'user' => $user,
        ));
    }
}