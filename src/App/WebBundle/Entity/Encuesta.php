<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Encuesta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\EncuestaRepository")
 */
class Encuesta
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
     * @ORM\Column(name="titulo", type="string", length=100)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var integer
     * @Assert\NotBlank
     * @ORM\Column(name="maxopciones", type="integer")
     */
    private $maxopciones;

    /**
     * @var \DateTime
     * @Assert\NotBlank
     * @ORM\Column(name="inicio", type="date")
     */
    private $inicio;

    /**
     * @var \DateTime
     * @Assert\NotBlank
     * @ORM\Column(name="fin", type="date")
     */
    private $fin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado=true;

    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="encuestas")
    * @ORM\JoinColumn(name="tipoencuesta_id", referencedColumnName="id")
    */
    protected $tipoEncuesta;

    /**
    * @ORM\OneToMany(targetEntity="EncuestaPregunta", mappedBy="encuesta")
    */
    private $preguntas;
    
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
     * Set titulo
     *
     * @param string $titulo
     * @return Encuesta
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Encuesta
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
     * Set maxopciones
     *
     * @param integer $maxopciones
     * @return Encuesta
     */
    public function setMaxopciones($maxopciones)
    {
        $this->maxopciones = $maxopciones;
    
        return $this;
    }

    /**
     * Get maxopciones
     *
     * @return integer 
     */
    public function getMaxopciones()
    {
        return $this->maxopciones;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Encuesta
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    
        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Encuesta
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    
        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Encuesta
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
     * Set tipoEncuesta
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoEncuesta
     * @return Encuesta
     */
    public function setTipoEncuesta(\App\WebBundle\Entity\Catalogo $tipoEncuesta = null)
    {
        $this->tipoEncuesta = $tipoEncuesta;
    
        return $this;
    }

    /**
     * Get tipoEncuesta
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getTipoEncuesta()
    {
        return $this->tipoEncuesta;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add preguntas
     *
     * @param \App\WebBundle\Entity\EncuestaPregunta $preguntas
     * @return Encuesta
     */
    public function addPregunta(\App\WebBundle\Entity\EncuestaPregunta $preguntas)
    {
        $this->preguntas[] = $preguntas;
    
        return $this;
    }

    /**
     * Remove preguntas
     *
     * @param \App\WebBundle\Entity\EncuestaPregunta $preguntas
     */
    public function removePregunta(\App\WebBundle\Entity\EncuestaPregunta $preguntas)
    {
        $this->preguntas->removeElement($preguntas);
    }

    /**
     * Get preguntas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }
}