<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use App\WebBundle\Entity\Catalogo;
/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\UsuarioRepository")
 * @UniqueEntity(fields="nroDocumento",message="Número de Documento ya existe")
 * @Assert\Callback(methods={"isDocumentValid"})
 */
class Usuario extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=250)
     */
    protected $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=250)
     */
    protected $apellidos;

    /**
    * @ORM\ManyToOne(targetEntity="Perfil", inversedBy="usuarios")
    * @ORM\JoinColumn(name="perfil_id", referencedColumnName="id")
    */
    protected $perfil;

     /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="usuarios")
    * @ORM\JoinColumn(name="tipodocumento_id", referencedColumnName="id")
    */
    protected $tipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="nrodocumento", type="string", length=20, unique=true)
     * @Assert\NotBlank()
     */
    protected $nroDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=20)
     */
    protected $imagen;
    
    /**
     * @var string
     *
     * @ORM\Column(name="validaregistro", type="string", length=1)
     */
    protected $validaregistro;
    
    /**
    * @ORM\OneToMany(targetEntity="Nota", mappedBy="usuario")
    */
    protected $notas;

     /**
    * @ORM\OneToMany(targetEntity="Evaluador", mappedBy="usuario")
    */
    protected $evaluadores;

     /**
    * @ORM\OneToMany(targetEntity="Postulante", mappedBy="usuario")
    */
    protected $postulantes;

     /**
     * @ORM\ManyToMany(targetEntity="Conversacion")
     * @ORM\JoinTable(name="participante")
     */
    private $conversaciones;

    public function __construct()
    {
        $this->imagen="default.jpg";
        $this->validaregistro="0";
        $this->conversaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluadores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->postulantes = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
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
     * Add notas
     *
     * @param \App\WebBundle\Entity\Nota $notas
     * @return Usuario
     */
    public function addNota(\App\WebBundle\Entity\Nota $notas)
    {
        $this->notas[] = $notas;
    
        return $this;
    }

    /**
     * Remove notas
     *
     * @param \App\WebBundle\Entity\Nota $notas
     */
    public function removeNota(\App\WebBundle\Entity\Nota $notas)
    {
        $this->notas->removeElement($notas);
    }

    /**
     * Get notas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Add conversaciones
     *
     * @param \App\WebBundle\Entity\Conversacion $conversaciones
     * @return Usuario
     */
    public function addConversacione(\App\WebBundle\Entity\Conversacion $conversaciones)
    {
        $this->conversaciones[] = $conversaciones;
    
        return $this;
    }

    /**
     * Remove conversaciones
     *
     * @param \App\WebBundle\Entity\Conversacion $conversaciones
     */
    public function removeConversacione(\App\WebBundle\Entity\Conversacion $conversaciones)
    {
        $this->conversaciones->removeElement($conversaciones);
    }

    /**
     * Get conversaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConversaciones()
    {
        return $this->conversaciones;
    }

    /**
     * Add evaluadores
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluadores
     * @return Usuario
     */
    public function addEvaluadore(\App\WebBundle\Entity\Evaluador $evaluadores)
    {
        $this->evaluadores[] = $evaluadores;
    
        return $this;
    }

    /**
     * Remove evaluadores
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluadores
     */
    public function removeEvaluadore(\App\WebBundle\Entity\Evaluador $evaluadores)
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
     * Set nombres
     *
     * @param string $nombres
     * @return Usuario
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
     * @return Usuario
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
     * Set perfil
     *
     * @param \Perfil $perfil
     * @return Usuario
     */
    public function setPerfil(Perfil $perfil = null)
    {
        $this->perfil = $perfil;
    
        return $this;
    }

    /**
     * Get perfil
     *
     * @return \Perfil 
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

   

    /**
     * Set nroDocumento
     *
     * @param string $nroDocumento
     * @return Usuario
     */
    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    
        return $this;
    }

    /**
     * Get nroDocumento
     *
     * @return string 
     */
    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    /**
     * Set tipoDocumento
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoDocumento
     * @return Usuario
     */
    public function setTipoDocumento(\App\WebBundle\Entity\Catalogo $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;
    
        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Usuario
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set validaregistro
     *
     * @param string $validaregistro
     * @return Usuario
     */
    public function setValidaregistro($validaregistro)
    {
        $this->validaregistro = $validaregistro;
    
        return $this;
    }

    /**
     * Get validaregistro
     *
     * @return string 
     */
    public function getValidaregistro()
    {
        return $this->validaregistro;
    }


    /**
     * Add evaluadores
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluadores
     * @return Usuario
     */
    public function addPostulantes(\App\WebBundle\Entity\Evaluador $evaluadores)
    {
        $this->evaluadores[] = $evaluadores;
    
        return $this;
    }

    /**
     * Remove evaluadores
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluadores
     */
    public function removePostulantes(\App\WebBundle\Entity\Evaluador $evaluadores)
    {
        $this->evaluadores->removeElement($evaluadores);
    }

    /**
     * Get evaluadores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulantess()
    {
        return $this->evaluadores;
    }

    /**
     * Add postulantes
     *
     * @param \App\WebBundle\Entity\Postulante $postulantes
     * @return Usuario
     */
    public function addPostulante(\App\WebBundle\Entity\Postulante $postulantes)
    {
        $this->postulantes[] = $postulantes;
    
        return $this;
    }

    /**
     * Remove postulantes
     *
     * @param \App\WebBundle\Entity\Postulante $postulantes
     */
    public function removePostulante(\App\WebBundle\Entity\Postulante $postulantes)
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

    
    public function isDocumentValid(ExecutionContextInterface $context)
    {

        if ($this->tipoDocumento->getCodigo()==1 && strlen($this->nroDocumento)!=8) {
            $context->addViolationAt('nroDocumento', 'N° Documeno debe contener 8 digitos.', array(), null);
        }
        if ($this->tipoDocumento->getCodigo()==2 && strlen($this->nroDocumento)!=11) {
            $context->addViolationAt('nroDocumento', 'N° Documeno debe contener 11 digitos.', array(), null);
        }
        
    }
}