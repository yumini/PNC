<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * GrupoEvaluacionEvaluador
 *
 * @ORM\Table(name="grupoevaluacionevaluador")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\GrupoEvaluacionEvaluadorRepository")
 */
class GrupoEvaluacionEvaluador
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
    * @ORM\ManyToOne(targetEntity="GrupoEvaluacion", inversedBy="evaluadores")
    * @ORM\JoinColumn(name="grupoevaluacion_id", referencedColumnName="id")
    */
    private $grupo;
    
    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="grupos")
    * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id")
    */
    private $evaluador;
    
    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="fechaRegistro", type="datetime")
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="fechaActualizacion", type="datetime")
     */
    private $fechaActualizacion;

     /**
     * @var string
     *
     * @ORM\Column(name="lider", type="boolean")
     */
    private $lider;
    /**
     * Get id
     *
     * @return integer 
     */
    public function __construct()
    {
        $this->lider ='0';
       
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return GrupoEvaluacionEvaluador
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
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return GrupoEvaluacionEvaluador
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
     * Set grupo
     *
     * @param \App\WebBundle\Entity\GrupoEvaluacion $grupo
     * @return GrupoEvaluacionEvaluador
     */
    public function setGrupo(\App\WebBundle\Entity\GrupoEvaluacion $grupo = null)
    {
        $this->grupo = $grupo;
    
        return $this;
    }

    /**
     * Get grupo
     *
     * @return \App\WebBundle\Entity\GrupoEvaluacion 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return GrupoEvaluacionEvaluador
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

    /**
     * Set lider
     *
     * @param boolean $lider
     * @return GrupoEvaluacionEvaluador
     */
    public function setLider($lider)
    {
        $this->lider = $lider;
    
        return $this;
    }

    /**
     * Get lider
     *
     * @return boolean 
     */
    public function getLider()
    {
        return $this->lider;
    }
}