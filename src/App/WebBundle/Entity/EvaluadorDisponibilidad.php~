<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluadorDisponibilidad
 *
 * @ORM\Table(name="evaluadordisponibilidad")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\EvaluadorDisponibilidadRepository")
 */
class EvaluadorDisponibilidad
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
     * @ORM\Column(name="manana",type="boolean")
     */
    private $manana;

    /**
     * @var string
     *
     * @ORM\Column(name="tarde",type="boolean")
     */
    private $tarde;

    /**
     * @var string
     *
     * @ORM\Column(name="noche",type="boolean")
     */
    private $noche;

    /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="diasdisponiblesEvaluador")
    * @ORM\JoinColumn(name="dia_id", referencedColumnName="id")
    */
    protected $dia;
    
    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="diasdisponibles")
    * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id")
    */
    protected $evaluador;
    
    public function __construct()
    {
       $this->manana = false;
       $this->tarde = false;
       $this->noche = false;
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
     * Set manana
     *
     * @param string $manana
     * @return EvaluadorDisponibilidad
     */
    public function setManana($manana)
    {
        $this->manana = $manana;
    
        return $this;
    }

    /**
     * Get manana
     *
     * @return string 
     */
    public function getManana()
    {
        return $this->manana;
    }

    /**
     * Set tarde
     *
     * @param string $tarde
     * @return EvaluadorDisponibilidad
     */
    public function setTarde($tarde)
    {
        $this->tarde = $tarde;
    
        return $this;
    }

    /**
     * Get tarde
     *
     * @return string 
     */
    public function getTarde()
    {
        return $this->tarde;
    }

    /**
     * Set noche
     *
     * @param string $noche
     * @return EvaluadorDisponibilidad
     */
    public function setNoche($noche)
    {
        $this->noche = $noche;
    
        return $this;
    }

    /**
     * Get noche
     *
     * @return string 
     */
    public function getNoche()
    {
        return $this->noche;
    }

    /**
     * Set dias
     *
     * @param \App\WebBundle\Entity\Catalogo $dias
     * @return EvaluadorDisponibilidad
     */
    public function setDias(\App\WebBundle\Entity\Catalogo $dias = null)
    {
        $this->dias = $dias;
    
        return $this;
    }

    /**
     * Get dias
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * Set dia
     *
     * @param \App\WebBundle\Entity\Catalogo $dia
     * @return EvaluadorDisponibilidad
     */
    public function setDia(\App\WebBundle\Entity\Catalogo $dia = null)
    {
        $this->dia = $dia;
    
        return $this;
    }

    /**
     * Get dia
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return EvaluadorDisponibilidad
     */
    public function setEvaluador(\App\WebBundle\Entity\Evaluador $evaluador = null)
    {
        $this->evaluador = $evaluador;
    
        return $this;
    }

    /**
     * Get evaluador
     *
     * @return \App\WebBundle\Entity\Evaluador 
     */
    public function getEvaluador()
    {
        return $this->evaluador;
    }
}