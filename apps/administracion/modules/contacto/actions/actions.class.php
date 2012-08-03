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
    $this->contactos = Doctrine_Core::getTable('Contacto')
      ->createQuery('a')
      ->execute();
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
    $request->checkCSRFProtection();

    $this->forward404Unless($contacto = Doctrine_Core::getTable('Contacto')->find(array($request->getParameter('id'))), sprintf('Object contacto does not exist (%s).', $request->getParameter('id')));
    $contacto->delete();

    $this->redirect('contacto/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contacto = $form->save();

      $this->redirect('contacto/edit?id='.$contacto->getId());
    }
  }
}
