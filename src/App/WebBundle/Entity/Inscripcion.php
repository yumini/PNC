<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * Inscripcion
 *
 * @ORM\Table(name="inscripcion")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\InscripcionRepository")
 */
class Inscripcion
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
     * @ORM\Column(name="nombreproyecto", type="string", length=100, nullable=true)
     */
    private $nombreproyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrecorto", type="string", length=30, nullable=true)
     */
    private $nombrecorto;

     /**
     * @var string
     *
     * @ORM\Column(name="nombreequipo", type="string", length=100, nullable=true)
     */
    private $nombreEquipo;

    /**
     * @var string
     *
     * @ORM\Column(name="integrantes", type="string", length=500, nullable=true)
     */
    private $integrantes;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivoproyecto", type="string", length=50, nullable=true)
     */
    private $objetivoproyecto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechainiciopy", type="date", nullable=true)
     */
    private $fechainiciopy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechafinpy", type="date", nullable=true)
     */
    private $fechafinpy;

    /**
     * @var string
     *
     * @ORM\Column(name="informepostulacionc", type="string", length=50, nullable=true)
     */
    private $informepostulacionc;

    /**
     * @var string
     *
     * @ORM\Column(name="informepostulacionsic", type="string", length=50, nullable=true)
     */
    private $informepostulacionsic;

    /**
     * @var integer
     *
     * @ORM\Column(name="terminoaceptacion", type="integer", nullable=true)
     */
    private $terminoaceptacion;


    /**
    * @ORM\ManyToOne(targetEntity="Concurso", inversedBy="inscripciones")
    * @ORM\JoinColumn(name="concurso_id", referencedColumnName="id")
    */
    private $concurso;
    
    /**
    * @ORM\ManyToOne(targetEntity="Postulante", inversedBy="inscripciones")
    * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
    */
    private $postulante;
    
    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaRegistro", type="datetime")
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="fechaActualizacion", type="datetime")
     */
    private $fechaActualizacion;

    /**
    * @ORM\OneToMany(targetEntity="Inscripcion", mappedBy="inscripcion")
    */
    private $aspectosclaves;

    /**
    * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="inscripcion")
    */
    private $respuestas;

    /**
    * @ORM\OneToMany(targetEntity="CriterioVisita", mappedBy="inscripcion")
    */
    private $visitas;

    /**
    * @ORM\OneToMany(targetEntity="CriterioAspectoClave", mappedBy="inscripcion")
    */
    private $criteriosaspectosclaves;
    
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
     * Set nombreproyecto
     *
     * @param string $nombreproyecto
     * @return Inscripcion
     */
    public function setNombreproyecto($nombreproyecto)
    {
        $this->nombreproyecto = $nombreproyecto;
    
        return $this;
    }

    /**
     * Get nombreproyecto
     *
     * @return string 
     */
    public function getNombreproyecto()
    {
        return $this->nombreproyecto;
    }

    /**
     * Set nombrecorto
     *
     * @param string $nombrecorto
     * @return Inscripcion
     */
    public function setNombrecorto($nombrecorto)
    {
        $this->nombrecorto = $nombrecorto;
    
        return $this;
    }

    /**
     * Get nombrecorto
     *
     * @return string 
     */
    public function getNombrecorto()
    {
        return $this->nombrecorto;
    }

    /**
     * Set integrantes
     *
     * @param string $integrantes
     * @return Inscripcion
     */
    public function setIntegrantes($integrantes)
    {
        $this->integrantes = $integrantes;
    
        return $this;
    }

    /**
     * Get integrantes
     *
     * @return string 
     */
    public function getIntegrantes()
    {
        return $this->integrantes;
    }

    /**
     * Set objetivoproyecto
     *
     * @param string $objetivoproyecto
     * @return Inscripcion
     */
    public function setObjetivoproyecto($objetivoproyecto)
    {
        $this->objetivoproyecto = $objetivoproyecto;
    
        return $this;
    }

    /**
     * Get objetivoproyecto
     *
     * @return string 
     */
    public function getObjetivoproyecto()
    {
        return $this->objetivoproyecto;
    }

    /**
     * Set fechainiciopy
     *
     * @param \DateTime $fechainiciopy
     * @return Inscripcion
     */
    public function setFechainiciopy($fechainiciopy)
    {
        $this->fechainiciopy = $fechainiciopy;
    
        return $this;
    }

    /**
     * Get fechainiciopy
     *
     * @return \DateTime 
     */
    public function getFechainiciopy()
    {
        return $this->fechainiciopy;
    }

    /**
     * Set fechafinpy
     *
     * @param \DateTime $fechafinpy
     * @return Inscripcion
     */
    public function setFechafinpy($fechafinpy)
    {
        $this->fechafinpy = $fechafinpy;
    
        return $this;
    }

    /**
     * Get fechafinpy
     *
     * @return \DateTime 
     */
    public function getFechafinpy()
    {
        return $this->fechafinpy;
    }

    /**
     * Set informepostulacionc
     *
     * @param string $informepostulacionc
     * @return Inscripcion
     */
    public function setInformepostulacionc($informepostulacionc)
    {
        $this->informepostulacionc = $informepostulacionc;
    
        return $this;
    }

    /**
     * Get informepostulacionc
     *
     * @return string 
     */
    public function getInformepostulacionc()
    {
        return $this->informepostulacionc;
    }

    /**
     * Set informepostulacionsic
     *
     * @param string $informepostulacionsic
     * @return Inscripcion
     */
    public function setInformepostulacionsic($informepostulacionsic)
    {
        $this->informepostulacionsic = $informepostulacionsic;
    
        return $this;
    }

    /**
     * Get informepostulacionsic
     *
     * @return string 
     */
    public function getInformepostulacionsic()
    {
        return $this->informepostulacionsic;
    }

    /**
     * Set terminoaceptacion
     *
     * @param integer $terminoaceptacion
     * @return Inscripcion
     */
    public function setTerminoaceptacion($terminoaceptacion)
    {
        $this->terminoaceptacion = $terminoaceptacion;
    
        return $this;
    }

    /**
     * Get terminoaceptacion
     *
     * @return integer 
     */
    public function getTerminoaceptacion()
    {
        return $this->terminoaceptacion;
    }

    /**
     * Set concurso
     *
     * @param \App\WebBundle\Entity\Concurso $concurso
     * @return Inscripcion
     */
    public function setConcurso(\App\WebBundle\Entity\Concurso $concurso = null)
    {
        $this->concurso = $concurso;
    
        return $this;
    }

    /**
     * Get concurso
     *
     * @return \App\WebBundle\Entity\Concurso 
     */
    public function getConcurso()
    {
        return $this->concurso;
    }

    /**
     * Set nombreEquipo
     *
     * @param string $nombreEquipo
     * @return Inscripcion
     */
    public function setNombreEquipo($nombreEquipo)
    {
        $this->nombreEquipo = $nombreEquipo;
    
        return $this;
    }

    /**
     * Get nombreEquipo
     *
     * @return string 
     */
    public function getNombreEquipo()
    {
        return $this->nombreEquipo;
    }

    /**
     * Set postulante
     *
     * @param \App\WebBundle\Entity\Postulante $postulante
     * @return Inscripcion
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

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Inscripcion
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Inscripcion
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
     * Constructor
     */
    public function __construct()
    {
        $this->aspectosclaves = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add aspectosclaves
     *
     * @param \App\WebBundle\Entity\Inscripcion $aspectosclaves
     * @return Inscripcion
     */
    public function addAspectosclave(\App\WebBundle\Entity\Inscripcion $aspectosclaves)
    {
        $this->aspectosclaves[] = $aspectosclaves;
    
        return $this;
    }

    /**
     * Remove aspectosclaves
     *
     * @param \App\WebBundle\Entity\Inscripcion $aspectosclaves
     */
    public function removeAspectosclave(\App\WebBundle\Entity\Inscripcion $aspectosclaves)
    {
        $this->aspectosclaves->removeElement($aspectosclaves);
    }

    /**
     * Get aspectosclaves
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAspectosclaves()
    {
        return $this->aspectosclaves;
    }

    /**
     * Add respuestas
     *
     * @param \App\WebBundle\Entity\Respuesta $respuestas
     * @return Inscripcion
     */
    public function addRespuesta(\App\WebBundle\Entity\Respuesta $respuestas)
    {
        $this->respuestas[] = $respuestas;
    
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \App\WebBundle\Entity\Respuesta $respuestas
     */
    public function removeRespuesta(\App\WebBundle\Entity\Respuesta $respuestas)
    {
        $this->respuestas->removeElement($respuestas);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Add visitas
     *
     * @param \App\WebBundle\Entity\CriterioVisita $visitas
     * @return Inscripcion
     */
    public function addVisita(\App\WebBundle\Entity\CriterioVisita $visitas)
    {
        $this->visitas[] = $visitas;
    
        return $this;
    }

    /**
     * Remove visitas
     *
     * @param \App\WebBundle\Entity\CriterioVisita $visitas
     */
    public function removeVisita(\App\WebBundle\Entity\CriterioVisita $visitas)
    {
        $this->visitas->removeElement($visitas);
    }

    /**
     * Get visitas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisitas()
    {
        return $this->visitas;
    }

    /**
     * Add criteriosaspectosclaves
     *
     * @param \App\WebBundle\Entity\CriterioAspectoClave $criteriosaspectosclaves
     * @return Inscripcion
     */
    public function addCriteriosaspectosclave(\App\WebBundle\Entity\CriterioAspectoClave $criteriosaspectosclaves)
    {
        $this->criteriosaspectosclaves[] = $criteriosaspectosclaves;
    
        return $this;
    }

    /**
     * Remove criteriosaspectosclaves
     *
     * @param \App\WebBundle\Entity\CriterioAspectoClave $criteriosaspectosclaves
     */
    public function removeCriteriosaspectosclave(\App\WebBundle\Entity\CriterioAspectoClave $criteriosaspectosclaves)
    {
        $this->criteriosaspectosclaves->removeElement($criteriosaspectosclaves);
    }

    /**
     * Get criteriosaspectosclaves
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCriteriosaspectosclaves()
    {
        return $this->criteriosaspectosclaves;
    }
}