<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Concurso
 *
 * @ORM\Table(name="concurso")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\ConcursoRepository")
 */
class Concurso
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
     * @ORM\Column(name="nombreconcurso", type="string", length=100)
     */
    private $nombre;

    /**
     * @var \Date
     * @Assert\NotBlank
     * @ORM\Column(name="fechainicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \Date
     * @Assert\NotBlank
     * @ORM\Column(name="fechafin", type="date")
     */
    private $fechaFin;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="presentacion", type="text", nullable=true)
     */
    private $presentacion;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivos", type="string", length=200, nullable=true)
     */
    private $objetivos;

    /**
     * @var string
     *
     * @ORM\Column(name="requisitos", type="string", length=200, nullable=true)
     */
    private $requisitos;

    /**
     * @var string
     *
     * @ORM\Column(name="participantes", type="string", length=200, nullable=true)
     */
    private $participantes;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficios", type="string", length=200, nullable=true)
     */
    private $beneficios;

    /**
     * @var string
     *
     * @ORM\Column(name="categorias", type="string", length=200, nullable=true)
     */
    private $categorias;

    /**
     * @var string
     *
     * @ORM\Column(name="premiootorgar", type="string", length=200, nullable=true)
     */
    private $premiootorgar;

    /**
     * @var string
     *
     * @ORM\Column(name="medallas", type="string", length=200, nullable=true)
     */
    private $medallas;

    /**
     * @var string
     *
     * @ORM\Column(name="cuotaparticipacion", type="string", length=200, nullable=true)
     */
    private $cuota;

    /**
     * @var string
     *
     * @ORM\Column(name="infocomplementaria", type="string", length=200, nullable=true)
     */
    private $informacion;

    /**
     * @var float
     *
     * @ORM\Column(name="anio", type="decimal")
     */
    private $anio;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_empresa", type="boolean")
     */
    private $estadoemp;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_proyecto", type="boolean")
     */
    private $estadopy;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="termino_aceptacion", type="text", nullable=true)
     */
    private $terminoacepta;

    /**
     * @var integer
     * @Assert\NotBlank
     * @ORM\Column(name="incrementopuntaje", type="integer")
     */
    private $incpuntaje;

    /**
     * @var integer
     * @Assert\NotBlank
     * @ORM\Column(name="evalua_criterio", type="string", length=1)
     */
    private $evaluacriterio;

    /**
     * @var string
     *
     * @ORM\Column(name="informe_retro", type="text", nullable=true)
     */
    private $informeretro;

    /**
     * @var string
     *
     * @ORM\Column(name="calificacion", type="text", nullable=true)
     */
    private $calificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="prefijo", type="string", length=30, nullable=true)
     */
    private $prefijo;

    /**
    * @ORM\OneToMany(targetEntity="ConcursoCriterio", mappedBy="concurso")
    */
    protected $criterios;

    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="concursos")
    * @ORM\JoinColumn(name="tipoconcurso_id", referencedColumnName="id")
    */
    protected $tipoConcurso;
    
    /**
    * @ORM\OneToMany(targetEntity="GrupoEvaluacion", mappedBy="concurso")
    */
    protected $gruposEvaluacion;
    
    /**
    * @ORM\OneToMany(targetEntity="InscripcionEvaluador", mappedBy="concurso")
    */
    protected $inscripcionesConcurso;
    
    /**
    * @ORM\OneToMany(targetEntity="Inscripcion", mappedBy="concurso")
    */
    protected $inscripciones;
    
    /**
    * @ORM\OneToMany(targetEntity="EtapaConcurso", mappedBy="concurso")
    */
    protected $etapasconcurso;
    
    public function __construct()
    {
        $this->criterios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inscripcionesConcurso = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inscripciones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Concurso
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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Concurso
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
     * @return Concurso
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
     * Set presentacion
     *
     * @param string $presentacion
     * @return Concurso
     */
    public function setPresentacion($presentacion)
    {
        $this->presentacion = $presentacion;
    
        return $this;
    }

    /**
     * Get presentacion
     *
     * @return string 
     */
    public function getPresentacion()
    {
        return $this->presentacion;
    }

    /**
     * Set objetivos
     *
     * @param string $objetivos
     * @return Concurso
     */
    public function setObjetivos($objetivos)
    {
        $this->objetivos = $objetivos;
    
        return $this;
    }

    /**
     * Get objetivos
     *
     * @return string 
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }

    /**
     * Set requisitos
     *
     * @param string $requisitos
     * @return Concurso
     */
    public function setRequisitos($requisitos)
    {
        $this->requisitos = $requisitos;
    
        return $this;
    }

    /**
     * Get requisitos
     *
     * @return string 
     */
    public function getRequisitos()
    {
        return $this->requisitos;
    }

    /**
     * Set participantes
     *
     * @param string $participantes
     * @return Concurso
     */
    public function setParticipantes($participantes)
    {
        $this->participantes = $participantes;
    
        return $this;
    }

    /**
     * Get participantes
     *
     * @return string 
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set beneficios
     *
     * @param string $beneficios
     * @return Concurso
     */
    public function setBeneficios($beneficios)
    {
        $this->beneficios = $beneficios;
    
        return $this;
    }

    /**
     * Get beneficios
     *
     * @return string 
     */
    public function getBeneficios()
    {
        return $this->beneficios;
    }

    /**
     * Set categorias
     *
     * @param string $categorias
     * @return Concurso
     */
    public function setCategorias($categorias)
    {
        $this->categorias = $categorias;
    
        return $this;
    }

    /**
     * Get categorias
     *
     * @return string 
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * Set premiootorgar
     *
     * @param string $premiootorgar
     * @return Concurso
     */
    public function setPremiootorgar($premiootorgar)
    {
        $this->premiootorgar = $premiootorgar;
    
        return $this;
    }

    /**
     * Get premiootorgar
     *
     * @return string 
     */
    public function getPremiootorgar()
    {
        return $this->premiootorgar;
    }

    /**
     * Set medallas
     *
     * @param string $medallas
     * @return Concurso
     */
    public function setMedallas($medallas)
    {
        $this->medallas = $medallas;
    
        return $this;
    }

    /**
     * Get medallas
     *
     * @return string 
     */
    public function getMedallas()
    {
        return $this->medallas;
    }

    /**
     * Set cuota
     *
     * @param string $cuota
     * @return Concurso
     */
    public function setCuota($cuota)
    {
        $this->cuota = $cuota;
    
        return $this;
    }

    /**
     * Get cuota
     *
     * @return string 
     */
    public function getCuota()
    {
        return $this->cuota;
    }

    /**
     * Set informacion
     *
     * @param string $informacion
     * @return Concurso
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;
    
        return $this;
    }

    /**
     * Get informacion
     *
     * @return string 
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * Set anio
     *
     * @param float $anio
     * @return Concurso
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    
        return $this;
    }

    /**
     * Get anio
     *
     * @return float 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set estadoemp
     *
     * @param string $estadoemp
     * @return Concurso
     */
    public function setEstadoemp($estadoemp)
    {
        $this->estadoemp = $estadoemp;
    
        return $this;
    }

    /**
     * Get estadoemp
     *
     * @return string 
     */
    public function getEstadoemp()
    {
        return $this->estadoemp;
    }

    /**
     * Set estadopy
     *
     * @param string $estadopy
     * @return Concurso
     */
    public function setEstadopy($estadopy)
    {
        $this->estadopy = $estadopy;
    
        return $this;
    }

    /**
     * Get estadopy
     *
     * @return string 
     */
    public function getEstadopy()
    {
        return $this->estadopy;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Concurso
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
     * Set terminoacepta
     *
     * @param string $terminoacepta
     * @return Concurso
     */
    public function setTerminoacepta($terminoacepta)
    {
        $this->terminoacepta = $terminoacepta;
    
        return $this;
    }

    /**
     * Get terminoacepta
     *
     * @return string 
     */
    public function getTerminoacepta()
    {
        return $this->terminoacepta;
    }

    /**
     * Set incpuntaje
     *
     * @param integer $incpuntaje
     * @return Concurso
     */
    public function setIncpuntaje($incpuntaje)
    {
        $this->incpuntaje = $incpuntaje;
    
        return $this;
    }

    /**
     * Get incpuntaje
     *
     * @return integer 
     */
    public function getIncpuntaje()
    {
        return $this->incpuntaje;
    }

    /**
     * Set evaluacriterio
     *
     * @param integer $evaluacriterio
     * @return Concurso
     */
    public function setEvaluacriterio($evaluacriterio)
    {
        $this->evaluacriterio = $evaluacriterio;
    
        return $this;
    }

    /**
     * Get evaluacriterio
     *
     * @return integer 
     */
    public function getEvaluacriterio()
    {
        return $this->evaluacriterio;
    }

    /**
     * Set informeretro
     *
     * @param string $informeretro
     * @return Concurso
     */
    public function setInformeretro($informeretro)
    {
        $this->informeretro = $informeretro;
    
        return $this;
    }

    /**
     * Get informeretro
     *
     * @return string 
     */
    public function getInformeretro()
    {
        return $this->informeretro;
    }

    /**
     * Set calificacion
     *
     * @param string $calificacion
     * @return Concurso
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    
        return $this;
    }

    /**
     * Get calificacion
     *
     * @return string 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set prefijo
     *
     * @param string $prefijo
     * @return Concurso
     */
    public function setPrefijo($prefijo)
    {
        $this->prefijo = $prefijo;
    
        return $this;
    }

    /**
     * Get prefijo
     *
     * @return string 
     */
    public function getPrefijo()
    {
        return $this->prefijo;
    }

    /**
     * Add criterios
     *
     * @param \App\WebBundle\Entity\ConcursoCriterio $criterios
     * @return Concurso
     */
    public function addCriterio(\App\WebBundle\Entity\ConcursoCriterio $criterios)
    {
        $this->criterios[] = $criterios;
    
        return $this;
    }

    /**
     * Remove criterios
     *
     * @param \App\WebBundle\Entity\ConcursoCriterio $criterios
     */
    public function removeCriterio(\App\WebBundle\Entity\ConcursoCriterio $criterios)
    {
        $this->criterios->removeElement($criterios);
    }

    /**
     * Get criterios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCriterios()
    {
        return $this->criterios;
    }

    /**
     * Set tipoConcurso
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoConcurso
     * @return Concurso
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
     * Add gruposEvaluacion
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacion $gruposEvaluacion
     * @return Concurso
     */
    public function addGruposEvaluacion(\App\WebBundle\Entity\GrupoEvaluacion $gruposEvaluacion)
    {
        $this->gruposEvaluacion[] = $gruposEvaluacion;
    
        return $this;
    }

    /**
     * Remove gruposEvaluacion
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacion $gruposEvaluacion
     */
    public function removeGruposEvaluacion(\App\WebBundle\Entity\GrupoEvaluacion $gruposEvaluacion)
    {
        $this->gruposEvaluacion->removeElement($gruposEvaluacion);
    }

    /**
     * Get gruposEvaluacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGruposEvaluacion()
    {
        return $this->gruposEvaluacion;
    }

    /**
     * Add inscripcionesConcurso
     *
     * @param \App\WebBundle\Entity\InscripcionEvaluador $inscripcionesConcurso
     * @return Concurso
     */
    public function addInscripcionesConcurso(\App\WebBundle\Entity\InscripcionEvaluador $inscripcionesConcurso)
    {
        $this->inscripcionesConcurso[] = $inscripcionesConcurso;
    
        return $this;
    }

    /**
     * Remove inscripcionesConcurso
     *
     * @param \App\WebBundle\Entity\InscripcionEvaluador $inscripcionesConcurso
     */
    public function removeInscripcionesConcurso(\App\WebBundle\Entity\InscripcionEvaluador $inscripcionesConcurso)
    {
        $this->inscripcionesConcurso->removeElement($inscripcionesConcurso);
    }

    /**
     * Get inscripcionesConcurso
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInscripcionesConcurso()
    {
        return $this->inscripcionesConcurso;
    }

    /**
     * Add inscripciones
     *
     * @param \App\WebBundle\Entity\Inscripcion $inscripciones
     * @return Concurso
     */
    public function addInscripcione(\App\WebBundle\Entity\Inscripcion $inscripciones)
    {
        $this->inscripciones[] = $inscripciones;
    
        return $this;
    }

    /**
     * Remove inscripciones
     *
     * @param \App\WebBundle\Entity\Inscripcion $inscripciones
     */
    public function removeInscripcione(\App\WebBundle\Entity\Inscripcion $inscripciones)
    {
        $this->inscripciones->removeElement($inscripciones);
    }

    /**
     * Get inscripciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInscripciones()
    {
        return $this->inscripciones;
    }

    /**
     * Add etapasconcurso
     *
     * @param \App\WebBundle\Entity\EtapaConcurso $etapasconcurso
     * @return Concurso
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