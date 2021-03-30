<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeProjet
 *
 * @ORM\Table(name="demande_projet", indexes={@ORM\Index(name="id_client", columns={"id_client"})})
 * @ORM\Entity
 */
class DemandeProjet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_demande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_demande", type="string", length=40, nullable=false)
     */
    private $nomDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="description_demande", type="string", length=50, nullable=false)
     */
    private $descriptionDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_demande", type="string", length=10, nullable=false)
     */
    private $dureeDemande;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;


}

