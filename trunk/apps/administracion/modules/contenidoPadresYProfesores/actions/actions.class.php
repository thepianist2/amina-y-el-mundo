<?php

/**
 * contenidoPadresYProfesores actions.
 *
 * @package    amina
 * @subpackage contenidoPadresYProfesores
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contenidoPadresYProfesoresActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->contenido_padres_y_profesoress = Doctrine_Core::getTable('ContenidoPadresYProfesores')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ContenidoPadresYProfesoresForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoPadresYProfesoresForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoPadresYProfesoresForm($contenido_padres_y_profesores);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoPadresYProfesoresForm($contenido_padres_y_profesores);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $contenido_padres_y_profesores->delete();

    $this->redirect('contenidoPadresYProfesores/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contenido_padres_y_profesores = $form->save();

      $this->redirect('contenidoPadresYProfesores/edit?id='.$contenido_padres_y_profesores->getId());
    }
  }
}
