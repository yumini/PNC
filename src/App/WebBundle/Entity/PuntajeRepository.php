<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PuntajeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PuntajeRepository extends EntityRepository
{
	public function findByEvaluacionAndCriterio($evaluacionId,$criterioId,$isArray=false){
        $em=$this->getEntityManager();
        $dql= "SELECT p FROM AppWebBundle:Puntaje p 
        	JOIN p.evaluacion e
        	JOIN p.criterio c
        	WHERE e.id=:evaluacionId
        	AND c.id=:criterioId ";
        $query=$em->createQuery($dql)
        	->setParameter('evaluacionId', $evaluacionId)
        	->setParameter('criterioId', $criterioId);
        try {
                if($isArray)
                    return $query->getArrayResult();
                else
                    return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
}
