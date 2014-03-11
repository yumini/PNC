<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CriterioAspectoClave
 *
 * @ORM\Table(name="criterioaspectoclave")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\CriterioAspectoClaveRepository")
 */
class CriterioAspectoClave
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
    * @ORM\ManyToOne(targetEntity="ConcursoCriterio", inversedBy="criteriosaspectosclaves")
    * @ORM\JoinColumn(name="concursocriterio_id", referencedColumnName="id")
    */
    protected $criterio;

    /**
    * @ORM\ManyToOne(targetEntity="AspectoClave", inversedBy="criteriosaspectosclaves")
    * @ORM\JoinColumn(name="aspectoclave_id", referencedColumnName="id")
    */
    protected $aspectoclave;
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
     * Set criterio
     *
     * @param \App\WebBundle\Entity\ConcursoCriterio $criterio
     * @return CriterioAspectoClave
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
     * Set aspectoclave
     *
     * @param \App\WebBundle\Entity\AspectoClave $aspectoclave
     * @return CriterioAspectoClave
     */
    public function setAspectoclave(\App\WebBundle\Entity\AspectoClave $aspectoclave = null)
    {
        $this->aspectoclave = $aspectoclave;
    
        return $this;
    }

    /**
     * Get aspectoclave
     *
     * @return \App\WebBundle\Entity\AspectoClave 
     */
    public function getAspectoclave()
    {
        return $this->aspectoclave;
    }
}