<?php

/**
 * configuracion actions.
 *
 * @package    amina
 * @subpackage configuracion
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class configuracionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Configuracion')
      ->createQuery('a')
      ->orderBy('a.variable DESC');
     
        $this->configuracions = new sfDoctrinePager('Configuracion', 6);
	$this->configuracions->setQuery($q);   	
        $this->configuracions->setPage($this->getRequestParameter('page',1));
	$this->configuracions->init();
        //route del paginado
        $this->action = '@configuracion_index_page';      
  }
  
    public function executeShow(sfWebRequest $request)
  {
    $this->configuracion = Doctrine_Core::getTable('Configuracion')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->configuracion);
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ConfiguracionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ConfiguracionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($configuracion = Doctrine_Core::getTable('Configuracion')->find(array($request->getParameter('id'))), sprintf('Object configuracion does not exist (%s).', $request->getParameter('id')));
    $this->form = new ConfiguracionForm($configuracion);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($configuracion = Doctrine_Core::getTable('Configuracion')->find(array($request->getParameter('id'))), sprintf('Object configuracion does not exist (%s).', $request->getParameter('id')));
    $this->form = new ConfiguracionForm($configuracion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

//    $this->forward404Unless($configuracion = Doctrine_Core::getTable('Configuracion')->find(array($request->getParameter('id'))), sprintf('Object configuracion does not exist (%s).', $request->getParameter('id')));
//    $configuracion->borrado=1;
//    $configuracion->activo=0;
//    $configuracion->save();
//    $this->getUser()->setFlash('mensajeSuceso','Variable de configuración eliminada.');

//    $this->redirect('configuracion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $configuracion = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Variable de configuración guardada.');

       $this->redirect('configuracion/index');
    }else{
        $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');
    }
  }
}
