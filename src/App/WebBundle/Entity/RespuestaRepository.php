<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RespuestaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RespuestaRepository extends EntityRepository
{
	public function findAllById($idCriterio,$isParent,$isArray){
		$em=$this->getEntityManager();
		if($isParent){
			$ids=$this->getAllRespuestasSubcriterios($idCriterio);
			if($ids==null)
				$ids='0';
	        $dql   = "SELECT r,c FROM AppWebBundle:Respuesta r
	        		JOIN r.criterio c
	        		where c.id in($ids)";
	        $query = $em->createQuery($dql);
	    }else{

	    	$dql   = "SELECT r,c FROM AppWebBundle:Respuesta r
	        		JOIN r.criterio c
	        		where c.id=:id";
	        $query = $em->createQuery($dql)->setParameter('id', $idCriterio);
	    }
        
        try {
                if($isArray)
                	return $query->getArrayResult();
                else
                	return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
	}
	public function getAllRespuestasSubcriterios($idsubcriterio){
		 $conn = $this->getEntityManager()->getConnection('database_connection');//create a connection with your DB
        $sql="select GROUP_CONCAT(pregunta.id) as ids from concursocriterio subcriterio inner 
        	JOIN concursocriterio areaanalisis ON areaanalisis.idpadre=subcriterio.id
        	JOIN concursocriterio pregunta ON pregunta.idpadre=areaanalisis.id
        	WHERE subcriterio.id=$idsubcriterio
        	GROUP BY subcriterio.id";                  
    
        $stmt = $conn->prepare($sql);  
        $stmt->execute(); 
        $result=$stmt->fetchAll();

        if($result)
          	return $result[0]['ids'];
        else
          	return null;

         
	}
}