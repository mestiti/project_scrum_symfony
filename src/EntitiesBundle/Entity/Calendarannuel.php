<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendarannuel
 *
 * @ORM\Table(name="calendarannuel", indexes={@ORM\Index(name="id_projet", columns={"id_projet"})})
 * @ORM\Entity
 */
class Calendarannuel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="term", type="string", length=255, nullable=false)
     */
    private $term;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateC", type="date", nullable=false)
     */
    private $datec;

    /**
     * @var \Projets
     *
     * @ORM\ManyToOne(targetEntity="Projets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_projet", referencedColumnName="id_projet")
     * })
     */
    private $idProjet;


}

