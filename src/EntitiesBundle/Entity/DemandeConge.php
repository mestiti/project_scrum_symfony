<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeConge
 *
 * @ORM\Table(name="demande_conge", indexes={@ORM\Index(name="ide_user", columns={"ide_user"})})
 * @ORM\Entity
 */
class DemandeConge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_dconge", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDconge;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="raison", type="string", length=300, nullable=false)
     */
    private $raison;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_user", referencedColumnName="id")
     * })
     */
    private $ideUser;

    /**
     * @return int
     */
    public function getIdDconge()
    {
        return $this->idDconge;
    }

    /**
     * @param int $idDconge
     */
    public function setIdDconge($idDconge)
    {
        $this->idDconge = $idDconge;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return string
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * @param string $raison
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;
    }

    /**
     * @return mixed
     */
    public function getIdeUser()
    {
        return $this->ideUser;
    }

    /**
     * @param \User $ideUser
     */
    public function setIdeUser($ideUser)
    {
        $this->ideUser = $ideUser;
    }


}

