<?php

/**
 * CapituloTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CapituloTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CapituloTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Capitulo');
    }
    
    
                    public function getVideos($idCapitulo){
           $query = Doctrine_Core::getTable('VideoCapitulo')      
      ->createQuery('a')
      ->where('a.idCapitulo =?',$idCapitulo)             
      ->andWhere('a.borrado = false');

            return $query->execute();
    }
    
                        public function getFotografias($idCapitulo){
           $query = Doctrine_Core::getTable('FotografiaCapitulo')      
      ->createQuery('a')
      ->where('a.idCapitulo =?',$idCapitulo)             
      ->andWhere('a.borrado = false');

            return $query->execute();
    }
    
                  public function getLista() {	     
          
    $q = Doctrine_Query::create()
    ->select('t.id, t.titulo')
    ->from('Capitulo t')
    ->where('t.borrado = ?', '0')
    ->orderBy('t.titulo DESC');
       $q->fetchArray();
       
  $resultados=$q->fetchArray();
	     if (!$resultados) {
	     	return false;
	     }
	     else {
	     	foreach ($resultados as $resultado) {
	     		$retorno[$resultado['id']]=$resultado['titulo'];
	     	}
	     	
	     	return $retorno;
	     }
	     	
  
}
    
}