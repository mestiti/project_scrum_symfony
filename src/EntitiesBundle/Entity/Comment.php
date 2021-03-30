<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\CommentRepository")
 */
class Comment
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
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="votecount", type="integer")
     */
    private $votecount=0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateadded", type="datetime")
     */
    private $dateadded;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comment")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="\EntitiesBundle\Entity\Post", inversedBy="comment")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $post;


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
     * Set content
     *
     * @param string $content
     *
     * @return \EntitiesBundle\Entity\Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set votecount
     *
     * @param integer $votecount
     *
     * @return Comment
     */
    public function setVotecount($votecount)
    {
        $this->votecount = $votecount;

        return $this;
    }

    /**
     * Get votecount
     *
     * @return int
     */
    public function getVotecount()
    {
        return $this->votecount;
    }

    /**
     * Set dateadded
     *
     * @param \DateTime $dateadded
     *
     * @return Comment
     */
    public function setDateadded($dateadded)
    {
        $this->dateadded = $dateadded;

        return $this;
    }

    /**
     * Get dateadded
     *
     * @return \DateTime
     */
    public function getDateadded()
    {
        return $this->dateadded;
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
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

}


