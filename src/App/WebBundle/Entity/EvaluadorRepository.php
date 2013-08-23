<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EvaluadorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EvaluadorRepository extends EntityRepository
{
	public function getEvaluadores($id){
        $em=$this->getEntityManager();
        $dql= "SELECT ev FROM AppWebBundle:Evaluador ev 
                JOIN ev.grupos g
                WHERE g.id=:id ";
        $query=$em->createQuery($dql)
                ->setParameter('id', $id);
        try {
                return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
}
