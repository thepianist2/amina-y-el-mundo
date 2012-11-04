<?php

/**
 * EpisodioTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EpisodioTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object EpisodioTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Episodio');
    }
    
    
        public function getJuegos($idEpisodio){
           $query = Doctrine_Core::getTable('JuegoEpisodio')      
      ->createQuery('a')
      ->where('a.idEpisodio =?',$idEpisodio)             
      ->andWhere('a.borrado = false');

            return $query->execute();
    }
    
            public function getElExpertos($idEpisodio){
           $query = Doctrine_Core::getTable('ElExperto')      
      ->createQuery('a')
      ->where('a.idEpisodio =?',$idEpisodio)             
      ->andWhere('a.borrado = false');

            return $query->execute();
    }
    
                public function getCapitulos($idEpisodio){
           $query = Doctrine_Core::getTable('Capitulo')      
      ->createQuery('a')
      ->where('a.idEpisodio =?',$idEpisodio)             
      ->andWhere('a.borrado = false');

            return $query->execute();
    }
    
                    public function getContenidoPadresYProfesores($idEpisodio){
           $query = Doctrine_Core::getTable('ContenidoPadresYProfesores')      
      ->createQuery('a')
      ->where('a.idEpisodio =?',$idEpisodio)             
      ->andWhere('a.borrado = false');

            return $query->execute();
    }
    
                  public function getLista() {	     
          
    $q = Doctrine_Query::create()
    ->select('t.id, t.titulo')
    ->from('Episodio t')
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