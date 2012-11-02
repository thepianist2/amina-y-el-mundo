<?php

/**
 * contenido actions.
 *
 * @package    amina
 * @subpackage contenido
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contenidoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q  = Doctrine_Core::getTable('Contenido')
      ->createQuery('a')
       ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');
       
        $this->contenidos = new sfDoctrinePager('Contenido', 6);
	$this->contenidos->setQuery($q);   	
        $this->contenidos->setPage($this->getRequestParameter('page',1));
	$this->contenidos->init();
        //route del paginado
        $this->action = '@contenido_index_page';  
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ContenidoForm();
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());

    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoForm();
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
  
    
        public function executeBuscar(sfWebRequest $request)
  {
                $query = $request->getParameter('query');
       $q = Doctrine_Core::getTable('Contenido')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.contenido LIKE ?','%'.$query.'%')     
      ->orderBy('a.created_at ASC'); 
       
        $this->contenidos = new sfDoctrinePager('Contenido', 6);
	$this->contenidos->setQuery($q);   	
        $this->contenidos->setPage($this->getRequestParameter('page',1));
	$this->contenidos->init();
        //route del paginado
         $this->action = 'contenido/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }
  
  

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoForm($contenido);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoForm($contenido);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $contenido->borrado=1;
    $contenido->activo=0;
    $contenido->save();
    $this->getUser()->setFlash('mensajeSuceso','Contenido eliminado.');

    $this->redirect('contenido/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contenido = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Contenido guardado.');

      $this->redirect('contenido/index');
    }else{
     $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
  
    
      public function executeShow(sfWebRequest $request)
  {
    $this->contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->contenido);
  }
  
  
      public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $contenido->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $contenido->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $contenido->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $contenido->save();
    
    }
  
  
}
