<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConcursoCriterio
 *
 * @ORM\Table(name="concursocriterio")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\ConcursoCriterioRepository")
 */
class ConcursoCriterio
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
     * @var integer
     *
     * @ORM\Column(name="ipdadre", type="integer")
     */
    private $ipdadre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=50)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=250)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntaje", type="integer")
     */
    private $puntaje;

    /**
     * @var string
     *
     * @ORM\Column(name="glosa", type="text")
     */
    private $glosa;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text")
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="proposito", type="text")
     */
    private $proposito;

    /**
     * @var string
     *
     * @ORM\Column(name="nota", type="text")
     */
    private $nota;

   /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="tcccatalogos")
    * @ORM\JoinColumn(name="tipocriterio_id", referencedColumnName="id")
    */
    protected $tipoCriterio;
    
    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="tcacatalogos")
    * @ORM\JoinColumn(name="tipoarbol_id", referencedColumnName="id")
    */
    protected $tipoArbolCriterio;
    
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
     * Set ipdadre
     *
     * @param integer $ipdadre
     * @return ConcursoCriterio
     */
    public function setIpdadre($ipdadre)
    {
        $this->ipdadre = $ipdadre;
    
        return $this;
    }

    /**
     * Get ipdadre
     *
     * @return integer 
     */
    public function getIpdadre()
    {
        return $this->ipdadre;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return ConcursoCriterio
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ConcursoCriterio
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
     * Set puntaje
     *
     * @param integer $puntaje
     * @return ConcursoCriterio
     */
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;
    
        return $this;
    }

    /**
     * Get puntaje
     *
     * @return integer 
     */
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set glosa
     *
     * @param string $glosa
     * @return ConcursoCriterio
     */
    public function setGlosa($glosa)
    {
        $this->glosa = $glosa;
    
        return $this;
    }

    /**
     * Get glosa
     *
     * @return string 
     */
    public function getGlosa()
    {
        return $this->glosa;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return ConcursoCriterio
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     * @return ConcursoCriterio
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    
        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set proposito
     *
     * @param string $proposito
     * @return ConcursoCriterio
     */
    public function setProposito($proposito)
    {
        $this->proposito = $proposito;
    
        return $this;
    }

    /**
     * Get proposito
     *
     * @return string 
     */
    public function getProposito()
    {
        return $this->proposito;
    }

    /**
     * Set nota
     *
     * @param string $nota
     * @return ConcursoCriterio
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    
        return $this;
    }

    /**
     * Get nota
     *
     * @return string 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set tipoCriterio
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoCriterio
     * @return ConcursoCriterio
     */
    public function setTipoCriterio(\App\WebBundle\Entity\Catalogo $tipoCriterio = null)
    {
        $this->tipoCriterio = $tipoCriterio;
    
        return $this;
    }

    /**
     * Get tipoCriterio
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getTipoCriterio()
    {
        return $this->tipoCriterio;
    }

    /**
     * Set tipoArbolCriterio
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoArbolCriterio
     * @return ConcursoCriterio
     */
    public function setTipoArbolCriterio(\App\WebBundle\Entity\Catalogo $tipoArbolCriterio = null)
    {
        $this->tipoArbolCriterio = $tipoArbolCriterio;
    
        return $this;
    }

    /**
     * Get tipoArbolCriterio
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getTipoArbolCriterio()
    {
        return $this->tipoArbolCriterio;
    }
}