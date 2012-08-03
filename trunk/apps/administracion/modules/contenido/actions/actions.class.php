<?php

/**
 * contenido actions.
 *
 * @package    amina
 * @subpackage contenido
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contenidoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->contenidos = Doctrine_Core::getTable('Contenido')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ContenidoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoForm($contenido);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoForm($contenido);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($contenido = Doctrine_Core::getTable('Contenido')->find(array($request->getParameter('id'))), sprintf('Object contenido does not exist (%s).', $request->getParameter('id')));
    $contenido->delete();

    $this->redirect('contenido/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contenido = $form->save();

      $this->redirect('contenido/edit?id='.$contenido->getId());
    }
  }
}
