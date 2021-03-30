<?php

namespace RhBundle\Controller;

use EntitiesBundle\Entity\Absence;
use EntitiesBundle\Form\AbsenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitiesBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class AbsenceController extends Controller
{
    public function AfficherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EntitiesBundle:User')->findAll();

        return $this->render('@Rh\absence\liste_user.html.twig',array(
            'users' => $user,
        ));


    }

    public function test1Action()
    {
        return $this->render('@Rh/absence/liste_user.html.twig');
    }

    public function testAction()
    {

        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository('EntitiesBundle:Absence')->findAll();

        return $this->render('@Rh\absence\liste.html.twig',array(
            'absences' => $absence,
        ));


    }


    public function delete1Action(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository('EntitiesBundle:Absence')->find($id);
        $em->remove($absence);
        $em->flush();
        return $this->redirectToRoute("Afficherab");
    }

    public function createAction( Request $request)
    {

        /* $dompdf = new Dompdf();
        $dompdf->load_html('hello world');
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('document.pdf');*/
        //$em = $this->getDoctrine()->getManager();

        //$user = $em->getRepository('EntitiesBundle:User')->findBy(array('UID'=>'1'));
        //$repository=$this->getDoctrine()->getManager()->getRepository(User::class);
        //$user = $repository->myfindid($id);
        //$user = $em->getRepository('EntitiesBundle:Absence')->find($id);

        $repository=$this->getDoctrine()->getManager()->getRepository('EntitiesBundle:User');
        $user = $repository->finduid();

        $absence= new Absence;
        $form = $this->createForm(AbsenceType::class, $absence);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($absence);
            $em->flush();
            /**Email**/
            $message = \Swift_Message::newInstance()
                ->setSubject('Absence')
                ->setFrom('hajer.kotti@esprit.tn')
                ->setTo('hajer.kotti@esprit.tn')
                ->setBody('Absence ajouté ');
            $this->get('mailer')->send($message);
            $this->addFlash('info','Mail sent successfully');

            return $this->redirectToRoute( 'Afficherab');}
        return $this->render('@Rh/absence/ajout.html.twig',array(
            'f' => $form->createView(),
            'users' => $user
        ));


    }

    public function update1Action($id,Request $request)
    {



        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository('EntitiesBundle:Absence')->find($id);
        $form = $this->createForm(AbsenceType::class, $club);
        $form = $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('Afficherab');}

        return $this->render('@Rh/absence/update_ab.html.twig',array('f' => $form->createView()));

    }


    public function AfficherabAction()
    {
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository('EntitiesBundle:Absence')->findAll();

        return $this->render('@Rh\absence\afficher_ab.html.twig',array(
            'absences' => $absence,
        ));


    }

    public function ajouter_absenceAction(Request $request, $id)
    {
        $absence = new Absence();
        $form = $this->createForm(AbsenceType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($absence);
            $em->flush();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $absence->setIdeUser($user);
            $em->persist($absence);
            $em->flush();
            return $this->redirectToRoute('Afficherab');

        }
        return $this->render('@Rh/absence/ajout.html.twig', array(
            'form' => $form->createView(),

        ));


    }
    public function  find_sprintAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select sprint.id_sprint,sprint.description,sprint.date_debut_sprint,sprint.date_fin_sprint,sprint.liste_user_sroty_bs,projets.nom_projet,equipe.nom_equipe,backlog_sprint.id_bs,fos_user.id from fos_user inner join equipe on equipe.ide_scrum_master=fos_user.id  INNER join projets inner join backlog_sprint on projets.id_projet=backlog_sprint.id_projet and equipe.ide_projet=projets.id_projet inner join sprint on sprint.id_bs=backlog_sprint.id_bs where fos_user.username=:dom";
        $params[':dom'] = $username;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($a);
        return new JsonResponse($formatted);
    }


    public function find_AbsenceAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT id_absence, ide_user, date, heure, nbre ,fos_user.username from absence inner join fos_user on fos_user.id=absence.ide_user   ";
        $params[':dom'] = $username;
        $em = $this->getDoctrine()->getManager();

        $statement = $em->getConnection()->prepare($sql);
        $statement->execute($params);
        $a = $statement->fetchAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($a);
        return new JsonResponse($formatted);
    }
    public function newabAction($idc,$heure,$nbre,$date)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new Absence();
        $date=new \DateTime($date);
        $club=$em->getRepository('EntitiesBundle:User')->findOneBy(array('Nom'=>$idc));
        $task->setDate($date);
        $task->setHeure($heure);
        $task->setNbre($nbre);
       $task->setIdeUser($club);

        $em->persist($task);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($task);
        return new JsonResponse($formatted);
    }

    public function deletemobabAction($id)
    {
        $em = $this ->getDoctrine()->getManager();
        $bp = $em->getRepository('EntitiesBundle:Absence')->find($id);


        $em ->remove($bp);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($bp);
        return new JsonResponse($formatted);
    }

    public function update_mobAction($id,Request $request, $date,$nbre,$heure)
    {


        $date=new \DateTime($date);
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository('EntitiesBundle:Absence')->find($id);


        $club->setDate($date);
        $club->setHeure($heure);
        $club->setNbre($nbre);

        $em = $this->getDoctrine()->getManager();
            $em->flush();

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $encoder = new JsonEncoder();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer(array($normalizer), array($encoder));
        $formatted = $serializer->normalize($club);
        return new JsonResponse($formatted);

    }



    public function findBYdateAction($date)
    {
        $event = $this->getDoctrine()->getManager()->getRepository('EntitiesBundle:Absence')->findDateDQL($date);
        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());
        $serializer = new Serializer([new DateTimeNormalizer(), $normalizer]);
        $formatted = $serializer->normalize($event,'json', [AbstractNormalizer::ATTRIBUTES => ['idAbsence','titre','ideUser','heure','nbre','date'=>['date']]]);

        return new JsonResponse($formatted);

    }



}
