<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rconflit
 *
 * @ORM\Table(name="rconflit", indexes={@ORM\Index(name="id_conflit", columns={"id_conflit"})})
 * @ORM\Entity
 */
class Rconflit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rconflit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRconflit;

    /**
     * @var string
     *
     * @ORM\Column(name="descr", type="string", length=255, nullable=false)
     */
    private $descr;

    /**
     * @var \Conflit
     *
     * @ORM\ManyToOne(targetEntity="Conflit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conflit", referencedColumnName="id_conflit")
     * })
     */
    private $idConflit;


}

