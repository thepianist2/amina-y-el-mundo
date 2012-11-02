<?php

/**
 * comentario actions.
 *
 * @package    amina
 * @subpackage comentario
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comentarioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

       if($request->hasParameter('idUnidad')){
       $this->getUser()->setAttribute('idUnidad', $request->getParameter('idUnidad'));
        }
        
        //si se pasa la unidad tematica se muestra solo los comentarios de el, sino todos
        if($request->hasParameter('idUnidad') or $this->getUser()->hasAttribute('idUnidad')){
    $q = Doctrine_Core::getTable('Comentario')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->andWhere('a.idUnidadTematica = ?',$this->getUser()->getAttribute('idUnidad'))            
      ->orderBy('a.created_at DESC');
      $this->unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($this->getUser()->getAttribute('idUnidad')));

        }else{
      $q = Doctrine_Core::getTable('Comentario')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              
        }
        

        $this->comentarios = new sfDoctrinePager('Comentario', 6);
	$this->comentarios->setQuery($q);   	
        $this->comentarios->setPage($this->getRequestParameter('page',1));
	$this->comentarios->init();
        //route del paginado
        $this->action = '@comentario_index_page';  
  }
  
  
    
    public function executeIndexTodos(sfWebRequest $request)
  {
       $this->getUser()->setAttribute('idUnidad',null);
        

      $q = Doctrine_Core::getTable('Comentario')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at ASC');              

        

        $this->comentarios = new sfDoctrinePager('Comentario', 6);
	$this->comentarios->setQuery($q);   	
        $this->comentarios->setPage($this->getRequestParameter('page',1));
	$this->comentarios->init();
        //route del paginado
        $this->action = '@comentario_index_page';  
        
            $this->setTemplate('index');
  }
  
  
        public function executeBuscar(sfWebRequest $request)
  {
                $query = $request->getParameter('query');
          if($this->getUser()->hasAttribute('idUnidad')){

       $q = Doctrine_Core::getTable('Comentario')
      ->createQuery('a')
       ->where('a.borrado = 0 AND a.idUnidadTematica = ?',$this->getUser()->getAttribute('idUnidad'))
      ->andWhere('a.publicacion LIKE ?','%'.$query.'%')         
      ->orderBy('a.created_at ASC'); 
          }else{
             $q = Doctrine_Core::getTable('Comentario')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.publicacion LIKE ?','%'.$query.'%')                     
      ->orderBy('a.created_at ASC');         
          }
        $this->comentarios = new sfDoctrinePager('Comentario', 6);
	$this->comentarios->setQuery($q);   	
        $this->comentarios->setPage($this->getRequestParameter('page',1));
	$this->comentarios->init();
        //route del paginado
         $this->action = 'comentario/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ComentarioForm();
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());
    $this->form->setDefault('idUnidadTematica', $this->getUser()->getAttribute('idUnidad'));
   
  }
  
  
    
    public function executeNewSinIdUnidad(sfWebRequest $request)
  {
    $this->form = new ComentarioForm2();
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());

    
  }
  
  
    public function executeCreate2(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ComentarioForm2();
    
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());    

    $this->processForm($request, $this->form);

    $this->setTemplate('newSinIdUnidad');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ComentarioForm();
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());
    $this->form->setDefault('idUnidadTematica', $this->getUser()->getAttribute('idUnidad'));
  

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($comentario = Doctrine_Core::getTable('Comentario')->find(array($request->getParameter('id'))), sprintf('Object comentario does not exist (%s).', $request->getParameter('id')));
    $this->form = new ComentarioForm($comentario);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($comentario = Doctrine_Core::getTable('Comentario')->find(array($request->getParameter('id'))), sprintf('Object comentario does not exist (%s).', $request->getParameter('id')));
    $this->form = new ComentarioForm($comentario);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($comentario = Doctrine_Core::getTable('Comentario')->find(array($request->getParameter('id'))), sprintf('Object comentario does not exist (%s).', $request->getParameter('id')));
    $comentario->borrado=1;
    $comentario->activo=0;
    $comentario->save();
    $this->getUser()->setFlash('mensajeSuceso','Comentario eliminado.');

    $this->redirect('comentario/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
     $this->getUser()->setFlash('mensajeTerminado','Comentario guardado.');

      $comentario = $form->save();

      $this->redirect('comentario/index?idUnidad='.$comentario->getIdUnidadTematica());
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
      public function executeShow(sfWebRequest $request)
  {
    $this->comentario = Doctrine_Core::getTable('Comentario')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->comentario);
  }
  
  
  
      public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($comentario = Doctrine_Core::getTable('Comentario')->find(array($request->getParameter('id'))), sprintf('Object comentario does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $comentario->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $comentario->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $comentario->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $comentario->save();
    
    }
}
