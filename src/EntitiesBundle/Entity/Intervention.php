<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention", indexes={@ORM\Index(name="ide_reclamation", columns={"ide_reclamation"}), @ORM\Index(name="ide_sm", columns={"ide_sm"})})
 * @ORM\Entity
 */
class Intervention
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_intervention", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIntervention;

    /**
     * @var string
     *
     * @ORM\Column(name="description_intervention", type="string", length=250, nullable=false)
     */
    private $descriptionIntervention;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_intervention", type="date", nullable=false)
     */
    private $dateIntervention;

    /**
     * @var \Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_reclamation", referencedColumnName="id_reclamation")
     * })
     */
    private $ideReclamation;

    /**
     * @var \Sm
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_sm", referencedColumnName="id")
     * })
     */
    private $ideSm;


}

