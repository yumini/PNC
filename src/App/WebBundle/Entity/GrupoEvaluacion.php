<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=300, nullable=true)
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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaCreacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="fechaActualizacion", type="datetime")
     */
    private $fechaActualizacion;

    /**
    * @ORM\OneToMany(targetEntity="GrupoEvaluacionEvaluador", mappedBy="grupo")
    */
    private $evaluadores;
    
    /**
    * @ORM\OneToMany(targetEntity="GrupoEvaluacionPostulante", mappedBy="grupo")
    */
    private $postulantes;
    
    /**
    * @ORM\ManyToOne(targetEntity="Concurso", inversedBy="gruposEvaluacion")
    * @ORM\JoinColumn(name="concurso_id", referencedColumnName="id")
    */
    private $concurso;

    public function __construct() {
        $this->evaluadores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postulantes = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set concurso
     *
     * @param \App\WebBundle\Entity\Concurso $concurso
     * @return GrupoEvaluacion
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
     * Add postulantes
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacionPostulante $postulantes
     * @return GrupoEvaluacion
     */
    public function addPostulante(\App\WebBundle\Entity\GrupoEvaluacionPostulante $postulantes)
    {
        $this->postulantes[] = $postulantes;
    
        return $this;
    }

    /**
     * Remove postulantes
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacionPostulante $postulantes
     */
    public function removePostulante(\App\WebBundle\Entity\GrupoEvaluacionPostulante $postulantes)
    {
        $this->postulantes->removeElement($postulantes);
    }

    /**
     * Get postulantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulantes()
    {
        return $this->postulantes;
    }
}