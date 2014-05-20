<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EncuestaPregunta
 *
 * @ORM\Table(name="encuestapregunta")
 * @ORM\Entity
 */
class EncuestaPregunta
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
     * @ORM\Column(name="pregunta", type="string", length=300)
     */
    private $pregunta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var integer
     * @Assert\NotBlank
     * @ORM\Column(name="orden", type="integer")
     */
    private $orden;

    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="grupospreguntas")
    * @ORM\JoinColumn(name="grupopregunta_id", referencedColumnName="id")
    */
    protected $grupo;

    /**
    * @ORM\ManyToOne(targetEntity="Encuesta", inversedBy="preguntas")
    * @ORM\JoinColumn(name="encuesta_id", referencedColumnName="id")
    */
    protected $encuesta;

    /**
    * @ORM\OneToMany(targetEntity="EncuestaPreguntaOpcion", mappedBy="pregunta")
    */
    private $opciones;
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
     * Set pregunta
     *
     * @param string $pregunta
     * @return EncuestaPregunta
     */
    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;
    
        return $this;
    }

    /**
     * Get pregunta
     *
     * @return string 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return EncuestaPregunta
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
     * Set orden
     *
     * @param integer $orden
     * @return EncuestaPregunta
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set grupo
     *
     * @param \App\WebBundle\Entity\Catalogo $grupo
     * @return EncuestaPregunta
     */
    public function setGrupo(\App\WebBundle\Entity\Catalogo $grupo = null)
    {
        $this->grupo = $grupo;
    
        return $this;
    }

    /**
     * Get grupo
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->opciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set encuesta
     *
     * @param \App\WebBundle\Entity\Encuesta $encuesta
     * @return EncuestaPregunta
     */
    public function setEncuesta(\App\WebBundle\Entity\Encuesta $encuesta = null)
    {
        $this->encuesta = $encuesta;
    
        return $this;
    }

    /**
     * Get encuesta
     *
     * @return \App\WebBundle\Entity\Encuesta 
     */
    public function getEncuesta()
    {
        return $this->encuesta;
    }

    /**
     * Add opciones
     *
     * @param \App\WebBundle\Entity\EncuestaPreguntaOpcion $opciones
     * @return EncuestaPregunta
     */
    public function addOpcione(\App\WebBundle\Entity\EncuestaPreguntaOpcion $opciones)
    {
        $this->opciones[] = $opciones;
    
        return $this;
    }

    /**
     * Remove opciones
     *
     * @param \App\WebBundle\Entity\EncuestaPreguntaOpcion $opciones
     */
    public function removeOpcione(\App\WebBundle\Entity\EncuestaPreguntaOpcion $opciones)
    {
        $this->opciones->removeElement($opciones);
    }

    /**
     * Get opciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOpciones()
    {
        return $this->opciones;
    }
}