<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projets
 *
 * @ORM\Table(name="projets", indexes={@ORM\Index(name="ide_product_owner", columns={"ide_product_owner"})})
 * @ORM\Entity
 */
class Projets
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_projet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_projet", type="string", length=45, nullable=true)
     */
    private $nomProjet ;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_debut_projet", type="date", nullable=true)
     */
    private $dateDebutProjet ;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_fin_projet", type="date", nullable=true)
     */
    private $dateFinProjet ;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat_projet", type="integer", nullable=true)
     */
    private $etatProjet ;

    /**
     * @var string
     *
     * @ORM\Column(name="description_projet", type="text", nullable=true)
     */
    private $descriptionProjet ;

    /**
     * @var integer
     *
     * @ORM\Column(name="ide_equipe", type="integer", nullable=false)
     */
    private $ideEquipe;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_product_owner", referencedColumnName="id")
     * })
     */
    private $ideProductOwner;

    /**
     * @return int
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * @param int $idProjet
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    }

    /**
     * @return string
     */
    public function getNomProjet()
    {
        return $this->nomProjet;
    }

    /**
     * @param string $nomProjet
     */
    public function setNomProjet($nomProjet)
    {
        $this->nomProjet = $nomProjet;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebutProjet()
    {
        return $this->dateDebutProjet;
    }

    /**
     * @param \DateTime $dateDebutProjet
     */
    public function setDateDebutProjet($dateDebutProjet)
    {
        $this->dateDebutProjet = $dateDebutProjet;
    }

    /**
     * @return \DateTime
     */
    public function getDateFinProjet()
    {
        return $this->dateFinProjet;
    }

    /**
     * @param \DateTime $dateFinProjet
     */
    public function setDateFinProjet($dateFinProjet)
    {
        $this->dateFinProjet = $dateFinProjet;
    }

    /**
     * @return int
     */
    public function getEtatProjet()
    {
        return $this->etatProjet;
    }

    /**
     * @param int $etatProjet
     */
    public function setEtatProjet($etatProjet)
    {
        $this->etatProjet = $etatProjet;
    }

    /**
     * @return string
     */
    public function getDescriptionProjet()
    {
        return $this->descriptionProjet;
    }

    /**
     * @param string $descriptionProjet
     */
    public function setDescriptionProjet($descriptionProjet)
    {
        $this->descriptionProjet = $descriptionProjet;
    }

    /**
     * @return int
     */
    public function getIdeEquipe()
    {
        return $this->ideEquipe;
    }

    /**
     * @param int $ideEquipe
     */
    public function setIdeEquipe($ideEquipe)
    {
        $this->ideEquipe = $ideEquipe;
    }

    /**
     * @return User
     */
    public function getIdeProductOwner()
    {
        return $this->ideProductOwner;
    }

    /**
     * @param User $ideProductOwner
     */
    public function setIdeProductOwner($ideProductOwner)
    {
        $this->ideProductOwner = $ideProductOwner;
    }


}

