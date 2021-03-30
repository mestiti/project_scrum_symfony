<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BacklogProduit
 *
 * @ORM\Table(name="backlog_produit", indexes={@ORM\Index(name="ide_projet", columns={"ide_projet"})})
 * @ORM\Entity
 */
class BacklogProduit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_backlog_feature", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBacklogFeature;

    /**
     * @var string
     *
     * @ORM\Column(name="feature", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message = "Vous devez remplir ce champs")
     */
    private $feature;

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
     * @return int
     */
    public function getIdBacklogFeature()
    {
        return $this->idBacklogFeature;
    }

    /**
     * @param int $idBacklogFeature
     */
    public function setIdBacklogFeature($idBacklogFeature)
    {
        $this->idBacklogFeature = $idBacklogFeature;
    }

    /**
     * @return string
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param string $feature
     */
    public function setFeature($feature)
    {
        $this->feature = $feature;
    }

    /**
     * @return \Projets
     */
    public function getIdeProjet()
    {
        return $this->ideProjet;
    }

    /**
     * @param \Projets $ideProjet
     */
    public function setIdeProjet($ideProjet)
    {
        $this->ideProjet = $ideProjet;
    }


}

