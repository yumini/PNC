<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AspectoClave
 *
 * @ORM\Table(name="aspectoclave")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\AspectoClaveRepository")
 */
class AspectoClave
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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;


    /**
    * @ORM\ManyToOne(targetEntity="ConcursoCriterio", inversedBy="aspectosclaves")
    * @ORM\JoinColumn(name="concursocriterio_id", referencedColumnName="id")
    */
    protected $criterio;

    /**
    * @ORM\OneToMany(targetEntity="CriterioAspectoClave", mappedBy="aspectoclave")
    */
    protected $criteriosaspectosclaves;

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
     * Set descripcion
     *
     * @param string $descripcion
     * @return AspectoClave
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
     * Set criterio
     *
     * @param \App\WebBundle\Entity\ConcursoCriterio $criterio
     * @return AspectoClave
     */
    public function setCriterio(\App\WebBundle\Entity\ConcursoCriterio $criterio = null)
    {
        $this->criterio = $criterio;
    
        return $this;
    }

    /**
     * Get criterio
     *
     * @return \App\WebBundle\Entity\ConcursoCriterio 
     */
    public function getCriterio()
    {
        return $this->criterio;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->criteriosaspectosclaves = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add criteriosaspectosclaves
     *
     * @param \App\WebBundle\Entity\CriterioAspectoClave $criteriosaspectosclaves
     * @return AspectoClave
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