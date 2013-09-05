<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * Postulante
 *
 * @ORM\Table(name="postulante")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\PostulanteRepository")
 */
class Postulante
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
     * @ORM\Column(name="razonsocial", type="string", length=100)
     */
    private $razonsocial;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=150)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruc", type="string", length=11)
     */
    private $ruc;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=50)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20)
     */
    private $fax;
    
     /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="fechaActualizacion", type="datetime")
     */
    private $fechaActualizacion;

     /**
    * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="postulantes")
    * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
    */
    private $usuario;
    /**
     * @ORM\ManyToMany(targetEntity="GrupoEvaluacion", inversedBy="Postulante")
     * @ORM\JoinTable(name="postulantegrupo")
     */
    private $grupos;
   
    /**
    * @ORM\OneToMany(targetEntity="Postulante", mappedBy="postulantecontacto")
    */
    protected $postulantes;
    
    public function __construct() {
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postulantes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add gruposEvaluacion
     *
     * @param App\WebBundle\Entity\GrupoEvaluacion $grupos
     */
    public function addGrupos(App\WebBundle\Entity\Perfil $grupos)
    {
        $this->grupos[] = $grupos;
    }

    /**
     * Get grupos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
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
     * Set razonsocial
     *
     * @param string $razonsocial
     * @return Postulante
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;
    
        return $this;
    }

    /**
     * Get razonsocial
     *
     * @return string 
     */
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Postulante
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set ruc
     *
     * @param string $ruc
     * @return Postulante
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    
        return $this;
    }

    /**
     * Get ruc
     *
     * @return string 
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Postulante
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
     * Set web
     *
     * @param string $web
     * @return Postulante
     */
    public function setWeb($web)
    {
        $this->web = $web;
    
        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Postulante
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Postulante
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    
        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Postulante
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    
        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }
    /**
     * Add grupos
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacion $grupos
     * @return GrupoEvaluacion
     */
    public function addGrupo(\App\WebBundle\Entity\GrupoEvaluacion $grupos)
    {
        $this->grupos[] = $grupos;
    
        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \App\WebBundle\Entity\Grupo $grupos
     */
    public function removeGrupo(\App\WebBundle\Entity\Grupo $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Set usuario
     *
     * @param \App\WebBundle\Entity\Usuario $usuario
     * @return Postulante
     */
    public function setUsuario(\App\WebBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \App\WebBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }


    /**
     * Add postulantes
     *
     * @param \App\WebBundle\Entity\Postulante $postulantes
     * @return Postulante
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