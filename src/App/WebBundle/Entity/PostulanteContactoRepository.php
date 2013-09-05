<?php

namespace App\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PostulanteContactoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostulanteContactoRepository extends EntityRepository
{
    public function FindByUser($idusuario){
        $em=$this->getEntityManager();
        $dql= "SELECT pc FROM AppWebBundle:PostulanteContacto pc 
                JOIN pc.postulantes p WHERE p.usuario_id=:id";
        $query=$em->createQuery($dql)->setParameter('id', $idusuario);
        try {
                return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
        }
    }
}
