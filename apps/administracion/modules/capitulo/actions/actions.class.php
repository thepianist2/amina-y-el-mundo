<?php

/**
 * capitulo actions.
 *
 * @package    amina
 * @subpackage capitulo
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class capituloActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->capitulos = Doctrine_Core::getTable('Capitulo')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CapituloForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CapituloForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id'))), sprintf('Object capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new CapituloForm($capitulo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id'))), sprintf('Object capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new CapituloForm($capitulo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id'))), sprintf('Object capitulo does not exist (%s).', $request->getParameter('id')));
    $capitulo->delete();

    $this->redirect('capitulo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $capitulo = $form->save();

      $this->redirect('capitulo/edit?id='.$capitulo->getId());
    }
  }
}
