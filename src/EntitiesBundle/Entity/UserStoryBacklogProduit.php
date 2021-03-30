<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * UserStoryBacklogProduit
 *
 * @ORM\Table(name="user_story_backlog_produit", indexes={@ORM\Index(name="ide_backlog_feat", columns={"ide_backlog_feat"})})
 * @ORM\Entity(repositoryClass= "EntitiesBundle\Repository\UserStoryBacklogProduitRepository")
 */
class UserStoryBacklogProduit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user_story_backlog_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUserStoryBacklogProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="user_story_bp", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="give a user story")
     */
    private $userStoryBp;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority_bp", type="integer", nullable=false)
     * @Assert\Range(min="1" , max="90")
     * @Assert\NotBlank(message="give a priority between 1 and 90")
     */
    private $priorityBp;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat = '0';

    /**
     * @var \BacklogProduit
     *
     * @ORM\ManyToOne(targetEntity="BacklogProduit")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="ide_backlog_feat", referencedColumnName="id_backlog_feature")
     * })
     */
    private $ideBacklogFeat;

    /**
     * @return int
     */
    public function getIdUserStoryBacklogProduit()
    {
        return $this->idUserStoryBacklogProduit;
    }

    /**
     * @param int $idUserStoryBacklogProduit
     */
    public function setIdUserStoryBacklogProduit($idUserStoryBacklogProduit)
    {
        $this->idUserStoryBacklogProduit = $idUserStoryBacklogProduit;
    }

    /**
     * @return string
     */
    public function getUserStoryBp()
    {
        return $this->userStoryBp;
    }

    /**
     * @param string $userStoryBp
     */
    public function setUserStoryBp($userStoryBp)
    {
        $this->userStoryBp = $userStoryBp;
    }

    /**
     * @return int
     */
    public function getPriorityBp()
    {
        return $this->priorityBp;
    }

    /**
     * @param int $priorityBp
     */
    public function setPriorityBp($priorityBp)
    {
        $this->priorityBp = $priorityBp;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return \BacklogProduit
     */
    public function getIdeBacklogFeat()
    {
        return $this->ideBacklogFeat;
    }

    /**
     * @param \BacklogProduit $ideBacklogFeat
     */
    public function setIdeBacklogFeat($ideBacklogFeat)
    {
        $this->ideBacklogFeat = $ideBacklogFeat;
    }


}

