<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe", indexes={@ORM\Index(name="ide_projet", columns={"ide_projet"}), @ORM\Index(name="ide_scrum_master", columns={"ide_scrum_master"}), @ORM\Index(name="ide_perso_1", columns={"ide_perso_1"}), @ORM\Index(name="ide_perso_2", columns={"ide_perso_2"}), @ORM\Index(name="ide_perso_3", columns={"ide_perso_3"}), @ORM\Index(name="ide_perso_4", columns={"ide_perso_4"}), @ORM\Index(name="ide_perso_5", columns={"ide_perso_5"}), @ORM\Index(name="ide_perso_6", columns={"ide_perso_6"})})
 * @ORM\Entity
 */
class Equipe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_equipe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEquipe;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_equipe", type="string", length=20, nullable=false)
     */
    private $nomEquipe;

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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_scrum_master", referencedColumnName="id")
     * })
     */
    private $ideScrumMaster;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_perso_1", referencedColumnName="id")
     * })
     */
    private $idePerso1;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_perso_2", referencedColumnName="id")
     * })
     */
    private $idePerso2;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_perso_3", referencedColumnName="id")
     * })
     */
    private $idePerso3;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_perso_4", referencedColumnName="id")
     * })
     */
    private $idePerso4;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_perso_5", referencedColumnName="id")
     * })
     */
    private $idePerso5;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_perso_6", referencedColumnName="id")
     * })
     */
    private $idePerso6;

    /**
     * @return int
     */
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }

    /**
     * @param int $idEquipe
     */
    public function setIdEquipe($idEquipe)
    {
        $this->idEquipe = $idEquipe;
    }

    /**
     * @return string
     */
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }

    /**
     * @param string $nomEquipe
     */
    public function setNomEquipe($nomEquipe)
    {
        $this->nomEquipe = $nomEquipe;
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
     * @return User
     */
    public function getIdeScrumMaster()
    {
        return $this->ideScrumMaster;
    }

    /**
     * @param User $ideScrumMaster
     */
    public function setIdeScrumMaster($ideScrumMaster)
    {
        $this->ideScrumMaster = $ideScrumMaster;
    }

    /**
     * @return User
     */
    public function getIdePerso1()
    {
        return $this->idePerso1;
    }

    /**
     * @param User $idePerso1
     */
    public function setIdePerso1($idePerso1)
    {
        $this->idePerso1 = $idePerso1;
    }

    /**
     * @return User
     */
    public function getIdePerso2()
    {
        return $this->idePerso2;
    }

    /**
     * @param User $idePerso2
     */
    public function setIdePerso2($idePerso2)
    {
        $this->idePerso2 = $idePerso2;
    }

    /**
     * @return User
     */
    public function getIdePerso3()
    {
        return $this->idePerso3;
    }

    /**
     * @param User $idePerso3
     */
    public function setIdePerso3($idePerso3)
    {
        $this->idePerso3 = $idePerso3;
    }

    /**
     * @return User
     */
    public function getIdePerso4()
    {
        return $this->idePerso4;
    }

    /**
     * @param User $idePerso4
     */
    public function setIdePerso4($idePerso4)
    {
        $this->idePerso4 = $idePerso4;
    }

    /**
     * @return User
     */
    public function getIdePerso5()
    {
        return $this->idePerso5;
    }

    /**
     * @param User $idePerso5
     */
    public function setIdePerso5($idePerso5)
    {
        $this->idePerso5 = $idePerso5;
    }

    /**
     * @return User
     */
    public function getIdePerso6()
    {
        return $this->idePerso6;
    }

    /**
     * @param User $idePerso6
     */
    public function setIdePerso6($idePerso6)
    {
        $this->idePerso6 = $idePerso6;
    }



}

