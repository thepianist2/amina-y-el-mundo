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
    $this->unidad_tematicas = Doctrine_Core::getTable('UnidadTematica')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->unidad_tematica);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UnidadTematicaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UnidadTematicaForm();

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
    $request->checkCSRFProtection();

    $this->forward404Unless($unidad_tematica = Doctrine_Core::getTable('UnidadTematica')->find(array($request->getParameter('id'))), sprintf('Object unidad_tematica does not exist (%s).', $request->getParameter('id')));
    $unidad_tematica->delete();

    $this->redirect('default/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $unidad_tematica = $form->save();

      $this->redirect('default/edit?id='.$unidad_tematica->getId());
    }
  }
}
