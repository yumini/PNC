<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\RespuestaRepository")
 */
class Respuesta
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
     * @ORM\Column(name="respuesta", type="text")
     */
    private $respuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="puntaje", type="string", length=2)
     */
    private $puntaje;

    /**
    * @ORM\ManyToOne(targetEntity="ConcursoCriterio", inversedBy="respuestas")
    * @ORM\JoinColumn(name="concursocriterio_id", referencedColumnName="id")
    */
    protected $criterio;

    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="aspectosclaves")
    * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id")
    */
    protected $evaluador;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaCreacion", type="datetime", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="fechaActualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;

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
     * Set respuesta
     *
     * @param string $respuesta
     * @return Respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    
        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set puntaje
     *
     * @param string $puntaje
     * @return Respuesta
     */
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;
    
        return $this;
    }

    /**
     * Get puntaje
     *
     * @return string 
     */
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set criterio
     *
     * @param \App\WebBundle\Entity\ConcursoCriterio $criterio
     * @return Respuesta
     */
    public function setCriterio(\App\WebBundle\Entity\ConcursoCriterio $criterio = null)
    {
        $this->criterio = $criterio;
    
        return $this;
    }

    /**
     * Get criterio
     *
     * @return \App\WebBundle\Entity\ConcursoCriterio 
     */
    public function getCriterio()
    {
        return $this->criterio;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Respuesta
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
     * @return Respuesta
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
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return Respuesta
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
}