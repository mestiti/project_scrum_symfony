<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DailyMeeting
 *
 * @ORM\Table(name="daily_meeting", indexes={@ORM\Index(name="ide_equipe", columns={"ide_equipe"})})
 * @ORM\Entity
 */
class DailyMeeting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_daily_meeting", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDailyMeeting;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=50, nullable=true)
     */
    private $heure = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="remarque", type="string", length=45, nullable=true)
     */
    private $remarque = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_daily", type="date", nullable=false)
     */
    private $dateDaily;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_equipe", referencedColumnName="id_equipe")
     * })
     */
    private $ideEquipe;


}

