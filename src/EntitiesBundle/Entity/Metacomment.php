<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metacomment
 *
 * @ORM\Table(name="metacomment")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\MetacommentRepository")
 */
class Metacomment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="Metacomment", type="boolean")
     */
    private $metacomment;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="metacomment")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="metacomment")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $comment;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set metacomment
     *
     * @param boolean $metacomment
     *
     * @return \EntitiesBundle\Entity\Metacomment
     */
    public function setMetacomment($metacomment)
    {
        $this->metacomment = $metacomment;

        return $this;
    }

    /**
     * Get metacomment
     *
     * @return bool
     */
    public function getMetacomment()
    {
        return $this->metacomment;
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



    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

}

