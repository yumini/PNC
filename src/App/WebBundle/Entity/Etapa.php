<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * Etapa
 *
 * @ORM\Table(name="etapa")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\EtapaRepository")
 */
class Etapa
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

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
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1)
     */
    private $estado;
    
    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="etapasTipoEtapa")
    * @ORM\JoinColumn(name="tipoetapa_id", referencedColumnName="id")
    */
    protected $tipoEtapa;
    
    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="etapasTipoConcurso")
    * @ORM\JoinColumn(name="tipoconcurso_id", referencedColumnName="id")
    */
    protected $tipoConcurso;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer")
     */
    private $orden;
    
    /**
    * @ORM\OneToMany(targetEntity="EtapaConcurso", mappedBy="etapa")
    */
    protected $etapasconcurso;
    
    public function __construct()
    {
        $this->etapasconcurso= new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Etapa
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Etapa
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
     * @return Etapa
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
     * Set estado
     *
     * @param string $estado
     * @return Etapa
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
     * Set tipoEtapa
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoEtapa
     * @return Etapa
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

    /**
     * Set tipoConcurso
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoConcurso
     * @return Etapa
     */
    public function setTipoConcurso(\App\WebBundle\Entity\Catalogo $tipoConcurso = null)
    {
        $this->tipoConcurso = $tipoConcurso;
    
        return $this;
    }

    /**
     * Get tipoConcurso
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getTipoConcurso()
    {
        return $this->tipoConcurso;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Etapa
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
     * Add etapasconcurso
     *
     * @param \App\WebBundle\Entity\EtapaConcurso $etapasconcurso
     * @return Etapa
     */
    public function addEtapasconcurso(\App\WebBundle\Entity\EtapaConcurso $etapasconcurso)
    {
        $this->etapasconcurso[] = $etapasconcurso;
    
        return $this;
    }

    /**
     * Remove etapasconcurso
     *
     * @param \App\WebBundle\Entity\EtapaConcurso $etapasconcurso
     */
    public function removeEtapasconcurso(\App\WebBundle\Entity\EtapaConcurso $etapasconcurso)
    {
        $this->etapasconcurso->removeElement($etapasconcurso);
    }

    /**
     * Get etapasconcurso
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtapasconcurso()
    {
        return $this->etapasconcurso;
    }
}