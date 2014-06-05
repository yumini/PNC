<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * Evaluacion
 *
 * @ORM\Table(name="evaluacion")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\EvaluacionRepository")
 */
class Evaluacion
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCierre", type="datetime", nullable=true)
     */
    private $fechaCierre;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaInicio", type="datetime", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abierta", type="boolean")
     */
    private $abierta=true;

    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="evaluaciones")
    * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id")
    */
    protected $evaluador;

    /**
    * @ORM\ManyToOne(targetEntity="Inscripcion", inversedBy="evaluaciones")
    * @ORM\JoinColumn(name="inscripcion_id", referencedColumnName="id")
    */
    protected $inscripcion;

    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="evaluaciones")
    * @ORM\JoinColumn(name="tipoetapa_id", referencedColumnName="id")
    */
    protected $tipoEtapa;


    /**
     * @ORM\OneToOne(targetEntity="Puntaje", mappedBy="evaluacion")
     */
    private $puntajes;
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
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     * @return Evaluacion
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;
    
        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return \DateTime 
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Evaluacion
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Evaluacion
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
     * Set abierta
     *
     * @param boolean $abierta
     * @return Evaluacion
     */
    public function setAbierta($abierta)
    {
        $this->abierta = $abierta;
    
        return $this;
    }

    /**
     * Get abierta
     *
     * @return boolean 
     */
    public function getAbierta()
    {
        return $this->abierta;
    }

    /**
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return Evaluacion
     */
    public function setEvaluador(\App\WebBundle\Entity\Evaluador $evaluador = null)
    {
        $this->evaluador = $evaluador;
    
        return $this;
    }

    /**
     * Get evaluador
     *
     * @return \App\WebBundle\Entity\Evaluador 
     */
    public function getEvaluador()
    {
        return $this->evaluador;
    }

    /**
     * Set inscripcion
     *
     * @param \App\WebBundle\Entity\Inscripcion $inscripcion
     * @return Evaluacion
     */
    public function setInscripcion(\App\WebBundle\Entity\Inscripcion $inscripcion = null)
    {
        $this->inscripcion = $inscripcion;
    
        return $this;
    }

    /**
     * Get inscripcion
     *
     * @return \App\WebBundle\Entity\Inscripcion 
     */
    public function getInscripcion()
    {
        return $this->inscripcion;
    }

    /**
     * Set tipoEtapa
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoEtapa
     * @return Evaluacion
     */
    public function setTipoEtapa(\App\WebBundle\Entity\Catalogo $tipoEtapa = null)
    {
        $this->tipoEtapa = $tipoEtapa;
    
        return $this;
    }

    /**
     * Get tipoEtapa
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getTipoEtapa()
    {
        return $this->tipoEtapa;
    }

    /**
     * Set puntajes
     *
     * @param \App\WebBundle\Entity\Puntaje $puntajes
     * @return Evaluacion
     */
    public function setPuntajes(\App\WebBundle\Entity\Puntaje $puntajes = null)
    {
        $this->puntajes = $puntajes;
    
        return $this;
    }

    /**
     * Get puntajes
     *
     * @return \App\WebBundle\Entity\Puntaje 
     */
    public function getPuntajes()
    {
        return $this->puntajes;
    }
}