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
    
    public function FindByUser($idusuario){
        $em=$this->getEntityManager();
        $dql= "SELECT e FROM AppWebBundle:Evaluador e 
                JOIN e.usuario u
                WHERE u.id=:id";
        $query=$em->createQuery($dql)
        ->setParameter('id', $idusuario);
        try {
                return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
               return null;
        }
    }
    
    public function FindAllPaginator($paginator,$page,$limit){
        $em=$this->getEntityManager();
        $dql   = "SELECT p FROM AppWebBundle:Evaluador p";
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query,$page,$limit);
        return $pagination;
    }

    public function getPostulantesConflictosInteres($idgrupo,$idevaluador){
        $conn = $this->getEntityManager()->getConnection('database_connection');//create a connection with your DB
        $sql="select p.* from grupoevaluacionpostulante  ge 
        join inscripcion i ON i.id=ge.inscripcion_id 
        join postulante p ON p.id=i.postulante_id
where grupoevaluacion_id=$idgrupo
AND p.ruc in(select c.ruc from conflictointeresevaluador c where c.evaluador_id=$idevaluador);";                  
    
        $stmt = $conn->prepare($sql);  
        $stmt->execute(); 
        return $result=$stmt->fetchAll(); 
        
    }
}
