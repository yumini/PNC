<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
use App\WebBundle\Entity\Conversacion;
/**
 * Mensaje
 *
 * @ORM\Table(name="mensaje")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\MensajeRepository")
 */
class Mensaje
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
     * @ORM\Column(name="mensaje", type="string", length=300)
     */
    private $mensaje;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaRegistro", type="datetime")
     */
    private $fechaRegistro;

    /**
    * @ORM\ManyToOne(targetEntity="Conversacion", inversedBy="mensajes")
    * @ORM\JoinColumn(name="conversacion_id", referencedColumnName="id")
    */
    private $conversacion;

    /**
    * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="mensajes")
    * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
    */
    private $usuario;

 
     /**
     * Set conversacion
     *
     * @param \App\WebBundle\Entity\Conversacion $conversacion
     */
    public function setConversacion(\App\WebBundle\Entity\Conversacion $conversacion)
    {
        $this->conversacion = $conversacion;
    }
     /**
     * Get conversacion
     *
     * @return App\WebBundle\Entity\Conversacion 
     */
    public function getConversacion()
    {
        return $this->conversacion;
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
     * Set mensaje
     *
     * @param string $mensaje
     * @return Mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    
        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Mensaje
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
     * Set usuario
     *
     * @param \App\WebBundle\Entity\Usuario $usuario
     * @return Mensaje
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