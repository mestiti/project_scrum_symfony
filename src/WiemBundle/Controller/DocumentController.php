<?php

namespace WiemBundle\Controller;

use Couchbase\Document;
use EntitiesBundle\Entity\Formation;
use EntitiesBundle\Entity\Image;
use EntitiesBundle\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class DocumentController extends Controller
{

    public function uploadAction(Request $request)
    {
        $u = new Image();
        $form = $this->createForm(ImageType::class,$u);
       $form= $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();


            $file = $u->getNom();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
            $u->setNom($fileName);


            $em->persist($u);
            $em->flush();

            return $this->redirectToRoute('upload',array('id'=>$u->getId()));

        }
        return $this->render('WiemBundle:Documentation:Create.html.twig',array('file'=>$u ,'f'=>$form->createView()));

    }

    public function readAction(Request $request)
    {
        $image = "image/file.png";
        $file = $this->getDoctrine()
            ->getRepository(Image::class)->findAll();
        return $this->render('WiemBundle:Documentation:Read.html.twig', array('f' => $file));


    }


    public function updateAction(Request $request,$id)
    {   $em = $this->getDoctrine()->getManager();
        $doc = $em->getRepository(Image::class)->find($id);
        $form = $this->createForm(ImageType::class, $doc);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('readD');
        }
        return $this->render('WiemBundle:Documentation:Update.html.twig', array('f' => $form->createView()));


    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $clubs = $this->getDoctrine()
            -> getRepository(Image::class)->find($id);
        $em->remove($clubs);
        $em ->flush();
        return $this->redirectToRoute("readD");
    }
}
