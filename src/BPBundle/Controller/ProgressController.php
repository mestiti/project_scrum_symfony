<?php

namespace BPBundle\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Diff\DiffColumnChart;
use EntitiesBundle\Entity\UserStoryBacklogProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;


class ProgressController extends Controller
{


    public function progressbpAction(Request $request)
    {$user = $this->getUser()->getUsername();
        $bp1=$this->getDoctrine()->getRepository(UserStoryBacklogProduit::class);

        $sql1 = "SELECT projets.nom_projet from projets inner join fos_user on projets.ide_product_owner=fos_user.id where fos_user.username=:dom1";
        $params1[':dom1'] = $user;
        $em1 = $this->getDoctrine()->getManager();
        $stmt1 = $em1->getConnection()->prepare($sql1);
        $stmt1->execute($params1);
        $a1 = $stmt1->fetchAll();

        $list1=$bp1->getnbsprint($a1);
        $list2=$bp1->getnbtache($a1);

        $iSomeVar1 = (int) $list1;
        $iSomeVar2 = (int) $list2;
        $oldColumnChart = new ColumnChart();
        $oldColumnChart->getData()->setArrayToDataTable(
            [
                ['Name', 'nombre de sprint'],
                ['sprint', $iSomeVar1],
            ]
        );
        $oldColumnChart->getOptions()->getLegend()->setPosition('top');
        $oldColumnChart->getOptions()->setWidth(450);
        $oldColumnChart->getOptions()->setHeight(400);
        $oldColumnChart->getOptions()->setColors(['#871B47']);
        $newColumnChart = new ColumnChart();
        $newColumnChart->getData()->setArrayToDataTable(
            [
                ['Name', ''.' nombre de taches totales'],
                ['taches', $iSomeVar2],
            ]
        );

        $newColumnChart->getOptions()->getLegend()->setPosition('top');
        $newColumnChart->getOptions()->setWidth(450);
        $newColumnChart->getOptions()->setHeight(400);
        $newColumnChart->getOptions()->setDataOpacity(2);



        #  pie des tachess    #}



        $pieChart = new PieChart();

        $listtache=$bp1->getnbtache($a1);
        $iSomeVartache = (int) $listtache;
        $listtachetodo=$bp1->getnbtachetodo($a1);
        $iSomeVartachetodo = (int) $listtachetodo;
        $listtachedoing=$bp1->getnbtachedoing($a1);
        $iSomeVartachedoing = (int) $listtachedoing;
        $listtachedone=$bp1->getnbtachedone($a1);
        $iSomeVartachedone = (int) $listtachedone;



        $data = array();
        $stat = ['UserStoryBacklogProduit', 'priorité'];
        array_push($data, $stat);
        $stat = array();
        array_push($stat, 'to do',0);
        array_push($data, $stat);
        if($iSomeVartache!=0) {

            $stat = array();
            array_push($stat, 'to do', ($iSomeVartachetodo * 100) / $iSomeVartache);
            $nb = ($iSomeVartachetodo * 100) / $iSomeVartache;
            $stat = ['to do', $nb];
            $nb1 = ($iSomeVartachedoing * 100) / $iSomeVartache;
            $stat1 = ['doing', $nb1];
            $nb2 = ($iSomeVartachedone * 100) / $iSomeVartache;
            $stat2 = ['done', $nb2];
            array_push($data, $stat);
            array_push($data, $stat1);
            array_push($data, $stat2);
        }
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle('pourcentage des taches '.' ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->setIs3D(true);
        $pieChart->getOptions()->setColors(['#2888C8','#C0392B','#34495E']);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#34495E');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('@BP\backlogpd\progress.html.twig', array('piechart' => $pieChart,
            'oldColumnChart' => $oldColumnChart,
            'newColumnChart' => $newColumnChart));
    }




}
