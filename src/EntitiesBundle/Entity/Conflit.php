<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conflit
 *
 * @ORM\Table(name="conflit", indexes={@ORM\Index(name="id_bs", columns={"id_bs"}), @ORM\Index(name="id_equipe", columns={"id_equipe"}), @ORM\Index(name="id_sm", columns={"id_sm"})})
 * @ORM\Entity
 */
class Conflit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_conflit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConflit;

    /**
     * @var string
     *
     * @ORM\Column(name="description_conflit", type="string", length=255, nullable=true)
     */
    private $descriptionConflit = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="etat_conflit", type="integer", nullable=true)
     */
    private $etatConflit = 'NULL';

    /**
     * @var \BacklogSprint
     *
     * @ORM\ManyToOne(targetEntity="BacklogSprint")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bs", referencedColumnName="id_bs")
     * })
     */
    private $idBs;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipe", referencedColumnName="id_equipe")
     * })
     */
    private $idEquipe;

    /**
     * @var \Sm
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sm", referencedColumnName="id")
     * })
     */
    private $idSm;


}

