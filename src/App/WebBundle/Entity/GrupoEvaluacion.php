<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoEvaluacion
 *
 * @ORM\Table(name="grupoevaluacion")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\GrupoEvaluacionRepository")
 */
class GrupoEvaluacion
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
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=300)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaActualizacion", type="datetime")
     */
    private $fechaActualizacion;

    /**
     * @ORM\ManyToMany(targetEntity="GrupoEvaluacion", mappedBy="Evaluador")
     */
    private $evaluadores;

    public function __construct() {
        $this->evaluadores = new \Doctrine\Common\Collections\ArrayCollection();
    }
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
     * Set nombre
     *
     * @param string $nombre
     * @return GrupoEvaluacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return GrupoEvaluacion
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
     * Set estado
     *
     * @param string $estado
     * @return GrupoEvaluacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return GrupoEvaluacion
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
     * @return GrupoEvaluacion
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
     * Add evaluadores
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacion $evaluadores
     * @return GrupoEvaluacion
     */
    public function addEvaluadore(\App\WebBundle\Entity\GrupoEvaluacion $evaluadores)
    {
        $this->evaluadores[] = $evaluadores;
    
        return $this;
    }

    /**
     * Remove evaluadores
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacion $evaluadores
     */
    public function removeEvaluadore(\App\WebBundle\Entity\GrupoEvaluacion $evaluadores)
    {
        $this->evaluadores->removeElement($evaluadores);
    }

    /**
     * Get evaluadores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluadores()
    {
        return $this->evaluadores;
    }
}