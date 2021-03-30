<?php
 //src/EntitiesBundle/Entity/User.php

namespace EntitiesBundle\Entity;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;



/**
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\DmRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=255,)
     * @Assert\NotBlank(message="Please enter your first name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     */
    protected $Nom;
    /**
     * @ORM\Column(type="string", length=255,)
     * @Assert\NotBlank(message="Please enter your last name.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     */
    protected $prenom;
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date_Naissance;
    /**
     * @var integer
     *
     * @ORM\Column( type="integer", length=20, nullable=true)
     *
     */
    protected $Numero_Tel;
    /**
     * @var integer
     *
     * @ORM\Column( type="integer", length=20, nullable=true)
     *
     */
    protected $UID;

    /**
     * @ORM\Column(type="string", length=255,)
     * @Assert\NotBlank(message="Please enter your first name.")
     * @Assert\Length(
     *     min=10,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     */
    protected $Address;

    /**
     * @var string
     *
     * @ORM\Column( type="string", length=1000, nullable=true)
     * @Assert\NotBlank(message="Please enter birthdate.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $image_user;
    /**
     * @var integer
     *
     * @ORM\Column( type="integer", length=20, nullable=true)
     *
     */
    protected $connected = 0;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * @param mixed $Nom
     */
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }

    /**
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->Date_Naissance;
    }

    /**
     * @param \DateTime $Date_Naissance
     */
    public function setDateNaissance($Date_Naissance)
    {
        $this->Date_Naissance = $Date_Naissance;
    }

    /**
     * @return int
     */
    public function getNumeroTel()
    {
        return $this->Numero_Tel;
    }

    /**
     * @param int $Numero_Tel
     */
    public function setNumeroTel($Numero_Tel)
    {
        $this->Numero_Tel = $Numero_Tel;
    }

    /**
     * @return int
     */
    public function getUID()
    {
        return $this->UID;
    }

    /**
     * @param int $UID
     */
    public function setUID($UID)
    {
        $this->UID = $UID;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param mixed $Address
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;
    }

    /**
     * @return string
     */
    public function getImageUser()
    {
        return $this->image_user;
    }

    /**
     * @param string $image_user
     */
    public function setImageUser($image_user)
    {
        $this->image_user = $image_user;
    }

    /**
     * @return int
     */
    public function getConnected()
    {
        return $this->connected;
    }

    /**
     * @param int $connected
     */
    public function setConnected($connected)
    {
        $this->connected = $connected;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }











    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}