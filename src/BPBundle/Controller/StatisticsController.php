<?php
namespace BPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntitiesBundle\Entity\UserStoryBacklogProduit;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class StatisticsController extends Controller
{

    public function calculerbpAction(Request $request)
    {$user = $this->getUser()->getUsername();
        $bp=$this->getDoctrine()->getRepository(UserStoryBacklogProduit::class);
        $sql = "select backlog_produit.id_backlog_feature,backlog_produit.feature,user_story_backlog_produit.id_user_story_backlog_produit,user_story_backlog_produit.user_story_bp,user_story_backlog_produit.priority_bp from backlog_produit inner join user_story_backlog_produit on backlog_produit.id_backlog_feature=user_story_backlog_produit.ide_backlog_feat inner join projets on backlog_produit.ide_projet=projets.id_projet inner join fos_user on fos_user.id=projets.ide_product_owner where fos_user.username=:dom ";
        $params[':dom'] = $user;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
        $a = $stmt->fetchAll();


        $var2=$request->request->has('impression');
        $var3=$request->request->has('csv');






        //// traitement pdf
        if($var2==true)
        { $snappy = $this->get('knp_snappy.pdf');


            $user = $this->getUser()->getUsername();
            $sql =  "select id_backlog_feature, feature,id_user_story_backlog_produit,user_story_bp,priority_bp from Backlog_Produit inner join user_story_backlog_produit on  Backlog_Produit.id_backlog_feature=user_story_backlog_produit.ide_backlog_feat  inner join  projets  on projets.id_projet=Backlog_Produit.ide_projet INNER join fos_user on projets.ide_product_owner=fos_user.id WHERE fos_user.username='$user'";


            $params[':dom'] = $user;
            $em = $this->getDoctrine()->getManager();
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute($params);
            $a = $stmt->fetchAll();




            $html = $this->renderView('@BP\backlogpd\pdf.html.twig', array( 'a'=>$a));
            $filename = 'myFirstSnappyPDF';

            return new Response(
                $snappy->getOutputFromHtml($html),
                200,
                array(

                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"',

                )
            );

        }

        ////traitement csv
        else if($var3==true)

        {$conn = $this->get('database_connection');
            $user = $this->getUser()->getUsername();
            $params[':dom'] = $user;

            //Requête
            $results = $conn->query( "select id_backlog_feature, feature,id_user_story_backlog_produit,user_story_bp,priority_bp from Backlog_Produit inner join user_story_backlog_produit on  Backlog_Produit.id_backlog_feature=user_story_backlog_produit.ide_backlog_feat  inner join  projets  on projets.id_projet=Backlog_Produit.ide_projet INNER join fos_user on projets.ide_product_owner=fos_user.id WHERE fos_user.username='$user'");


            $response = new StreamedResponse();
            $response->setCallback(function() use($results) {

                $handle = fopen('php://output', 'w+');
                // Nom des colonnes du CSV
                fputcsv($handle, array('num feature',
                    'feature',
                    'num user story',
                    'user story',
                    'priority',
                ), ';');
                //Champs de la table

                while ($row = $results->fetch()) {

                    fputcsv($handle, array($row['id_backlog_feature'],
                        $row['feature'],
                        $row['id_user_story_backlog_produit'],
                        $row['user_story_bp'],
                        $row['priority_bp']
                    ), ';');

                }

                fclose($handle);
            });


            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $response->headers->set('Content-Disposition','attachment; filename="export.csv"');

            return $response;}

        else

        { $sql1 = "SELECT projets.nom_projet from projets inner join fos_user on projets.ide_product_owner=fos_user.id where fos_user.username=:dom1";
            $params1[':dom1'] = $user;
            $em1 = $this->getDoctrine()->getManager();
            $stmt1 = $em1->getConnection()->prepare($sql1);
            $stmt1->execute($params1);
            $a1 = $stmt1->fetchAll();

            $list1 = $bp->getuser_prio1($a1);//fos_user
            $list30 = $bp->getuser_prio30($a1);
            $list60 = $bp->getuser_prio60($a1);
            $iSomeVar1 = (int)$list1;
            $iSomeVar30 = (int)$list30;
            $iSomeVar60 = (int)$list60;


            $oldColumnChart = new ColumnChart();
            $oldColumnChart->getData()->setArrayToDataTable(
                [
                    ['Name', 'user stories selon les priorités'],
                    ['priority 1', $iSomeVar1 ],
                    ['priority 30', $iSomeVar30],
                    ['priority 60', $iSomeVar60],

                ]
            );
            $oldColumnChart->getOptions()->getLegend()->setPosition('top');
            $oldColumnChart->getOptions()->setWidth(600);
            $oldColumnChart->getOptions()->setHeight(400);
            $oldColumnChart->getOptions()->setColors(['#871B47']);



            return $this->render('@BP\backlogpd\backlogcomplet.html.twig', array(
                'a' => $a, 'oldColumnChart' => $oldColumnChart));
        }


    }



}
