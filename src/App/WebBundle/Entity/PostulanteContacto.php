<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostulanteContacto
 *
 * @ORM\Table(name="psotulantecontacto")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\PostulanteContactoRepository")
 */
class PostulanteContacto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=250)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=20)
     */
    private $email;

    /**
    * @ORM\OneToMany(targetEntity="Postulante", mappedBy="postulantecontacto")
    */
    protected $postulantes;
    
    public function __construct() {
       $this->postulantes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return PostulanteContacto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return PostulanteContacto
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return PostulanteContacto
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return PostulanteContacto
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PostulanteContacto
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add postulantes
     *
     * @param \App\WebBundle\Entity\Postulante $postulantes
     * @return PostulanteContacto
     */
    public function addPostulante(\App\WebBundle\Entity\Postulante $postulantes)
    {
        $this->postulantes[] = $postulantes;
    
        return $this;
    }

    /**
     * Remove postulantes
     *
     * @param \App\WebBundle\Entity\Postulante $postulantes
     */
    public function removePostulante(\App\WebBundle\Entity\Postulante $postulantes)
    {
        $this->postulantes->removeElement($postulantes);
    }

    /**
     * Get postulantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulantes()
    {
        return $this->postulantes;
    }
}