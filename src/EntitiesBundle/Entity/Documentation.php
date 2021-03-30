<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documentation
 *
 * @ORM\Table(name="documentation", indexes={@ORM\Index(name="ide_admin", columns={"ide_admin"})})
 * @ORM\Entity
 */
class Documentation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_documentation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDocumentation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_documentation", type="string", length=150, nullable=false)
     */
    private $nomDocumentation;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_documentation", type="string", length=300, nullable=false)
     */
    private $contenuDocumentation;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide_admin", referencedColumnName="id")
     * })
     */
    private $ideAdmin;

    /**
     * @return int
     */
    public function getIdDocumentation()
    {
        return $this->idDocumentation;
    }

    /**
     * @param int $idDocumentation
     */
    public function setIdDocumentation($idDocumentation)
    {
        $this->idDocumentation = $idDocumentation;
    }

    /**
     * @return string
     */
    public function getNomDocumentation()
    {
        return $this->nomDocumentation;
    }

    /**
     * @param string $nomDocumentation
     */
    public function setNomDocumentation($nomDocumentation)
    {
        $this->nomDocumentation = $nomDocumentation;
    }

    /**
     * @return string
     */
    public function getContenuDocumentation()
    {
        return $this->contenuDocumentation;
    }

    /**
     * @param string $contenuDocumentation
     */
    public function setContenuDocumentation($contenuDocumentation)
    {
        $this->contenuDocumentation = $contenuDocumentation;
    }

    /**
     * @return \FosUser
     */
    public function getIdeAdmin()
    {
        return $this->ideAdmin;
    }

    /**
     * @param \FosUser $ideAdmin
     */
    public function setIdeAdmin($ideAdmin)
    {
        $this->ideAdmin = $ideAdmin;
    }


}

