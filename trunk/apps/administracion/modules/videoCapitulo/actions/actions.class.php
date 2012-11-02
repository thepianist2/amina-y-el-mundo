<?php

/**
 * videoCapitulo actions.
 *
 * @package    amina
 * @subpackage videoCapitulo
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class videoCapituloActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
       if($request->hasParameter('idCapitulo')){
       $this->getUser()->setAttribute('idCapitulo', $request->getParameter('idCapitulo'));
        }
        
        //si se pasa el id capitulo para que se vean solo los videos de ese capitulo
        if($request->hasParameter('idCapitulo') or $this->getUser()->hasAttribute('idCapitulo')){
    $q = Doctrine_Core::getTable('VideoCapitulo')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->andWhere('a.idCapitulo = ?',$this->getUser()->getAttribute('idCapitulo'))            
      ->orderBy('a.created_at DESC');
      $this->capitulo = Doctrine_Core::getTable('Capitulo')->find(array($this->getUser()->getAttribute('idCapitulo')));

        }else{
      $q = Doctrine_Core::getTable('VideoCapitulo')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              
        }
        

        $this->video_capitulos = new sfDoctrinePager('VideoCapitulo', 6);
	$this->video_capitulos->setQuery($q);   	
        $this->video_capitulos->setPage($this->getRequestParameter('page',1));
	$this->video_capitulos->init();
        //route del paginado
        $this->action = '@videoCapitulo_index_page';     
    
    
  }
  
  
      public function executeIndexTodos(sfWebRequest $request)
  {
       $this->getUser()->setAttribute('idCapitulo',null);
        

      $q = Doctrine_Core::getTable('VideoCapitulo')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at ASC');              

        

        $this->video_capitulos = new sfDoctrinePager('VideoCapitulo', 6);
	$this->video_capitulos->setQuery($q);   	
        $this->video_capitulos->setPage($this->getRequestParameter('page',1));
	$this->video_capitulos->init();
        //route del paginado
        $this->action = '@videoCapitulo_index_page';     
        
            $this->setTemplate('index');
  }
  
  
          public function executeBuscar(sfWebRequest $request)
  {
                $query = $request->getParameter('query');
          if($this->getUser()->hasAttribute('idCapitulo')){

       $q = Doctrine_Core::getTable('VideoCapitulo')
      ->createQuery('a')
       ->where('a.borrado = 0 AND a.idCapitulo = ?',$this->getUser()->getAttribute('idCapitulo'))
      ->andWhere('a.descripcion LIKE ?','%'.$query.'%')         
      ->orderBy('a.created_at ASC'); 
          }else{
             $q = Doctrine_Core::getTable('VideoCapitulo')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%')                     
      ->orderBy('a.created_at ASC');         
          }
        $this->video_capitulos = new sfDoctrinePager('VideoCapitulo', 6);
	$this->video_capitulos->setQuery($q);   	
        $this->video_capitulos->setPage($this->getRequestParameter('page',1));
	$this->video_capitulos->init();
        //route del paginado
         $this->action = 'videoCapitulo/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }
  
  
  

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new VideoCapituloForm();
    $this->form->setDefault('idCapitulo', $this->getUser()->getAttribute('idCapitulo'));    
  }
  
      public function executeNewSinIdCapitulo(sfWebRequest $request)
  {
    $this->form = new VideoCapituloForm2();
   
  }
  
  
      public function executeCreate2(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new VideoCapituloForm2(); 

    $this->processForm($request, $this->form);

    $this->setTemplate('newSinIdCapitulo');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new VideoCapituloForm();
    
    $this->form->setDefault('idCapitulo', $this->getUser()->getAttribute('idCapitulo'));    

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id'))), sprintf('Object video_capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new VideoCapituloForm($video_capitulo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id'))), sprintf('Object video_capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new VideoCapituloForm($video_capitulo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id'))), sprintf('Object video_capitulo does not exist (%s).', $request->getParameter('id')));
    $video_capitulo->borrado=1;
    $video_capitulo->activo=0;
    $video_capitulo->save();
    $this->getUser()->setFlash('mensajeSuceso','Video de capítulo eliminado.');

    $this->redirect('videoCapitulo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $video_capitulo = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Video guardado.');

      $this->redirect('videoCapitulo/index?idCapitulo='.$video_capitulo->getIdCapitulo());
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
        public function executeShow(sfWebRequest $request)
  {
    $this->video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->video_capitulo);
  }
  
        public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id'))), sprintf('Object video_capitulo does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $video_capitulo->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $video_capitulo->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $video_capitulo->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $video_capitulo->save();
    
    }
  
  
}
