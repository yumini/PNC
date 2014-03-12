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
     * @ORM\Column(name="idpadre", type="integer")
     */
    private $idpadre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=50)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=250, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntaje", type="integer", nullable=true)
     */
    private $puntaje;

    /**
     * @var string
     *
     * @ORM\Column(name="glosa", type="text", nullable=true)
     */
    private $glosa;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="proposito", type="text", nullable=true)
     */
    private $proposito;

    /**
     * @var string
     *
     * @ORM\Column(name="nota", type="text", nullable=true)
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
    * @ORM\ManyToOne(targetEntity="Concurso", inversedBy="criterios")
    * @ORM\JoinColumn(name="concurso_id", referencedColumnName="id")
    */
    protected $concurso;
    
    /**
    * @ORM\OneToMany(targetEntity="AspectoClave", mappedBy="criterio")
    */
    protected $aspectosclaves;

    /**
    * @ORM\OneToMany(targetEntity="CriterioAspectoClave", mappedBy="criterio")
    */
    protected $criteriosaspectosclaves;
    /**
    * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="criterio")
    */
    protected $respuestas;

    /**
    * @ORM\OneToMany(targetEntity="CriterioVisita", mappedBy="criterio")
    */
    protected $visitas;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aspectosclaves = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idpadre
     *
     * @param integer $idpadre
     * @return ConcursoCriterio
     */
    public function setIdpadre($idpadre)
    {
        $this->idpadre = $idpadre;
    
        return $this;
    }

    /**
     * Get idpadre
     *
     * @return integer 
     */
    public function getIdpadre()
    {
        return $this->idpadre;
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

    /**
     * Set concurso
     *
     * @param \App\WebBundle\Entity\Concurso $concurso
     * @return ConcursoCriterio
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
     * Add aspectosclaves
     *
     * @param \App\WebBundle\Entity\AspectoClave $aspectosclaves
     * @return ConcursoCriterio
     */
    public function addAspectosclave(\App\WebBundle\Entity\AspectoClave $aspectosclaves)
    {
        $this->aspectosclaves[] = $aspectosclaves;
    
        return $this;
    }

    /**
     * Remove aspectosclaves
     *
     * @param \App\WebBundle\Entity\AspectoClave $aspectosclaves
     */
    public function removeAspectosclave(\App\WebBundle\Entity\AspectoClave $aspectosclaves)
    {
        $this->aspectosclaves->removeElement($aspectosclaves);
    }

    /**
     * Get aspectosclaves
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAspectosclaves()
    {
        return $this->aspectosclaves;
    }

    /**
     * Add respuestas
     *
     * @param \App\WebBundle\Entity\Respuesta $respuestas
     * @return ConcursoCriterio
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
     * Add criteriosaspectosclaves
     *
     * @param \App\WebBundle\Entity\CriterioAspectoClave $criteriosaspectosclaves
     * @return ConcursoCriterio
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
}