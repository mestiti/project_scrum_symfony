<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conge
 *
 * @ORM\Table(name="conge", indexes={@ORM\Index(name="ide_dconge", columns={"ide_dconge"})})
 * @ORM\Entity
 */
class Conge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Conge", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConge;





    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=false)
     */
    private $description;

    /**
     * @var \DemandeConge
     *
     * @ORM\ManyToOne(targetEntity="DemandeConge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_dconge", referencedColumnName="id_dconge")
     * })
     */
    private $ideDconge;

    /**
     * @return int
     */
    public function getIdConge()
    {
        return $this->idConge;
    }

    /**
     * @param int $idConge
     */
    public function setIdConge($idConge)
    {
        $this->idConge = $idConge;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DemandeConge
     */
    public function getIdeDconge()
    {
        return $this->ideDconge;
    }

    /**
     * @param \DemandeConge $ideDconge
     */
    public function setIdeDconge($ideDconge)
    {
        $this->ideDconge = $ideDconge;
    }




}

