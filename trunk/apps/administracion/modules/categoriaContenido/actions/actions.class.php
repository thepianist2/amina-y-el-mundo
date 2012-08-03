<?php

/**
 * categoriaContenido actions.
 *
 * @package    amina
 * @subpackage categoriaContenido
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoriaContenidoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->categoria_contenidos = Doctrine_Core::getTable('CategoriaContenido')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CategoriaContenidoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CategoriaContenidoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($categoria_contenido = Doctrine_Core::getTable('CategoriaContenido')->find(array($request->getParameter('id'))), sprintf('Object categoria_contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new CategoriaContenidoForm($categoria_contenido);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($categoria_contenido = Doctrine_Core::getTable('CategoriaContenido')->find(array($request->getParameter('id'))), sprintf('Object categoria_contenido does not exist (%s).', $request->getParameter('id')));
    $this->form = new CategoriaContenidoForm($categoria_contenido);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($categoria_contenido = Doctrine_Core::getTable('CategoriaContenido')->find(array($request->getParameter('id'))), sprintf('Object categoria_contenido does not exist (%s).', $request->getParameter('id')));
    $categoria_contenido->delete();

    $this->redirect('categoriaContenido/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $categoria_contenido = $form->save();

      $this->redirect('categoriaContenido/edit?id='.$categoria_contenido->getId());
    }
  }
}
