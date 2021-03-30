<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EntitiesBundle\Entity\Equipe;
use EntitiesBundle\Entity\Projets;

/**
 * SprintReview
 *
 * @ORM\Table(name="sprint_review", indexes={@ORM\Index(name="ide_equipe", columns={"ide_equipe"}), @ORM\Index(name="ide_product_owner", columns={"ide_product_owner"}), @ORM\Index(name="ide_projet", columns={"ide_projet"}), @ORM\Index(name="ide_sprint", columns={"ide_sprint"})})
 * @ORM\Entity
 */
class SprintReview
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sprint_review", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSprintReview;

    /**
     * @var string
     *
     * @ORM\Column(name="remarque_review_equipe", type="text", length=65535, nullable=true)
     */
    private $remarqueReviewEquipe = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="remarque_review_product_owner", type="text", length=65535, nullable=false)
     */
    private $remarqueReviewProductOwner;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_sprint_review", type="date", nullable=false)
     */
    private $dateSprintReview;

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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_product_owner", referencedColumnName="id")
     * })
     */
    private $ideProductOwner;

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
     * @var \Sprint
     *
     * @ORM\ManyToOne(targetEntity="Sprint")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_sprint", referencedColumnName="id_sprint")
     * })
     */
    private $ideSprint;

    /**
     * @return int
     */
    public function getIdSprintReview()
    {
        return $this->idSprintReview;
    }

    /**
     * @param int $idSprintReview
     */
    public function setIdSprintReview($idSprintReview)
    {
        $this->idSprintReview = $idSprintReview;
    }

    /**
     * @return string
     */
    public function getRemarqueReviewEquipe()
    {
        return $this->remarqueReviewEquipe;
    }

    /**
     * @param string $remarqueReviewEquipe
     */
    public function setRemarqueReviewEquipe($remarqueReviewEquipe)
    {
        $this->remarqueReviewEquipe = $remarqueReviewEquipe;
    }

    /**
     * @return string
     */
    public function getRemarqueReviewProductOwner()
    {
        return $this->remarqueReviewProductOwner;
    }

    /**
     * @param string $remarqueReviewProductOwner
     */
    public function setRemarqueReviewProductOwner($remarqueReviewProductOwner)
    {
        $this->remarqueReviewProductOwner = $remarqueReviewProductOwner;
    }

    /**
     * @return \DateTime
     */
    public function getDateSprintReview()
    {
        return $this->dateSprintReview;
    }

    /**
     * @param \DateTime $dateSprintReview
     */
    public function setDateSprintReview($dateSprintReview)
    {
        $this->dateSprintReview = $dateSprintReview;
    }

    /**
     * @return \Equipe
     */
    public function getIdeEquipe()
    {
        return $this->ideEquipe;
    }

    /**
     * @param \integer $ideEquipe
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

    /**
     * @return mixed
     */
    public function getIdeSprint()
    {
        return $this->ideSprint;
    }

    /**
     * @param \Sprint $ideSprint
     */
    public function setIdeSprint($ideSprint)
    {
        $this->ideSprint = $ideSprint;
    }




}

