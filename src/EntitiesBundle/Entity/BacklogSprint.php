<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BacklogSprint
 *
 * @ORM\Table(name="backlog_sprint", indexes={@ORM\Index(name="id_equipe", columns={"id_equipe"}), @ORM\Index(name="id_projet", columns={"id_projet"}), @ORM\Index(name="id_sm", columns={"id_sm"})})
 * @ORM\Entity
 */

class BacklogSprint
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_bs", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBs;

    /**
     * @var integer
     *
     * @ORM\Column(name="liste_sprint", type="integer", nullable=true)
     */
    private $listeSprint = 'NULL';

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipe", referencedColumnName="id_equipe")
     * })
     */
    private $idEquipe;

    /**
     * @var \Projets
     *
     * @ORM\ManyToOne(targetEntity="Projets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_projet", referencedColumnName="id_projet")
     * })
     */
    private $idProjet;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_Sm", type="integer", nullable=true)
     *
     */
    private $idSm;

    /**
     * @return int
     */
    public function getIdBs()
    {
        return $this->idBs;
    }

    /**
     * @param int $idBs
     */
    public function setIdBs($idBs)
    {
        $this->idBs = $idBs;
    }

    /**
     * @return int
     */
    public function getListeSprint()
    {
        return $this->listeSprint;
    }

    /**
     * @param int $listeSprint
     */
    public function setListeSprint($listeSprint)
    {
        $this->listeSprint = $listeSprint;
    }

    /**
     * @return \Equipe
     */
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }

    /**
     * @param \Equipe $idEquipe
     */
    public function setIdEquipe($idEquipe)
    {
        $this->idEquipe = $idEquipe;
    }

    /**
     * @return \Projets
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * @param \Projets $idProjet
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;
    }

    /**
     * @return \Sm
     */
    public function getIdSm()
    {
        return $this->idSm;
    }

    /**
     * @param \Sm $idSm
     */
    public function setIdSm($idSm)
    {
        $this->idSm = $idSm;
    }
}

