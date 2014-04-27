<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\MenuRepository")
 */
class Menu
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
     * @ORM\Column(name="titulo", type="string", length=50)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=300)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=300)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer")
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="icono", type="string", length=20)
     */
    private $icono;

    /**
     * @ORM\ManyToMany(targetEntity="Perfil", inversedBy="menus")
     * @ORM\JoinTable(name="acceso")
     */
    private $perfiles;

    public function __construct() {
        $this->perfiles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add perfiles
     *
     * @param App\WebBundle\Entity\Perfil $perfiles
     */
    public function addPerfiles(Perfil $perfiles)
    {
        $this->perfiles[] = $perfiles;
    }

    /**
     * Get perfiles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPerfiles()
    {
        return $this->perfiles;
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
     * @return Menu
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
     * Set titulo
     *
     * @param string $titulo
     * @return Menu
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Menu
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
     * Set url
     *
     * @param string $url
     * @return Menu
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Menu
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
     * Set icono
     *
     * @param string $icono
     * @return Menu
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    
        return $this;
    }

    /**
     * Get icono
     *
     * @return string 
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Add perfiles
     *
     * @param \App\WebBundle\Entity\Perfil $perfiles
     * @return Menu
     */
    public function addPerfile(Perfil $perfiles)
    {
        $this->perfiles[] = $perfiles;
    
        return $this;
    }

    /**
     * Remove perfiles
     *
     * @param \App\WebBundle\Entity\Perfil $perfiles
     */
    public function removePerfile(Perfil $perfiles)
    {
        $this->perfiles->removeElement($perfiles);
    }
}