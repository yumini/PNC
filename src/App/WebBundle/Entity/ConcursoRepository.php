<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ConcursoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConcursoRepository extends EntityRepository
{
	public function FindAllPaginator($paginator,$page,$limit){
        $em=$this->getEntityManager();
        $dql   = "SELECT p FROM AppWebBundle:Concurso p";
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query,$page,$limit);
        return $pagination;
    }
}
