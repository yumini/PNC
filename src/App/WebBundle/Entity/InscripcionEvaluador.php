<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * InscripcionEvaluador
 *
 * @ORM\Table(name="inscripcionevaluador")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\InscripcionEvaluadorRepository")
 */
class InscripcionEvaluador
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
    * @ORM\ManyToOne(targetEntity="Concurso", inversedBy="inscripcionesEvaluador")
    * @ORM\JoinColumn(name="concurso_id", referencedColumnName="id")
    */
    private $concurso;
    
    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="inscripciones")
    * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
    */
    private $evaluador;
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return InscripcionEvaluador
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
     * @param \Date $fechaActualizacion
     * @return InscripcionEvaluador
     */
    public function setFechaActualizacion(\Date $fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    
        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \Date 
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set concurso
     *
     * @param \App\WebBundle\Entity\Concurso $concurso
     * @return InscripcionEvaluador
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
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return InscripcionEvaluador
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