<?php

/**
 * fotografiaProgramaColegio actions.
 *
 * @package    amina
 * @subpackage fotografiaProgramaColegio
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fotografiaProgramaColegioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    
    if($request->hasParameter('idProgramaColegio')){
       $this->getUser()->setAttribute('idProgramaColegio', $request->getParameter('idProgramaColegio'));
        }
              //se le pasa el id del programa colegio correspondiente para que muestre sus fotos
        if($request->hasParameter('idProgramaColegio') or $this->getUser()->hasAttribute('idProgramaColegio')){                  
    $this->fotografia_programa_colegios = Doctrine_Core::getTable('FotografiaProgramaColegio')
      ->createQuery('a')
      ->where('a.idProgramaColegio =?',$this->getUser()->getAttribute('idProgramaColegio')) 
      ->execute();
        }
        
    $this->form = new FotografiaProgramaColegioForm();
    $this->form->setDefault('idProgramaColegio', $this->getUser()->getAttribute('idProgramaColegio'));
    
    $this->idProgramaColegio=$this->getUser()->getAttribute('idProgramaColegio');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FotografiaProgramaColegioForm();
    $this->form->setDefault('idProgramaColegio', $this->getUser()->getAttribute('idProgramaColegio'));    
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->fotografia_programa_colegios = Doctrine_Core::getTable('FotografiaProgramaColegio')
      ->createQuery('a')
      ->where('a.idProgramaColegio =?',$this->getUser()->getAttribute('idProgramaColegio')) 
      ->execute();
    
    $this->form = new FotografiaProgramaColegioForm();
    $this->form->setDefault('idProgramaColegio', $this->getUser()->getAttribute('idProgramaColegio'));        
    $this->idProgramaColegio=$this->getUser()->getAttribute('idProgramaColegio');

    $this->processForm($request, $this->form);

    $this->setTemplate('index');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($fotografia_programa_colegio = Doctrine_Core::getTable('FotografiaProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object fotografia_programa_colegio does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaProgramaColegioForm($fotografia_programa_colegio);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($fotografia_programa_colegio = Doctrine_Core::getTable('FotografiaProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object fotografia_programa_colegio does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaProgramaColegioForm($fotografia_programa_colegio);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($fotografia_programa_colegio = Doctrine_Core::getTable('FotografiaProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object fotografia_programa_colegio does not exist (%s).', $request->getParameter('id')));
    $fotografia_programa_colegio->delete();

    $this->redirect('fotografiaProgramaColegio/index?idProgramaColegio='.$fotografia_programa_colegio->getIdProgramaColegio());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fotografia_programa_colegio = $form->save();
      $this->getUser()->setFlash('mensajeSuceso','Imágen guardada.');
      $this->redirect('fotografiaProgramaColegio/index?idProgramaColegio='.$this->getUser()->getAttribute('idProgramaColegio'));
    }
  }
}
