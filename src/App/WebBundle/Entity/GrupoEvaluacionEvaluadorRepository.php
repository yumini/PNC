<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GrupoEvaluacionEvaluadorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GrupoEvaluacionEvaluadorRepository extends EntityRepository
{
    public function FindByGrupo($id){
        $em=$this->getEntityManager();
        $dql= "SELECT gee FROM AppWebBundle:GrupoEvaluacionEvaluador gee 
                JOIN gee.grupo g
                WHERE g.id=:id ";
        $query=$em->createQuery($dql)->setParameter('id', $id);
        try {
                return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }

    public function AllGroupByEvaluador($id){
        $em=$this->getEntityManager();
        $dql= "SELECT ge FROM AppWebBundle:GrupoEvaluacion ge 
                JOIN ge.evaluadores gee
                JOIN gee.evaluador e
                WHERE e.id=:id ";
        $query=$em->createQuery($dql)->setParameter('id', $id);
        try {
                return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
    public function FindEvaluadoresDisponibles($id){       
        $conn = $this->getEntityManager()->getConnection('database_connection');//create a connection with your DB
        $sql="select e.* from evaluador e inner JOIN inscripcionevaluador ie on ie.evaluador_id=e.id
where ie.concurso_id=$id and 
e.id not in(
select e.id from grupoevaluacionevaluador ge INNER JOIN evaluador e on e.id=ge.evaluador_id 
INNER JOIN grupoevaluacion g ON g.id=ge.grupoevaluacion_id where g.concurso_id=$id) ";                  
    
        $stmt = $conn->prepare($sql);  
        $stmt->execute(); 
        
        return $result=$stmt->fetchAll(); 
    }
    public function ActiveLider(GrupoEvaluacionEvaluador $obj){
        $conn = $this->getEntityManager()->getConnection('database_connection');//create a connection with your DB

        $sql="UPDATE grupoevaluacionevaluador set lider=0 where grupoevaluacion_id='".$obj->getGrupo()->getId()."'";                   
        $stmt = $conn->prepare($sql);  
        $stmt->execute(); 
        
        $sql="UPDATE grupoevaluacionevaluador set lider=1 where id='".$obj->getId()."'";                   
        $stmt = $conn->prepare($sql);  
        $stmt->execute(); 
    }
    
   
}
