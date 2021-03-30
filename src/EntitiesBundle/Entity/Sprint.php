<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;


/**
 * Sprint
 *
 * @ORM\Table(name="sprint", indexes={@ORM\Index(name="id_bs", columns={"id_bs"})})
 * @ORM\Entity
 */
class Sprint
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sprint", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSprint;

    /**
     * @var \DateTime
     *
     * @Assert\Date
     * @Assert\GreaterThanOrEqual("today")
     * @ORM\Column(name="date_debut_sprint", type="date", nullable=true)
     */
    private $dateDebutSprint;

    /**
     * @var \DateTime
     *
     * @Assert\Date
     * @Assert\GreaterThanOrEqual(propertyPath="dateDebutSprint",message="La date fin doit etre supp à la date début")
     * @ORM\Column(name="date_fin_sprint", type="date", nullable=true)
     */
    private $dateFinSprint ;

    /**
     * @var integer
     *
     * @ORM\Column(name="liste_user_sroty_bs", type="integer", nullable=true)
     */
    private $listeUserSrotyBs ;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description ;

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
     * @return int
     */
    public function getIdSprint()
    {
        return $this->idSprint;
    }

    /**
     * @param int $idSprint
     */
    public function setIdSprint($idSprint)
    {
        $this->idSprint = $idSprint;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebutSprint()
    {
        return $this->dateDebutSprint;
    }

    /**
     * @param \DateTime $dateDebutSprint
     */
    public function setDateDebutSprint($dateDebutSprint)
    {
        $this->dateDebutSprint = $dateDebutSprint;
    }

    /**
     * @return \DateTime
     */
    public function getDateFinSprint()
    {
        return $this->dateFinSprint;
    }

    /**
     * @param \DateTime $dateFinSprint
     */
    public function setDateFinSprint($dateFinSprint)
    {
        $this->dateFinSprint = $dateFinSprint;
    }

    /**
     * @return int
     */
    public function getListeUserSrotyBs()
    {
        return $this->listeUserSrotyBs;
    }

    /**
     * @param int $listeUserSrotyBs
     */
    public function setListeUserSrotyBs($listeUserSrotyBs)
    {
        $this->listeUserSrotyBs = $listeUserSrotyBs;
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
     * @return \BacklogSprint
     */
    public function getIdBs()
    {
        return $this->idBs;
    }

    /**
     * @param \BacklogSprint $idBs
     */
    public function setIdBs($idBs)
    {
        $this->idBs = $idBs;
    }


}

