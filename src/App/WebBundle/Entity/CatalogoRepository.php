<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CatalogoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CatalogoRepository extends EntityRepository
{
    public function getCatalogos($codcat){
        $em=$this->getEntityManager();
        $dql= "SELECT c FROM AppWebBundle:Catalogo c WHERE c.codcatalogo=:codcatalogo ";
        $query=$em->createQuery($dql)
                ->setParameter('codcatalogo', $codcat);
        try {
                return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
    public function getTipoDocumentoIdentidad(){
       return $this->getCatalogos("TDI");
   }
     public function FindAllPaginator($paginator,$page,$limit,$codcat){
        $em=$this->getEntityManager();
        $dql   = "SELECT c FROM AppWebBundle:Catalogo c WHERE c.codcatalogo=:codcatalogo ";
        $query = $em->createQuery($dql)
                 ->setParameter('codcatalogo', $codcat);
        $pagination = $paginator->paginate($query,$page,$limit);
        return $pagination;
    }
}
