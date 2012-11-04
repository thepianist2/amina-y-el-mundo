<?php

/**
 * juegoEpisodio actions.
 *
 * @package    amina
 * @subpackage juegoEpisodio
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class juegoEpisodioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if($request->hasParameter('idEpisodio')){
       $this->getUser()->setAttribute('idEpisodio', $request->getParameter('idEpisodio'));
        }
             //si se pasa el id episodio se muestran algunos no todos
    if($request->hasParameter('idEpisodio') or $this->getUser()->hasAttribute('idEpisodio')){ 
        $q = Doctrine_Core::getTable('JuegoEpisodio')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->andWhere('a.idEpisodio = ?',$this->getUser()->getAttribute('idEpisodio'))            
      ->orderBy('a.created_at DESC');
        
      $this->episodio = Doctrine_Core::getTable('Episodio')->find($this->getUser()->getAttribute('idEpisodio'));
     }else{
      $q = Doctrine_Core::getTable('JuegoEpisodio')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              
        }
        

        $this->juego_episodios = new sfDoctrinePager('JuegoEpisodio', 6);
	$this->juego_episodios->setQuery($q);   	
        $this->juego_episodios->setPage($this->getRequestParameter('page',1));
	$this->juego_episodios->init();
        //route del paginado
        $this->action = '@juegoEpisodio_index_page';  
  }
  
  
  
      public function executeIndexTodos(sfWebRequest $request)
  {
       $this->getUser()->setAttribute('idEpisodio',null);
        

      $q = Doctrine_Core::getTable('JuegoEpisodio')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at ASC');              

        

        $this->juego_episodios = new sfDoctrinePager('JuegoEpisodio', 6);
	$this->juego_episodios->setQuery($q);   	
        $this->juego_episodios->setPage($this->getRequestParameter('page',1));
	$this->juego_episodios->init();
        //route del paginado
        $this->action = '@juegoEpisodio_index_page';  
        
        $this->setTemplate('index');
  }
  
      public function executeNewSinIdEpisodio(sfWebRequest $request)
  {
      $this->form = new JuegoEpisodioForm2();
  }
  
      public function executeCreate2(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JuegoEpisodioForm2();

    $this->processForm($request, $this->form);

    $this->setTemplate('newSinIdEpisodio');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new JuegoEpisodioForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));
  }
  
      public function executeShow(sfWebRequest $request)
  {
    $this->juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->juego_episodio);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JuegoEpisodioForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id'))), sprintf('Object juego_episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new JuegoEpisodioForm($juego_episodio);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id'))), sprintf('Object juego_episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new JuegoEpisodioForm($juego_episodio);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id'))), sprintf('Object juego_episodio does not exist (%s).', $request->getParameter('id')));
    $juego_episodio->borrado=1;
    $juego_episodio->activo=0;
    $juego_episodio->save();
    $this->getUser()->setFlash('mensajeSuceso','Juego eliminado.');

    $this->redirect('juegoEpisodio/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    $valores = $request->getParameter($form->getName());
    $archivoFlash = $valores['archivoFlash'];
    if ($form->isValid())
    {
      $juego_episodio = $form->save();
      if(!$form->getObject()->archivoFlash){
           $this->getUser()->setFlash('mensajeTerminado','Juego Guardado');
           $this->getUser()->setFlash('mensajeErrorGrave','Archivo no encontrado, verifique que el archivo flash esté subido');
      }else{
          $this->getUser()->setFlash('mensajeTerminado','Juego Guardado.');
      }
      $this->redirect('juegoEpisodio/index?idEpisodio='.$juego_episodio->getIdEpisodio());
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
    
      public function executeBuscar(sfWebRequest $request)
  {
                $query = $request->getParameter('query');
          if($this->getUser()->hasAttribute('idEpisodio')){

       $q = Doctrine_Core::getTable('JuegoEpisodio')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.idEpisodio = '.$this->getUser()->getAttribute('idEpisodio').' AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.idEpisodio = '.$this->getUser()->getAttribute('idEpisodio').' AND a.descripcion LIKE ?','%'.$query.'%')                
      ->orderBy('a.created_at ASC'); 
          }else{
             $q = Doctrine_Core::getTable('JuegoEpisodio')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%') 
      ->orderBy('a.created_at ASC');         
          }
        $this->juego_episodios = new sfDoctrinePager('JuegoEpisodio', 6);
	$this->juego_episodios->setQuery($q);   	
        $this->juego_episodios->setPage($this->getRequestParameter('page',1));
	$this->juego_episodios->init();
        //route del paginado
         $this->action = 'juegoEpisodio/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
  }
  
  
    public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id'))), sprintf('Object juego_episodio does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $juego_episodio->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $juego_episodio->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $juego_episodio->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $juego_episodio->save();
    
    }
}
