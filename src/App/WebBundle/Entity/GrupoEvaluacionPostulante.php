<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; 
/**
 * GrupoEvaluacionPostulante
 *
 * @ORM\Table(name="grupoevaluacionpostulante")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\GrupoEvaluacionPostulanteRepository")
 */
class GrupoEvaluacionPostulante
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
    * @ORM\ManyToOne(targetEntity="GrupoEvaluacion", inversedBy="postulantes")
    * @ORM\JoinColumn(name="grupoevaluacion_id", referencedColumnName="id")
    */
    private $grupo;
    
    /**
    * @ORM\ManyToOne(targetEntity="Postulante", inversedBy="grupos")
    * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
    */
    private $postulante;
    
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return GrupoEvaluacionPostulante
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
     * @return GrupoEvaluacionPostulante
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
     * @return GrupoEvaluacionPostulante
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
     * Set postulante
     *
     * @param \App\WebBundle\Entity\Postulante $postulante
     * @return GrupoEvaluacionPostulante
     */
    public function setPostulante(\App\WebBundle\Entity\Postulante $postulante = null)
    {
        $this->postulante = $postulante;
    
        return $this;
    }

    /**
     * Get postulante
     *
     * @return \App\WebBundle\Entity\Postulante 
     */
    public function getPostulante()
    {
        return $this->postulante;
    }
}