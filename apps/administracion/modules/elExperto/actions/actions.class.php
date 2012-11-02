<?php

/**
 * elExperto actions.
 *
 * @package    amina
 * @subpackage elExperto
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class elExpertoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if($request->hasParameter('idEpisodio')){
       $this->getUser()->setAttribute('idEpisodio', $request->getParameter('idEpisodio'));
        }
                 //si se pasa el id episodio se muestran algunos no todos
    if($request->hasParameter('idEpisodio') or $this->getUser()->hasAttribute('idEpisodio')){ 
        $q = Doctrine_Core::getTable('ElExperto')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->andWhere('a.idEpisodio = ?',$this->getUser()->getAttribute('idEpisodio'))            
      ->orderBy('a.created_at DESC');
        
      $this->episodio = Doctrine_Core::getTable('Episodio')->find($this->getUser()->getAttribute('idEpisodio'));
     }else{
      $q = Doctrine_Core::getTable('ElExperto')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              
        }
        

        $this->el_expertos = new sfDoctrinePager('ElExperto', 6);
	$this->el_expertos->setQuery($q);   	
        $this->el_expertos->setPage($this->getRequestParameter('page',1));
	$this->el_expertos->init();
        //route del paginado
        $this->action = '@elExperto_index_page';    
  }
  
    
      public function executeIndexTodos(sfWebRequest $request)
  {
       $this->getUser()->setAttribute('idEpisodio',null);
        

      $q = Doctrine_Core::getTable('ElExperto')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at ASC');              


        $this->el_expertos = new sfDoctrinePager('ElExperto', 6);
	$this->el_expertos->setQuery($q);   	
        $this->el_expertos->setPage($this->getRequestParameter('page',1));
	$this->el_expertos->init();
        //route del paginado
        $this->action = '@elExperto_index_page';  
        
        $this->setTemplate('index');
  }
  
  
        public function executeNewSinIdEpisodio(sfWebRequest $request)
  {
      $this->form = new ElExpertoForm2();
  }
  
  
        public function executeCreate2(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ElExpertoForm2();

    $this->processForm($request, $this->form);

    $this->setTemplate('newSinIdEpisodio');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ElExpertoForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ElExpertoForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id'))), sprintf('Object el_experto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ElExpertoForm($el_experto);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id'))), sprintf('Object el_experto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ElExpertoForm($el_experto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id'))), sprintf('Object el_experto does not exist (%s).', $request->getParameter('id')));
    $el_experto->borrado=1;
    $el_experto->activo=0;
    $el_experto->save();
    $this->getUser()->setFlash('mensajeSuceso','Contenido eliminado.');

    $this->redirect('elExperto/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $el_experto = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Contenido Guardado.');
      
      $this->redirect('elExperto/index?idEpisodio='.$el_experto->getIdEpisodio());
    }else{
     $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');
    }
  }
  
        public function executeBuscar(sfWebRequest $request)
  {
        $query = $request->getParameter('query');
          if($this->getUser()->hasAttribute('idEpisodio')){

       $q = Doctrine_Core::getTable('ElExperto')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.idEpisodio = '.$this->getUser()->getAttribute('idEpisodio').' AND a.descripcion LIKE ?','%'.$query.'%')                
      ->orderBy('a.created_at ASC'); 
          }else{
             $q = Doctrine_Core::getTable('ElExperto')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%') 
      ->orderBy('a.created_at ASC');         
          }
        $this->el_expertos = new sfDoctrinePager('ElExperto', 6);
	$this->el_expertos->setQuery($q);   	
        $this->el_expertos->setPage($this->getRequestParameter('page',1));
	$this->el_expertos->init();
        //route del paginado
         $this->action = 'elExperto/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
  }
  
  
    
        public function executeShow(sfWebRequest $request)
  {
    $this->el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->el_experto);
  }
  
  
      public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id'))), sprintf('Object contenido_episodio does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $el_experto->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $el_experto->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $el_experto->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $el_experto->save();
    
    }
  
  
  
}
