<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * InscripcionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InscripcionRepository extends EntityRepository
{
	public function IsRegister($idPostulante,$idConcurso){
        $em=$this->getEntityManager();
        $dql= "
        SELECT count(i.id) as total FROM AppWebBundle:Inscripcion i
        JOIN i.concurso c 
        JOIN i.postulante p
        WHERE c.id=:codConcurso and p.id=:codPostulante";
        $query=$em->createQuery($dql)
                ->setParameter('codConcurso', $idConcurso)
                ->setParameter('codPostulante', $idPostulante);
        try {
                 $result=$query->getResult();
                return ($result[0]['total']==0)?false:true;
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
    public function GetConcursos($idPostulante){
        $em=$this->getEntityManager();
        $dql= "
        SELECT i FROM AppWebBundle:Inscripcion i
        JOIN i.concurso c 
        JOIN i.postulante p
        WHERE p.id=:codPostulante";
        $query=$em->createQuery($dql)
                  ->setParameter('codPostulante', $idPostulante);
        try {
                return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
}
