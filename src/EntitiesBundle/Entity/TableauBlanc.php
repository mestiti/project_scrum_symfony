<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TableauBlanc
 *
 * @ORM\Table(name="tableau_blanc", indexes={@ORM\Index(name="ide_projet", columns={"ide_projet"}), @ORM\Index(name="ide_equipe", columns={"ide_equipe"}), @ORM\Index(name="ide_sprint", columns={"ide_sprint"})})
 * @ORM\Entity
 */
class TableauBlanc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tableau_blanc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTableauBlanc;

    /**
     * @var \Projets
     *
     * @ORM\ManyToOne(targetEntity="Projets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_projet", referencedColumnName="id_projet")
     * })
     */
    private $ideProjet;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_equipe", referencedColumnName="id_equipe")
     * })
     */
    private $ideEquipe;

    /**
     * @var \Sprint
     *
     * @ORM\ManyToOne(targetEntity="Sprint")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_sprint", referencedColumnName="id_sprint")
     * })
     */
    private $ideSprint;


}

