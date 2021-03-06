<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank
     * @ORM\Column(name="razonsocial", type="string", length=100)
     */
    private $razonsocial;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="direccion", type="string", length=150, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="ruc", type="string", length=11, nullable=true)
     */
    private $ruc;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=50, nullable=true)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
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
    * @ORM\OneToMany(targetEntity="PostulanteContacto", mappedBy="postulante")
    */
    protected $contactos;
    
    /**
    * @ORM\OneToMany(targetEntity="Inscripcion", mappedBy="postulante", cascade={"persist"})
    */
    protected $inscripciones;
    
    /**
     * @ORM\ManyToMany(targetEntity="Catalogo")
     * @ORM\JoinTable(name="postulantecategoria")
     */
    private $categorias;
    
    /**
    * @ORM\OneToMany(targetEntity="GrupoEvaluacionEvaluador", mappedBy="evaluador")
    */
    private $grupos;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contactos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inscripciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add contactos
     *
     * @param \App\WebBundle\Entity\PostulanteContacto $contactos
     * @return Postulante
     */
    public function addContacto(\App\WebBundle\Entity\PostulanteContacto $contactos)
    {
        $this->contactos[] = $contactos;
    
        return $this;
    }

    /**
     * Remove contactos
     *
     * @param \App\WebBundle\Entity\PostulanteContacto $contactos
     */
    public function removeContacto(\App\WebBundle\Entity\PostulanteContacto $contactos)
    {
        $this->contactos->removeElement($contactos);
    }

    /**
     * Get contactos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactos()
    {
        return $this->contactos;
    }

    /**
     * Add inscripciones
     *
     * @param \App\WebBundle\Entity\Inscripcion $inscripciones
     * @return Postulante
     */
    public function addInscripcione(\App\WebBundle\Entity\Inscripcion $inscripciones)
    {
        $this->inscripciones[] = $inscripciones;
    
        return $this;
    }

    /**
     * Remove inscripciones
     *
     * @param \App\WebBundle\Entity\Inscripcion $inscripciones
     */
    public function removeInscripcione(\App\WebBundle\Entity\Inscripcion $inscripciones)
    {
        $this->inscripciones->removeElement($inscripciones);
    }

    /**
     * Get inscripciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInscripciones()
    {
        return $this->inscripciones;
    }

    /**
     * Add categorias
     *
     * @param \App\WebBundle\Entity\Catalogo $categorias
     * @return Postulante
     */
    public function addCategoria(\App\WebBundle\Entity\Catalogo $categorias)
    {
        $this->categorias[] = $categorias;
    
        return $this;
    }

    /**
     * Remove categorias
     *
     * @param \App\WebBundle\Entity\Catalogo $categorias
     */
    public function removeCategoria(\App\WebBundle\Entity\Catalogo $categorias)
    {
        $this->categorias->removeElement($categorias);
    }

    /**
     * Get categorias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * Add grupos
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacionEvaluador $grupos
     * @return Postulante
     */
    public function addGrupo(\App\WebBundle\Entity\GrupoEvaluacionEvaluador $grupos)
    {
        $this->grupos[] = $grupos;
    
        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacionEvaluador $grupos
     */
    public function removeGrupo(\App\WebBundle\Entity\GrupoEvaluacionEvaluador $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    public function IsValid(){
        if($this->ruc!="" && $this->razonsocial!="" && $this->direccion!="")
            return 1;
                
        return 0;
    }
}