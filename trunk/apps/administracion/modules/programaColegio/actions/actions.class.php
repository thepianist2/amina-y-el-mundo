<?php

/**
 * programaColegio actions.
 *
 * @package    amina
 * @subpackage programaColegio
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class programaColegioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
        $q = Doctrine_Core::getTable('ProgramaColegio')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');
     
        $this->programa_colegios = new sfDoctrinePager('ProgramaColegio', 6);
	$this->programa_colegios->setQuery($q);   	
        $this->programa_colegios->setPage($this->getRequestParameter('page',1));
	$this->programa_colegios->init();
        //route del paginado
        $this->action = '@programaColegio_index_page';   
    
  }
  
  
      public function executeShow(sfWebRequest $request)
  {
    $this->programa_colegio = Doctrine_Core::getTable('ProgramaColegio')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->programa_colegio);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProgramaColegioForm();
  }
  
  
    
      public function executeBuscar(sfWebRequest $request)
  {    
        $query = $request->getParameter('query');
       $q = Doctrine_Core::getTable('ProgramaColegio')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%')  
      ->orderBy('a.created_at ASC'); 
     
        $this->programa_colegios = new sfDoctrinePager('ProgramaColegio', 6);
	$this->programa_colegios->setQuery($q);   	
        $this->programa_colegios->setPage($this->getRequestParameter('page',1));
	$this->programa_colegios->init();
        //route del paginado
         $this->action = 'programaColegio/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index'); 
  }
  

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProgramaColegioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($programa_colegio = Doctrine_Core::getTable('ProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object programa_colegio does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProgramaColegioForm($programa_colegio);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($programa_colegio = Doctrine_Core::getTable('ProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object programa_colegio does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProgramaColegioForm($programa_colegio);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($programa_colegio = Doctrine_Core::getTable('ProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object programa_colegio does not exist (%s).', $request->getParameter('id')));
    $programa_colegio->borrado=1;
    $programa_colegio->activo=0;
    $programa_colegio->save();
    $this->getUser()->setFlash('mensajeSuceso','Programa de colegio eliminado.');  

    $this->redirect('programaColegio/index');
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $programa_colegio = $form->save();

      $this->redirect('fotografiaProgramaColegio/index?idProgramaColegio='.$programa_colegio->id);
      $this->getUser()->setFlash('mensajeTerminado','Programa de colegio guardado.');      
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
  
    public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($programa_colegio = Doctrine_Core::getTable('ProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object programa_colegio does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $programa_colegio->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $programa_colegio->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $programa_colegio->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $programa_colegio->save();
    
//    $this->getUser()->setFlash('mensajeSuceso','Cambio realizado.');

//        $this->redirect('default/index');
    }
  
  
}
