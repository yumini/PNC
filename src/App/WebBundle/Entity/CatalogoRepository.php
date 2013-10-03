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
    public function getCatalogoByCodigo($catalogo,$codigo){
        $em=$this->getEntityManager();
        $dql= "SELECT c FROM AppWebBundle:Catalogo c WHERE c.codcatalogo=:codcatalogo and c.codigo=:codigo";
        $query=$em->createQuery($dql)
                ->setParameter('codcatalogo', $catalogo)
                ->setParameter('codigo', $codigo);
        try {
                return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
    public function getCatalogosQueryBuilder($codcat){
        return $this->createQueryBuilder('c')->where('c.codcatalogo= ?1')->setParameter(1,$codcat);
        
    }
    
    public function FindAllPaginator($paginator,$page,$limit,$codcat){
        $em=$this->getEntityManager();
        $dql   = "SELECT c FROM AppWebBundle:Catalogo c WHERE c.codcatalogo=:codcatalogo ";
        $query = $em->createQuery($dql)
                 ->setParameter('codcatalogo', $codcat);
        $pagination = $paginator->paginate($query,$page,$limit);
        return $pagination;
    }
    public function getTipoContactosQueryBuilder(){
        return $this->getCatalogosQueryBuilder("TCP");
    }
    public function getTipoDocumentoIdentidadQueryBuilder(){
        return $this->getCatalogosQueryBuilder("TDI");
    }
    public function getTipoSexoQueryBuilder(){
        return $this->getCatalogosQueryBuilder("TSX");
    }
    public function getTipoCriteriosQueryBuilder(){
        return $this->getCatalogosQueryBuilder("TIPOCRITERIO");
    }
    public function getTipoConcursosQueryBuilder(){
        return $this->getCatalogosQueryBuilder("TIPOCONCURSO");
    }
}
