<?php

/**
 * elExperto actions.
 *
 * @package    amina
 * @subpackage elExperto
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class elExpertoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->el_expertos = Doctrine_Core::getTable('ElExperto')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ElExpertoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ElExpertoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id'))), sprintf('Object el_experto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ElExpertoForm($el_experto);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id'))), sprintf('Object el_experto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ElExpertoForm($el_experto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($el_experto = Doctrine_Core::getTable('ElExperto')->find(array($request->getParameter('id'))), sprintf('Object el_experto does not exist (%s).', $request->getParameter('id')));
    $el_experto->delete();

    $this->redirect('elExperto/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $el_experto = $form->save();

      $this->redirect('elExperto/edit?id='.$el_experto->getId());
    }
  }
}
