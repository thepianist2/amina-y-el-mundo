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
    $this->configuracions = Doctrine_Core::getTable('Configuracion')
      ->createQuery('a')
      ->execute();
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
    $request->checkCSRFProtection();

    $this->forward404Unless($configuracion = Doctrine_Core::getTable('Configuracion')->find(array($request->getParameter('id'))), sprintf('Object configuracion does not exist (%s).', $request->getParameter('id')));
    $configuracion->delete();

    $this->redirect('configuracion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $configuracion = $form->save();

      $this->redirect('configuracion/edit?id='.$configuracion->getId());
    }
  }
}
