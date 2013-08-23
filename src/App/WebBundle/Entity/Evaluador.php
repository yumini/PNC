<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * Evaluador
 *
 * @ORM\Table(name="evaluador")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\EvaluadorRepository")
 */
class Evaluador
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
     * @ORM\Column(name="nombres", type="string", length=250)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=250)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=250)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="numdoc", type="string", length=20)
     */
    private $numdoc;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="curriculum", type="string", length=20)
     */
    private $curriculum;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=250)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=250)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionempresa", type="string", length=250)
     */
    private $direccionempresa;

    /**
     * @var string
     *
     * @ORM\Column(name="distritoemp", type="string", length=250)
     */
    private $distritoemp;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoemp", type="string", length=250)
     */
    private $telefonoemp;

    /**
     * @var string
     *
     * @ORM\Column(name="faxemp", type="string", length=250)
     */
    private $faxemp;

    /**
     * @var string
     *
     * @ORM\Column(name="emailemp", type="string", length=250)
     */
    private $emailemp;

    /**
     * @var string
     *
     * @ORM\Column(name="distrito", type="string", length=250)
     */
    private $distrito;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=250)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=250)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=50)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="profesion", type="string", length=250)
     */
    private $profesion;

    /**
     * @var string
     *
     * @ORM\Column(name="especializacion", type="string", length=250)
     */
    private $especializacion;

    /**
     * @var string
     *
     * @ORM\Column(name="email1", type="string", length=250)
     */
    private $email1;

    /**
     * @var string
     *
     * @ORM\Column(name="email2", type="string", length=250)
     */
    private $email2;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibleviaje", type="string", length=1)
     */
    private $disponibleviaje;

    /**
     * @var string
     *
     * @ORM\Column(name="disponiblereunion", type="string", length=21)
     */
    private $disponiblereunion;

    /**
     * @var string
     *
     * @ORM\Column(name="estadotermino", type="string", length=1)
     */
    private $estadotermino;

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
     * @ORM\ManyToMany(targetEntity="GrupoEvaluacion", inversedBy="Evaluador")
     * @ORM\JoinTable(name="evaluadorgrupo")
     */
    private $grupos;

     /**
    * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="evaluadores")
    * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
    */
    private $usuario;

    public function __construct() {
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add gruposEvaluacion
     *
     * @param App\WebBundle\Entity\GrupoEvaluacion $grupos
     */
    public function addGrupos(App\WebBundle\Entity\Perfil $grupos)
    {
        $this->grupos[] = $grupos;
    }

    /**
     * Get grupos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
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
     * Set nombres
     *
     * @param string $nombres
     * @return Evaluador
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Evaluador
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Evaluador
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set numdoc
     *
     * @param string $numdoc
     * @return Evaluador
     */
    public function setNumdoc($numdoc)
    {
        $this->numdoc = $numdoc;
    
        return $this;
    }

    /**
     * Get numdoc
     *
     * @return string 
     */
    public function getNumdoc()
    {
        return $this->numdoc;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Evaluador
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    
        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set curriculum
     *
     * @param string $curriculum
     * @return Evaluador
     */
    public function setCurriculum($curriculum)
    {
        $this->curriculum = $curriculum;
    
        return $this;
    }

    /**
     * Get curriculum
     *
     * @return string 
     */
    public function getCurriculum()
    {
        return $this->curriculum;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     * @return Evaluador
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return Evaluador
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set direccionempresa
     *
     * @param string $direccionempresa
     * @return Evaluador
     */
    public function setDireccionempresa($direccionempresa)
    {
        $this->direccionempresa = $direccionempresa;
    
        return $this;
    }

    /**
     * Get direccionempresa
     *
     * @return string 
     */
    public function getDireccionempresa()
    {
        return $this->direccionempresa;
    }

    /**
     * Set distritoemp
     *
     * @param string $distritoemp
     * @return Evaluador
     */
    public function setDistritoemp($distritoemp)
    {
        $this->distritoemp = $distritoemp;
    
        return $this;
    }

    /**
     * Get distritoemp
     *
     * @return string 
     */
    public function getDistritoemp()
    {
        return $this->distritoemp;
    }

    /**
     * Set telefonoemp
     *
     * @param string $telefonoemp
     * @return Evaluador
     */
    public function setTelefonoemp($telefonoemp)
    {
        $this->telefonoemp = $telefonoemp;
    
        return $this;
    }

    /**
     * Get telefonoemp
     *
     * @return string 
     */
    public function getTelefonoemp()
    {
        return $this->telefonoemp;
    }

    /**
     * Set faxemp
     *
     * @param string $faxemp
     * @return Evaluador
     */
    public function setFaxemp($faxemp)
    {
        $this->faxemp = $faxemp;
    
        return $this;
    }

    /**
     * Get faxemp
     *
     * @return string 
     */
    public function getFaxemp()
    {
        return $this->faxemp;
    }

    /**
     * Set emailemp
     *
     * @param string $emailemp
     * @return Evaluador
     */
    public function setEmailemp($emailemp)
    {
        $this->emailemp = $emailemp;
    
        return $this;
    }

    /**
     * Get emailemp
     *
     * @return string 
     */
    public function getEmailemp()
    {
        return $this->emailemp;
    }

    /**
     * Set distrito
     *
     * @param string $distrito
     * @return Evaluador
     */
    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
    
        return $this;
    }

    /**
     * Get distrito
     *
     * @return string 
     */
    public function getDistrito()
    {
        return $this->distrito;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Evaluador
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Evaluador
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Evaluador
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set profesion
     *
     * @param string $profesion
     * @return Evaluador
     */
    public function setProfesion($profesion)
    {
        $this->profesion = $profesion;
    
        return $this;
    }

    /**
     * Get profesion
     *
     * @return string 
     */
    public function getProfesion()
    {
        return $this->profesion;
    }

    /**
     * Set especializacion
     *
     * @param string $especializacion
     * @return Evaluador
     */
    public function setEspecializacion($especializacion)
    {
        $this->especializacion = $especializacion;
    
        return $this;
    }

    /**
     * Get especializacion
     *
     * @return string 
     */
    public function getEspecializacion()
    {
        return $this->especializacion;
    }

    /**
     * Set email1
     *
     * @param string $email1
     * @return Evaluador
     */
    public function setEmail1($email1)
    {
        $this->email1 = $email1;
    
        return $this;
    }

    /**
     * Get email1
     *
     * @return string 
     */
    public function getEmail1()
    {
        return $this->email1;
    }

    /**
     * Set email2
     *
     * @param string $email2
     * @return Evaluador
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;
    
        return $this;
    }

    /**
     * Get email2
     *
     * @return string 
     */
    public function getEmail2()
    {
        return $this->email2;
    }

    /**
     * Set disponibleviaje
     *
     * @param string $disponibleviaje
     * @return Evaluador
     */
    public function setDisponibleviaje($disponibleviaje)
    {
        $this->disponibleviaje = $disponibleviaje;
    
        return $this;
    }

    /**
     * Get disponibleviaje
     *
     * @return string 
     */
    public function getDisponibleviaje()
    {
        return $this->disponibleviaje;
    }

    /**
     * Set disponiblereunion
     *
     * @param string $disponiblereunion
     * @return Evaluador
     */
    public function setDisponiblereunion($disponiblereunion)
    {
        $this->disponiblereunion = $disponiblereunion;
    
        return $this;
    }

    /**
     * Get disponiblereunion
     *
     * @return string 
     */
    public function getDisponiblereunion()
    {
        return $this->disponiblereunion;
    }

    /**
     * Set estadotermino
     *
     * @param string $estadotermino
     * @return Evaluador
     */
    public function setEstadotermino($estadotermino)
    {
        $this->estadotermino = $estadotermino;
    
        return $this;
    }

    /**
     * Get estadotermino
     *
     * @return string 
     */
    public function getEstadotermino()
    {
        return $this->estadotermino;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Evaluador
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
     * @return Evaluador
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
     * Add grupos
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacion $grupos
     * @return GrupoEvaluacion
     */
    public function addGrupo(\App\WebBundle\Entity\GrupoEvaluacion $grupos)
    {
        $this->grupos[] = $grupos;
    
        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \App\WebBundle\Entity\Grupo $grupos
     */
    public function removeGrupo(\App\WebBundle\Entity\Grupo $grupos)
    {
        $this->grupos->removeElement($grupos);
    }
   

    /**
     * Set usuario
     *
     * @param \App\WebBundle\Entity\Usuario $usuario
     * @return Evaluador
     */
    public function setUsuario(\App\WebBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \App\WebBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}