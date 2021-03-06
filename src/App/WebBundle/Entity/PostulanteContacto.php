<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * PostulanteContacto
 *
 * @ORM\Table(name="postulantecontacto")
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
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=250)
     * @Assert\NotBlank()
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=20)
     * @Assert\Email(
     *     message = "El mail '{{ value }}' ingresado no tiene el formato correcto."
     * )
     * @Assert\NotBlank()
     */
    private $email;

     /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="postulantecatalogos")
    * @ORM\JoinColumn(name="catalogo_tc_id", referencedColumnName="id")
    */
    private $postulantecontacto;
    
     /**
    * @ORM\ManyToOne(targetEntity="Postulante", inversedBy="contactos")
    * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
    */
    private $postulante;
    
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
     * Set postulantecontacto
     *
     * @param \App\WebBundle\Entity\Catalogo $postulantecontacto
     * @return PostulanteContacto
     */
    public function setPostulantecontacto(\App\WebBundle\Entity\Catalogo $postulantecontacto = null)
    {
        $this->postulantecontacto = $postulantecontacto;
    
        return $this;
    }

    /**
     * Get postulantecontacto
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getPostulantecontacto()
    {
        return $this->postulantecontacto;
    }

    /**
     * Set postulante
     *
     * @param \App\WebBundle\Entity\Postulante $postulante
     * @return PostulanteContacto
     */
    public function setPostulante(\App\WebBundle\Entity\Postulante $postulante = null)
    {
        $this->postulante = $postulante;
    
        return $this;
    }

    /**
     * Get postulante
     *
     * @return \App\WebBundle\Entity\Postulante 
     */
    public function getPostulante()
    {
        return $this->postulante;
    }
}