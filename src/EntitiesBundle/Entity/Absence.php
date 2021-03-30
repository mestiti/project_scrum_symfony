<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 *
 * @ORM\Table(name="absence", indexes={@ORM\Index(name="ide_user", columns={"ide_user"})})
 * @ORM\Entity
 */
class Absence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_absence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAbsence;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="date", length=100, nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=100, nullable=false)
     */
    private $heure;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbre", type="integer", nullable=false)
     */
    private $nbre;

    /**
     * @var \User
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
    public function getIdAbsence()
    {
        return $this->idAbsence;
    }

    /**
     * @param int $idAbsence
     */
    public function setIdAbsence($idAbsence)
    {
        $this->idAbsence = $idAbsence;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param string $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return int
     */
    public function getNbre()
    {
        return $this->nbre;
    }

    /**
     * @param int $nbre
     */
    public function setNbre($nbre)
    {
        $this->nbre = $nbre;
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

