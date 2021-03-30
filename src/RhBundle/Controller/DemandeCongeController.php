<?php


namespace RhBundle\Controller;


use EntitiesBundle\Entity\Absence;
use EntitiesBundle\Form\AbsenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitiesBundle\Entity\DemandeConge;
use EntitiesBundle\Entity\Conge;
use EntitiesBundle\Form\DemandeCongeType;
use EntitiesBundle\Form\CongeType;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use EntitiesBundle\Repository\DemandeRepository;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DemandeCongeController  extends Controller
{
    public function createdemandeAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $demandeconge = new DemandeConge();
        $form = $this->createForm(DemandeCongeType::class, $demandeconge);
        $form = $form->handleRequest($request);
        $demandeconge->setIdeUser($user);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demandeconge);
            $em->flush();
            return $this->redirectToRoute('ajoutdemande', array('id' => $demandeconge->getIdDconge()));
        }
        return $this->render('@Rh/absence/ajout_demandeconge.html.twig', array(
            'f' => $form->createView()

        ));
    }

    /*  public function afficher_avisAction()
  {
      $em = $this->getDoctrine()->getManager();
      $demande = $em->getRepository('EntitiesBundle:DemandeConge')->findAvisDQL($this->getIdeUser()->getIdDconge());
      //$demande = $em->getRepository('EntitiesBundle:DemandeConge')->findAll();

      return $this->render('@Rh/absence/afficher_demandeconge.html.twig',array(
          'demandes' => $demande,
      ));
  }*/


    public function AfficherDemandeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('EntitiesBundle:DemandeConge')->findAll();

        return $this->render('@Rh\absence\afficher_demandeconge.html.twig',array(
            'demandes' => $demande,
        ));


    }

    public function AffichercongeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $conge = $em->getRepository('EntitiesBundle:Conge')->findAll();

        return $this->render('@Rh\absence\afficher_c.html.twig',array(
            'conges' => $conge,
        ));


    }

    public function ajouter_congerAction(Request $request, $id)
    {
        $conger = new Conge();
        $form = $this->createForm(CongeType::class, $conger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conger);
            $em->flush();
            $em = $this->getDoctrine()->getManager();
            $demande = $em->getRepository(DemandeConge::class)->find($id);
            $conger->setIdeDconge($demande);

            $em->persist($conger);

            $em->flush();



            /*    $message = new \DocDocDoc\NexmoBundle\Message\Simple("WEMANAGE", "21620739885", "cONGE aCCEPTER");
                $nexmoResponse = $this->container->get('doc_doc_doc_nexmo')->send($message);*/
            return $this->redirectToRoute('afficherc');

        }
        return $this->render('@Rh/absence/ajout_conge.html.twig', array(
            'f' => $form->createView(),

        ));

    }


    public function deletecAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $c = $em->getRepository('EntitiesBundle:Conge')->find($id);
        $em->remove($c);

        $em->flush();

        return $this->redirectToRoute("afficherc");

    }

    public function newdemandeAction($iddem,$dd,$df,$raison)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new DemandeConge();
        $dd=new \DateTime($dd);
        $df=new \DateTime($df);
        $club=$em->getRepository('EntitiesBundle:User')->findOneBy(array('Nom'=>$iddem));
        $task->setDateDebut($dd);
        $task->setDateFin($df);
        $task->setRaison($raison);

        $task->setIdeUser($club);

        $em->persist($task);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($task);
        return new JsonResponse($formatted);
    }

    public function find_congeAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT id_dconge,ide_user,date_debut,date_fin,raison , fos_user.username from demande_conge INNER JOIN fos_user on fos_user.id=demande_conge.ide_user ";
        $params[':dom'] = $username;
        $em = $this->getDoctrine()->getManager();

        $statement = $em->getConnection()->prepare($sql);
        $statement->execute($params);
        $a = $statement->fetchAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($a);
        return new JsonResponse($formatted);
    }
    public function findBYdateAction($date)
    {
        $event = $this->getDoctrine()->getManager()->getRepository('EntitiesBundle:DemandeConge')->findDateDQL($date);
        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());
        $serializer = new Serializer([new DateTimeNormalizer(), $normalizer]);
        $formatted = $serializer->normalize($event,'json', [AbstractNormalizer::ATTRIBUTES => ['idDconge','dateDebut'=>['dateDebut'],'dateFin'=>['dateFin'],'raison','ideUser']]);

        return new JsonResponse($formatted);

    }
}