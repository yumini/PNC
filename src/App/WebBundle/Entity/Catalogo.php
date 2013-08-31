<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogo
 *
 * @ORM\Table(name="catalogo")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\CatalogoRepository")
 */
class Catalogo
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
     * @ORM\Column(name="codcatalogo", type="string", length=30)
     */
    private $codcatalogo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=30)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=20)
     */
    private $abreviatura;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", length=1)
     */
    private $estado;

    /**
    * @ORM\OneToMany(targetEntity="Catalogo", mappedBy="postulante")
    */
    protected $postulantes;
    
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
     * Set codcatalogo
     *
     * @param string $codcatalogo
     * @return Catalogo
     */
    public function setCodcatalogo($codcatalogo)
    {
        $this->codcatalogo = $codcatalogo;
    
        return $this;
    }

    /**
     * Get codcatalogo
     *
     * @return string 
     */
    public function getCodcatalogo()
    {
        return $this->codcatalogo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Catalogo
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
     * @return Catalogo
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
     * Set abreviatura
     *
     * @param string $abreviatura
     * @return Catalogo
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;
    
        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string 
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Catalogo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postulantes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add postulantes
     *
     * @param \App\WebBundle\Entity\Catalogo $postulantes
     * @return Catalogo
     */
    public function addPostulante(\App\WebBundle\Entity\Catalogo $postulantes)
    {
        $this->postulantes[] = $postulantes;
    
        return $this;
    }

    /**
     * Remove postulantes
     *
     * @param \App\WebBundle\Entity\Catalogo $postulantes
     */
    public function removePostulante(\App\WebBundle\Entity\Catalogo $postulantes)
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