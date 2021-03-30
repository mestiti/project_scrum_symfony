<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="tache", indexes={@ORM\Index(name="tache_ibfk_1", columns={"ide_user_story_bs"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\Tache_Repository")

 */
class Tache
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Tache", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTache;

    /**
     * @var string
     *
     * @ORM\Column(name="priotity", type="string", length=45, nullable=true)
     */
    private $priotity = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="progress", type="integer", length=50, nullable=true)
     */
    private $progress = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin_tache", type="string", length=50, nullable=true)
     */
    private $dateFinTache = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="nom_tache", type="string", length=45, nullable=true)
     */
    private $nomTache = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="type_tache", type="string", length=45, nullable=true)
     */
    private $typeTache = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="liste_Personnel", type="string", length=50, nullable=true)
     */
    private $listePersonnel = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="description_tache", type="string", length=45, nullable=true)
     */
    private $descriptionTache = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="liste_nbre_heure", type="string", length=45, nullable=true)
     */
    private $listeNbreHeure = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="moyenne_estimation", type="string", length=45, nullable=true)
     */
    private $moyenneEstimation = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50, nullable=false)
     */
    private $etat = '\'TODO\'';

    /**
     * @var \BacklogSprint
     *
     * @ORM\ManyToOne(targetEntity="BacklogSprint")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_user_story_bs", referencedColumnName="id_bs")
     * })
     */
    private $ideUserStoryBs;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user",referencedColumnName="id")
     */
    private $user;

    /**
     * @return int
     */
    public function getIdTache()
    {
        return $this->idTache;
    }

    /**
     * @param int $idTache
     */
    public function setIdTache($idTache)
    {
        $this->idTache = $idTache;
    }

    /**
     * @return string
     */
    public function getpriotity()
    {
        return $this-priotity;
    }

    /**
     * @param string $priotity
     */
    public function sepriotity($priotity)
    {
        $this->priotity = $priotity;
    }

    /**
     * @return string
     */
    public function progress()
    {
        return $this->progress;
    }

    /**
     * @param string $progress
     */
    public function setprogress($progress)
    {
        $this->progress= $progress;
    }

    /**
     * @return string
     */
    public function getDateFinTache()
    {
        return $this->dateFinTache;
    }

    /**
     * @param string $dateFinTache
     */
    public function setDateFinTache($dateFinTache)
    {
        $this->dateFinTache = $dateFinTache;
    }

    /**
     * @return string
     */
    public function getNomTache()
    {
        return $this->nomTache;
    }

    /**
     * @param string $nomTache
     */
    public function setNomTache($nomTache)
    {
        $this->nomTache = $nomTache;
    }

    /**
     * @return string
     */
    public function getTypeTache()
    {
        return $this->typeTache;
    }

    /**
     * @param string $typeTache
     */
    public function setTypeTache($typeTache)
    {
        $this->typeTache = $typeTache;
    }

    /**
     * @return string
     */
    public function getListePersonnel()
    {
        return $this->listePersonnel;
    }

    /**
     * @param string $listePersonnel
     */
    public function setListePersonnel($listePersonnel)
    {
        $this->listePersonnel = $listePersonnel;
    }

    /**
     * @return string
     */
    public function getDescriptionTache()
    {
        return $this->descriptionTache;
    }

    /**
     * @param string $descriptionTache
     */
    public function setDescriptionTache($descriptionTache)
    {
        $this->descriptionTache = $descriptionTache;
    }

    /**
     * @return string
     */
    public function getListeNbreHeure()
    {
        return $this->listeNbreHeure;
    }

    /**
     * @param string $listeNbreHeure
     */
    public function setListeNbreHeure($listeNbreHeure)
    {
        $this->listeNbreHeure = $listeNbreHeure;
    }

    /**
     * @return string
     */
    public function getMoyenneEstimation()
    {
        return $this->moyenneEstimation;
    }

    /**
     * @param string $moyenneEstimation
     */
    public function setMoyenneEstimation($moyenneEstimation)
    {
        $this->moyenneEstimation = $moyenneEstimation;
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
     * @return mixed
     */
    public function getIdeUserStoryBs()
    {
        return $this->ideUserStoryBs;
    }

    /**
     * @param mixed $ideUserStoryBs
     */
    public function setIdeUserStoryBs($ideUserStoryBs)
    {
        $this->ideUserStoryBs = $ideUserStoryBs;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}

