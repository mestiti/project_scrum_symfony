<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="ide_personnel", columns={"ide_personnel"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet_reclamation", type="string", length=250, nullable=false)
     */
    private $sujetReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=50, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="description_reclamation", type="string", length=300, nullable=false)
     */
    private $descriptionReclamation;

    /**
     * @var \Personnel
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_personnel", referencedColumnName="id")
     * })
     */
    private $idePersonnel;

    /**
     * @return int
     */
    public function getIdReclamation()
    {
        return $this->idReclamation;
    }

    /**
     * @param int $idReclamation
     */
    public function setIdReclamation($idReclamation)
    {
        $this->idReclamation = $idReclamation;
    }

    /**
     * @return string
     */
    public function getSujetReclamation()
    {
        return $this->sujetReclamation;
    }

    /**
     * @param string $sujetReclamation
     */
    public function setSujetReclamation($sujetReclamation)
    {
        $this->sujetReclamation = $sujetReclamation;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getDescriptionReclamation()
    {
        return $this->descriptionReclamation;
    }

    /**
     * @param string $descriptionReclamation
     */
    public function setDescriptionReclamation($descriptionReclamation)
    {
        $this->descriptionReclamation = $descriptionReclamation;
    }

    /**
     * @return \Personnel
     */
    public function getIdePersonnel()
    {
        return $this->idePersonnel;
    }

    /**
     * @param \Personnel $idePersonnel
     */
    public function setIdePersonnel($idePersonnel)
    {
        $this->idePersonnel = $idePersonnel;
    }


}

