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
    $this->programa_colegios = Doctrine_Core::getTable('ProgramaColegio')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProgramaColegioForm();
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
    $request->checkCSRFProtection();

    $this->forward404Unless($programa_colegio = Doctrine_Core::getTable('ProgramaColegio')->find(array($request->getParameter('id'))), sprintf('Object programa_colegio does not exist (%s).', $request->getParameter('id')));
    $programa_colegio->delete();

    $this->redirect('programaColegio/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $programa_colegio = $form->save();

      $this->redirect('programaColegio/edit?id='.$programa_colegio->getId());
    }
  }
}
