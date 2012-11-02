<?php

/**
 * contacto actions.
 *
 * @package    amina
 * @subpackage contacto
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      $q = Doctrine_Core::getTable('Contacto')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');
      
        $this->contactos = new sfDoctrinePager('Contacto', 6);
	$this->contactos->setQuery($q);   	
        $this->contactos->setPage($this->getRequestParameter('page',1));
	$this->contactos->init();   
        //route del paginado
        $this->action = '@contacto_index_page';    
      
  }
  
      public function executeBuscar(sfWebRequest $request)
  {
        
        $query = $request->getParameter('query');
       $q = Doctrine_Core::getTable('Contacto')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.nombre LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.email LIKE ?','%'.$query.'%')  
      ->orWhere('a.borrado = 0 AND a.telefono LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.empresa LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.comentario LIKE ?','%'.$query.'%')               
      ->orderBy('a.created_at ASC'); 
     
        $this->contactos = new sfDoctrinePager('Contacto', 6);
	$this->contactos->setQuery($q);   	
        $this->contactos->setPage($this->getRequestParameter('page',1));
	$this->contactos->init();   
        //route del paginado
         $this->action = 'contacto/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }
  
    public function executeShow(sfWebRequest $request)
  {
    $this->contacto = Doctrine_Core::getTable('Contacto')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->contacto);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ContactoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContactoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contacto = Doctrine_Core::getTable('Contacto')->find(array($request->getParameter('id'))), sprintf('Object contacto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContactoForm($contacto);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contacto = Doctrine_Core::getTable('Contacto')->find(array($request->getParameter('id'))), sprintf('Object contacto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContactoForm($contacto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($contacto = Doctrine_Core::getTable('Contacto')->find(array($request->getParameter('id'))), sprintf('Object contacto does not exist (%s).', $request->getParameter('id')));
    $contacto->borrado=1;
    $contacto->save();
    $this->getUser()->setFlash('mensajeSuceso','Solicitud de contacto eliminada.');

    $this->redirect('contacto/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contacto = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Solicitud de contacto guardado.');
      $this->redirect('contacto/index');
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
    public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($contacto = Doctrine_Core::getTable('Contacto')->find(array($request->getParameter('id'))), sprintf('Object contacto does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $contacto->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $contacto->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $contacto->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $contacto->save();
    
//    $this->getUser()->setFlash('mensajeSuceso','Cambio realizado.');

//        $this->redirect('default/index');
    }
}
