<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserStoryBacklogSprint
 *
 * @ORM\Table(name="user_story_backlog_sprint", indexes={@ORM\Index(name="id_sprint", columns={"id_sprint"})})
 * @ORM\Entity
 */
class UserStoryBacklogSprint
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user_story_bs", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUserStoryBs;

    /**
     * @var string
     *
     * @ORM\Column(name="description_user_story_bs", type="string", length=45, nullable=true)
     */
    private $descriptionUserStoryBs = 'NULL';

    /**
     * @var \Sprint
     *
     * @ORM\ManyToOne(targetEntity="Sprint")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sprint", referencedColumnName="id_sprint")
     * })
     */
    private $idSprint;


}

