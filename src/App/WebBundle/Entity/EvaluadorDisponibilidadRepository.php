<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EvaluadorDisponibilidadRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EvaluadorDisponibilidadRepository extends EntityRepository
{
    public function FindByEvaluador($idusuario,$isArray=false){
        $em=$this->getEntityManager();
        /*$dql= "SELECT ed FROM AppWebBundle:EvaluadorDisponibilidad ed 
                JOIN ed.evaluador e
                JOIN ed.dia d
                WHERE e.id=:id order by d.codigo asc";
*/
        $dql= "SELECT dia,d FROM AppWebBundle:Catalogo dia 
                LEFT JOIN dia.diasdisponiblesEvaluador d with d.id IN (SELECT x.id FROM  AppWebBundle:EvaluadorDisponibilidad x JOIN x.evaluador e WHERE e.id=:id)
                WHERE dia.codcatalogo='DIA' order by dia.codigo asc";

        $query=$em->createQuery($dql)->setParameter('id', $idusuario);
        try {
                if($isArray)
                    return $query->getArrayResult();
                else
                    return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }

    public function FindByEvaluadorAndDia($idevaluador,$iddia,$isArray=false){
        $em=$this->getEntityManager();
        $dql= "SELECT ed FROM AppWebBundle:EvaluadorDisponibilidad ed 
                JOIN ed.evaluador e
                JOIN ed.dia d
                WHERE e.id=:idevaluador AND d.id=:iddia order by d.codigo asc";

        $query=$em->createQuery($dql)
            ->setParameter('idevaluador', $idevaluador)
            ->setParameter('iddia', $iddia);
        try {
                if($isArray)
                    return $query->getArrayResult();
                else
                    return $query->getOneOrNullResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
}
