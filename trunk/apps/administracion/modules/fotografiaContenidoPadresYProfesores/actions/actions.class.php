<?php

/**
 * fotografiaContenidoPadresYProfesores actions.
 *
 * @package    amina
 * @subpackage fotografiaContenidoPadresYProfesores
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fotografiaContenidoPadresYProfesoresActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->fotografia_contenido_padres_y_profesoress = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FotografiaContenidoPadresYProfesoresForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FotografiaContenidoPadresYProfesoresForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($fotografia_contenido_padres_y_profesores = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object fotografia_contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaContenidoPadresYProfesoresForm($fotografia_contenido_padres_y_profesores);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($fotografia_contenido_padres_y_profesores = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object fotografia_contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaContenidoPadresYProfesoresForm($fotografia_contenido_padres_y_profesores);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($fotografia_contenido_padres_y_profesores = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object fotografia_contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $fotografia_contenido_padres_y_profesores->delete();

    $this->redirect('fotografiaContenidoPadresYProfesores/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fotografia_contenido_padres_y_profesores = $form->save();

      $this->redirect('fotografiaContenidoPadresYProfesores/edit?id='.$fotografia_contenido_padres_y_profesores->getId());
    }
  }
}
