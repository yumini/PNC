<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 

/**
 * CriterioAspectoClave
 *
 * @ORM\Table(name="criterioaspectoclave")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\CriterioAspectoClaveRepository")
 */
class CriterioAspectoClave
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
    * @ORM\ManyToOne(targetEntity="ConcursoCriterio", inversedBy="criteriosaspectosclaves")
    * @ORM\JoinColumn(name="concursocriterio_id", referencedColumnName="id")
    */
    protected $criterio;

    /**
    * @ORM\ManyToOne(targetEntity="AspectoClave", inversedBy="criteriosaspectosclaves")
    * @ORM\JoinColumn(name="aspectoclave_id", referencedColumnName="id")
    */
    protected $aspectoclave;

    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="criteriosaspectosclaves")
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
    * @ORM\ManyToOne(targetEntity="Inscripcion", inversedBy="criteriosaspectosclaves")
    * @ORM\JoinColumn(name="inscripcion_id", referencedColumnName="id")
    */
    protected $inscripcion;

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
     * Set criterio
     *
     * @param \App\WebBundle\Entity\ConcursoCriterio $criterio
     * @return CriterioAspectoClave
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
     * Set aspectoclave
     *
     * @param \App\WebBundle\Entity\AspectoClave $aspectoclave
     * @return CriterioAspectoClave
     */
    public function setAspectoclave(\App\WebBundle\Entity\AspectoClave $aspectoclave = null)
    {
        $this->aspectoclave = $aspectoclave;
    
        return $this;
    }

    /**
     * Get aspectoclave
     *
     * @return \App\WebBundle\Entity\AspectoClave 
     */
    public function getAspectoclave()
    {
        return $this->aspectoclave;
    }

    /**
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return CriterioAspectoClave
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
     * @return CriterioAspectoClave
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
     * @return CriterioAspectoClave
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
     * @return CriterioAspectoClave
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
}