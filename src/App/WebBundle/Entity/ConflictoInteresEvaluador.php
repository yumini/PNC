<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConflictoInteresEvaluador
 *
 * @ORM\Table(name="conflictointeresevaluador")
 * @ORM\Entity(repositoryClass="App\WebBundle\Entity\ConflictoInteresEvaluadorRepository")
 */
class ConflictoInteresEvaluador
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
     * @ORM\Column(name="razonsocial", type="string", length=250)
     */
    private $razonsocial;

    /**
     * @var string
     *
     * @ORM\Column(name="ruc", type="string", length=11)
     */
    private $ruc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecini", type="date")
     */
    private $fecini;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecfin", type="date")
     */
    private $fecfin;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text")
     */
    private $detalle;
    
      /**
    * @ORM\ManyToOne(targetEntity="Catalogo", inversedBy="tvicatalogos")
    * @ORM\JoinColumn(name="tipovinculointeres_id", referencedColumnName="id")
    */
    protected $tipoVinculo;
    
    /**
    * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="evaluadores")
    * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id")
    */
    private $evaluador;


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
     * Set razonsocial
     *
     * @param string $razonsocial
     * @return ConflictoInteresEvaluador
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;
    
        return $this;
    }

    /**
     * Get razonsocial
     *
     * @return string 
     */
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * Set ruc
     *
     * @param string $ruc
     * @return ConflictoInteresEvaluador
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    
        return $this;
    }

    /**
     * Get ruc
     *
     * @return string 
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * Set fecini
     *
     * @param \DateTime $fecini
     * @return ConflictoInteresEvaluador
     */
    public function setFecini($fecini)
    {
        $this->fecini = $fecini;
    
        return $this;
    }

    /**
     * Get fecini
     *
     * @return \DateTime 
     */
    public function getFecini()
    {
        return $this->fecini;
    }

    /**
     * Set fecfin
     *
     * @param \DateTime $fecfin
     * @return ConflictoInteresEvaluador
     */
    public function setFecfin($fecfin)
    {
        $this->fecfin = $fecfin;
    
        return $this;
    }

    /**
     * Get fecfin
     *
     * @return \DateTime 
     */
    public function getFecfin()
    {
        return $this->fecfin;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     * @return ConflictoInteresEvaluador
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    
        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set tipoVinculo
     *
     * @param \App\WebBundle\Entity\Catalogo $tipoVinculo
     * @return ConflictoInteresEvaluador
     */
    public function setTipoVinculo(\App\WebBundle\Entity\Catalogo $tipoVinculo = null)
    {
        $this->tipoVinculo = $tipoVinculo;
    
        return $this;
    }

    /**
     * Get tipoVinculo
     *
     * @return \App\WebBundle\Entity\Catalogo 
     */
    public function getTipoVinculo()
    {
        return $this->tipoVinculo;
    }

    /**
     * Set evaluador
     *
     * @param \App\WebBundle\Entity\Evaluador $evaluador
     * @return ConflictoInteresEvaluador
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