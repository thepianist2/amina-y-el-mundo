<?php

/**
 * default actions.
 *
 * @package    amina
 * @subpackage default
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('UnidadTematica')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');
     
        $this->unidad_tematicas = new sfDoctrinePager('UnidadTematica', 6);
	$this->unidad_tematicas->setQuery($q);   	
        $this->unidad_tematicas->setPage($this->getRequestParameter('page',1));
	$this->unidad_tematicas->init();
        //route del paginado
        $this->action = '@default_index_page';       
     
  }
  
  
  
    public function executeBuscar(sfWebRequest $request)
  {
        
        $query = $request->getParameter('query');
       $q = Doctrine_Core::getTable('UnidadTematica')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%')  
      ->orderBy('a.created_at ASC'); 
     
        $this->unidad_tematicas = new sfDoctrinePager('UnidadTematica', 6);
	$this->unidad_tematicas->setQuery($q);   	
        $this->unidad_tematicas->setPage($this->getRequestParameter('page',1));
	$this->unidad_tematicas->init();
        //route del paginado
         $this->action = 'default/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->unidad_tematica);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UnidadTematicaForm();
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UnidadTematicaForm();
    
    $this->form->setDefault('idUsuario', $this->getUser()->getGuardUser()->getId());

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($request->getParameter('id'))), sprintf('Object unidad_tematica does not exist (%s).', $request->getParameter('id')));
    $this->form = new UnidadTematicaForm($unidad_tematica);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($request->getParameter('id'))), sprintf('Object unidad_tematica does not exist (%s).', $request->getParameter('id')));
    $this->form = new UnidadTematicaForm($unidad_tematica);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($request->getParameter('id'))), sprintf('Object unidad_tematica does not exist (%s).', $request->getParameter('id')));
    $unidad_tematica->borrado=1;
    $unidad_tematica->activo=0;
    $unidad_tematica->save();
    $this->getUser()->setFlash('mensajeSuceso','Unidad Temática eliminada.');

    $this->redirect('default/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $unidad_tematica = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Unidad Temática guardada.');

      $this->redirect('default/index');
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
  
  public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($request->getParameter('id'))), sprintf('Object unidad_tematica does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $unidad_tematica->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $unidad_tematica->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $unidad_tematica->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $unidad_tematica->save();
    
//    $this->getUser()->setFlash('mensajeSuceso','Cambio realizado.');

//        $this->redirect('default/index');
    }
  
}
