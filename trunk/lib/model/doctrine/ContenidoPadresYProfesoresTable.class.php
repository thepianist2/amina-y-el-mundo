<?php

/**
 * ContenidoPadresYProfesoresTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ContenidoPadresYProfesoresTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ContenidoPadresYProfesoresTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ContenidoPadresYProfesores');
    }
    
         public function getFotografias($idContenido){
           $query = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')      
      ->createQuery('a')
      ->where('a.idContenidoPadresYProfesores =?',$idContenido)             
      ->andWhere('a.borrado = false');

            return $query->execute();
    }
}