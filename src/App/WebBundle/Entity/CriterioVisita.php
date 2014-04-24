<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * CriterioVisita
 *
 * @ORM\Table(name="criteriovisita")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\CriterioVisitaRepository")
 */
class CriterioVisita
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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
    * @ORM\ManyToOne(targetEntity="ConcursoCriterio", inversedBy="visitas")
    * @ORM\JoinColumn(name="concursocriterio_id", referencedColumnName="id")
    */
    protected $criterio;

    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="visitas")
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
    * @ORM\ManyToOne(targetEntity="Inscripcion", inversedBy="visitas")
    * @ORM\JoinColumn(name="inscripcion_id", referencedColumnName="id")
    */
    protected $inscripcion;
    
    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="visitas")
    * @ORM\JoinColumn(name="tipoetapa_id", referencedColumnName="id")
    */
    protected $tipoEtapa;

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
     * Set descripcion
     *
     * @param string $descripcion
     * @return CriterioVisita
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set criterio
     *
     * @param \App\WebBundle\Entity\ConcursoCriterio $criterio
     * @return CriterioVisita
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
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return CriterioVisita
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return CriterioVisita
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
     * @return CriterioVisita
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
     * Set inscripcion
     *
     * @param \App\WebBundle\Entity\Inscripcion $inscripcion
     * @return CriterioVisita
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
     * @return CriterioVisita
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
}