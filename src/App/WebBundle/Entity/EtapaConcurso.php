<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * EtapaConcurso
 *
 * @ORM\Table(name="etapaconcurso")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\EtapaConcursoRepository")
 */
class EtapaConcurso
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
     * @ORM\Column(name="fechaInicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="date")
     */
    private $fechaFin;
    
    /**
     * @var string
     *
     * @ORM\Column(name="extendido", type="boolean")
     */
    private $extendido;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaExtension", type="date",nullable=true)
     */
    private $fechaExtension;
    
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
    * @ORM\ManyToOne(targetEntity="Etapa", inversedBy="etapasconcurso")
    * @ORM\JoinColumn(name="etapa_id", referencedColumnName="id")
    */
    protected $etapa;
    
    /**
    * @ORM\ManyToOne(targetEntity="Concurso", inversedBy="etapasconcurso")
    * @ORM\JoinColumn(name="concurso_id", referencedColumnName="id")
    */
    protected $concurso;
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return EtapaConcurso
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
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return EtapaConcurso
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    
        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set extendido
     *
     * @param boolean $extendido
     * @return EtapaConcurso
     */
    public function setExtendido($extendido)
    {
        $this->extendido = $extendido;
    
        return $this;
    }

    /**
     * Get extendido
     *
     * @return boolean 
     */
    public function getExtendido()
    {
        return $this->extendido;
    }

    /**
     * Set fechaExtension
     *
     * @param \DateTime $fechaExtension
     * @return EtapaConcurso
     */
    public function setFechaExtension($fechaExtension)
    {
        $this->fechaExtension = $fechaExtension;
    
        return $this;
    }

    /**
     * Get fechaExtension
     *
     * @return \DateTime 
     */
    public function getFechaExtension()
    {
        return $this->fechaExtension;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return EtapaConcurso
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
     * @return EtapaConcurso
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
     * Set etapa
     *
     * @param \App\WebBundle\Entity\Etapa $etapa
     * @return EtapaConcurso
     */
    public function setEtapa(\App\WebBundle\Entity\Etapa $etapa = null)
    {
        $this->etapa = $etapa;
    
        return $this;
    }

    /**
     * Get etapa
     *
     * @return \App\WebBundle\Entity\Etapa 
     */
    public function getEtapa()
    {
        return $this->etapa;
    }

    /**
     * Set concurso
     *
     * @param \App\WebBundle\Entity\Concurso $concurso
     * @return EtapaConcurso
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
}