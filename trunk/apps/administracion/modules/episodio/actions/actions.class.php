<?php

/**
 * episodio actions.
 *
 * @package    amina
 * @subpackage episodio
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class episodioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
       if($request->hasParameter('idUnidad')){
       $this->getUser()->setAttribute('idUnidad', $request->getParameter('idUnidad'));
        }
        
        //si se pasa la unidad tematica se muestra solo los episodio de el, sino todos
        if($request->hasParameter('idUnidad') or $this->getUser()->hasAttribute('idUnidad')){
    $q = Doctrine_Core::getTable('Episodio')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->andWhere('a.idUnidadTematica = ?',$this->getUser()->getAttribute('idUnidad'))            
      ->orderBy('a.created_at DESC');
      $this->unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($this->getUser()->getAttribute('idUnidad')));

        }else{
      $q = Doctrine_Core::getTable('Episodio')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              
        }
        

        $this->episodios = new sfDoctrinePager('Episodio', 6);
	$this->episodios->setQuery($q);   	
        $this->episodios->setPage($this->getRequestParameter('page',1));
	$this->episodios->init();
        //route del paginado
        $this->action = '@episodio_index_page';  
  }
  
  
    public function executeIndexTodos(sfWebRequest $request)
  {
       $this->getUser()->setAttribute('idUnidad',null);
        

      $q = Doctrine_Core::getTable('Episodio')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at ASC');              

        

        $this->episodios = new sfDoctrinePager('Episodio', 6);
	$this->episodios->setQuery($q);   	
        $this->episodios->setPage($this->getRequestParameter('page',1));
	$this->episodios->init();
        //route del paginado
        $this->action = '@episodio_index_page';  
        
            $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EpisodioForm();
    $this->form->setDefault('idUnidadTematica', $this->getUser()->getAttribute('idUnidad'));
    
  }
  
  
    public function executeNewSinIdUnidad(sfWebRequest $request)
  {
    $this->form = new EpisodioForm2();
    
  }
  
  
    public function executeCreate2(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EpisodioForm2();

    $this->processForm($request, $this->form);

    $this->setTemplate('newSinIdUnidad');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EpisodioForm();
    $this->form->setDefault('idUnidadTematica', $this->getUser()->getAttribute('idUnidad'));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id'))), sprintf('Object episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new EpisodioForm($episodio);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id'))), sprintf('Object episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new EpisodioForm($episodio);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
    public function executeShow(sfWebRequest $request)
  {
    $this->episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->episodio);
  }

  public function executeDelete(sfWebRequest $request)
  {

    $this->forward404Unless($episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id'))), sprintf('Object episodio does not exist (%s).', $request->getParameter('id')));
    $episodio->borrado=1;
    $episodio->activo=0;
    $episodio->save();
    $this->getUser()->setFlash('mensajeSuceso','Episodio eliminado.');

    $this->redirect('episodio/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $episodio = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Episodio Guardado.');

      $this->redirect('episodio/index?idUnidad='.$episodio->getIdUnidadTematica());
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
      public function executeBuscar(sfWebRequest $request)
  {
                $query = $request->getParameter('query');
          if($this->getUser()->hasAttribute('idUnidad')){

       $q = Doctrine_Core::getTable('Episodio')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.idUnidadTematica = '.$this->getUser()->getAttribute('idUnidad').'  AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.idUnidadTematica = '.$this->getUser()->getAttribute('idUnidad').'  AND a.descripcion LIKE ?','%'.$query.'%')                             
      ->orderBy('a.created_at ASC'); 
          }else{
             $q = Doctrine_Core::getTable('Episodio')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%')                       
      ->orderBy('a.created_at ASC');         
          }
        $this->episodios = new sfDoctrinePager('Episodio', 6);
	$this->episodios->setQuery($q);   	
        $this->episodios->setPage($this->getRequestParameter('page',1));
	$this->episodios->init();
        //route del paginado
         $this->action = 'episodio/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }
  
  
    public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id'))), sprintf('Object episodio does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $episodio->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $episodio->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $episodio->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $episodio->save();
    
    }
}
