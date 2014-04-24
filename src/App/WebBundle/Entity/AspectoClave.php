<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * AspectoClave
 *
 * @ORM\Table(name="aspectoclave")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\AspectoClaveRepository")
 */
class AspectoClave
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
    * @ORM\ManyToOne(targetEntity="ConcursoCriterio", inversedBy="aspectosclaves")
    * @ORM\JoinColumn(name="concursocriterio_id", referencedColumnName="id")
    */
    protected $criterio;

    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="aspectosclaves")
    * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id")
    */
    protected $evaluador;

    /**
    * @ORM\ManyToOne(targetEntity="Inscripcion", inversedBy="aspectosclaves")
    * @ORM\JoinColumn(name="inscripcion_id", referencedColumnName="id")
    */
    protected $inscripcion;

    /**
    * @ORM\OneToMany(targetEntity="CriterioAspectoClave", mappedBy="aspectoclave")
    */
    protected $criteriosaspectosclaves;

     /**
    * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="aspectoclave")
    */
    protected $respuestas;

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
     * @var string
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado=true;

    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="aspectosclaves")
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
     * @return AspectoClave
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
     * @return AspectoClave
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
     * Constructor
     */
    public function __construct()
    {
        $this->criteriosaspectosclaves = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add criteriosaspectosclaves
     *
     * @param \App\WebBundle\Entity\CriterioAspectoClave $criteriosaspectosclaves
     * @return AspectoClave
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

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return AspectoClave
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
     * @return AspectoClave
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
     * @return AspectoClave
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
     * Add respuestas
     *
     * @param \App\WebBundle\Entity\Respuesta $respuestas
     * @return AspectoClave
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
     * Set inscripcion
     *
     * @param \App\WebBundle\Entity\Inscripcion $inscripcion
     * @return AspectoClave
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
     * Set estado
     *
     * @param boolean $estado
     * @return AspectoClave
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipoEtapa
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoEtapa
     * @return AspectoClave
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