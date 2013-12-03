<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ConversacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConversacionRepository extends EntityRepository
{

    public function findUserForChat(\App\WebBundle\Entity\Usuario $user){
		
       /* $grupos=$user->getGroups();
        foreach ($grupos as \App\WebBundle\Entity\GrupoEvakuacion $grupo) {
        	$evaluadores=$grupo->getEvaluadores();



        }*/
            
	}
    public function findGroupsForChat($idevaluador){
        $conn = $this->getEntityManager()->getConnection('database_connection');//create a connection with your DB
        $sql="select DISTINCT g.*,c.*,ge.* from grupoevaluacion g 
join grupoevaluacionevaluador ge ON ge.grupoevaluacion_id=g.id
join concurso c ON c.id=g.concurso_id AND c.estado=1
JOIN etapaconcurso ce ON ce.concurso_id=c.id
JOIN etapa e ON e.id=ce.etapa_id
JOIN catalogo ct ON ct.id=e.tipoetapa_id
where ge.evaluador_id=$idevaluador AND ct.codcatalogo!=1 
AND (DATE(NOW()) BETWEEN ce.fechaInicio AND ce.fechaFin AND ce.extendido='0') 
or (DATE(NOW()) BETWEEN ce.fechaInicio AND ce.fechaExtension AND ce.extendido='1')";                  
    
        $stmt = $conn->prepare($sql);  
        $stmt->execute(); 
        
        return $result=$stmt->fetchAll();

    }
}
