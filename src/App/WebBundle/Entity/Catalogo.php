<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\WebBundle\Entity\PostulanteContacto;
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
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=250)
     */
    private $abreviatura;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
    * @ORM\OneToMany(targetEntity="PostulanteContacto", mappedBy="catalogo")
    */
    protected $postulantecatalogos;
    
    /**
    * @ORM\OneToMany(targetEntity="Usuario", mappedBy="catalogo")
    */
    protected $tdicatalogos;
    
    /**
    * @ORM\OneToMany(targetEntity="ConflictoInteresEvaluador", mappedBy="catalogo")
    */
    protected $tvicatalogos;
    
     public function __construct()
    {
        $this->postulantecatalogos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tdicatalogos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tvicatalogos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add postulantecatalogos
     *
     * @param \App\WebBundle\Entity\PostulanteContacto $postulantecatalogos
     * @return Catalogo
     */
    public function addPostulantecatalogo(\App\WebBundle\Entity\PostulanteContacto $postulantecatalogos)
    {
        $this->postulantecatalogos[] = $postulantecatalogos;
    
        return $this;
    }

    /**
     * Remove postulantecatalogos
     *
     * @param \App\WebBundle\Entity\PostulanteContacto $postulantecatalogos
     */
    public function removePostulantecatalogo(\App\WebBundle\Entity\PostulanteContacto $postulantecatalogos)
    {
        $this->postulantecatalogos->removeElement($postulantecatalogos);
    }

    /**
     * Get postulantecatalogos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulantecatalogos()
    {
        return $this->postulantecatalogos;
    }

    /**
     * Add tdicatalogos
     *
     * @param \App\WebBundle\Entity\Usuario $tdicatalogos
     * @return Catalogo
     */
    public function addTdicatalogo(\App\WebBundle\Entity\Usuario $tdicatalogos)
    {
        $this->tdicatalogos[] = $tdicatalogos;
    
        return $this;
    }

    /**
     * Remove tdicatalogos
     *
     * @param \App\WebBundle\Entity\Usuario $tdicatalogos
     */
    public function removeTdicatalogo(\App\WebBundle\Entity\Usuario $tdicatalogos)
    {
        $this->tdicatalogos->removeElement($tdicatalogos);
    }

    /**
     * Get tdicatalogos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTdicatalogos()
    {
        return $this->tdicatalogos;
    }

    /**
     * Add tvicatalogos
     *
     * @param \App\WebBundle\Entity\ConflictoInteresEvaluador $tvicatalogos
     * @return Catalogo
     */
    public function addTvicatalogo(\App\WebBundle\Entity\ConflictoInteresEvaluador $tvicatalogos)
    {
        $this->tvicatalogos[] = $tvicatalogos;
    
        return $this;
    }

    /**
     * Remove tvicatalogos
     *
     * @param \App\WebBundle\Entity\ConflictoInteresEvaluador $tvicatalogos
     */
    public function removeTvicatalogo(\App\WebBundle\Entity\ConflictoInteresEvaluador $tvicatalogos)
    {
        $this->tvicatalogos->removeElement($tvicatalogos);
    }

    /**
     * Get tvicatalogos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTvicatalogos()
    {
        return $this->tvicatalogos;
    }
}
