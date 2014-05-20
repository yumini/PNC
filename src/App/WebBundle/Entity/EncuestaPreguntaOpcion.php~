<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EncuestaPreguntaOpcion
 *
 * @ORM\Table(name="encuestapreguntaopcion")
 * @ORM\Entity
 */
class EncuestaPreguntaOpcion
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
     * @ORM\Column(name="opcion", type="string", length=300)
     */
    private $opcion;

    /**
     * @var integer
     * @Assert\NotBlank
     * @ORM\Column(name="peso", type="integer")
     */
    private $peso;

    /**
    * @ORM\ManyToOne(targetEntity="EncuestaPregunta", inversedBy="opciones")
    * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id")
    */
    protected $pregunta;
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
     * Set opcion
     *
     * @param string $opcion
     * @return EncuestaPreguntaOpcion
     */
    public function setOpcion($opcion)
    {
        $this->opcion = $opcion;
    
        return $this;
    }

    /**
     * Get opcion
     *
     * @return string 
     */
    public function getOpcion()
    {
        return $this->opcion;
    }

    /**
     * Set peso
     *
     * @param integer $peso
     * @return EncuestaPreguntaOpcion
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    
        return $this;
    }

    /**
     * Get peso
     *
     * @return integer 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set pregunta
     *
     * @param \App\WebBundle\Entity\EncuestaPregunta $pregunta
     * @return EncuestaPreguntaOpcion
     */
    public function setPregunta(\App\WebBundle\Entity\EncuestaPregunta $pregunta = null)
    {
        $this->pregunta = $pregunta;
    
        return $this;
    }

    /**
     * Get pregunta
     *
     * @return \App\WebBundle\Entity\EncuestaPregunta 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }
}