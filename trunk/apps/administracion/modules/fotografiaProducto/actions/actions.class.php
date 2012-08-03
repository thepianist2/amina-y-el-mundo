<?php

/**
 * fotografiaProducto actions.
 *
 * @package    amina
 * @subpackage fotografiaProducto
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fotografiaProductoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->fotografia_productos = Doctrine_Core::getTable('FotografiaProducto')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FotografiaProductoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FotografiaProductoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($fotografia_producto = Doctrine_Core::getTable('FotografiaProducto')->find(array($request->getParameter('id'))), sprintf('Object fotografia_producto does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaProductoForm($fotografia_producto);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($fotografia_producto = Doctrine_Core::getTable('FotografiaProducto')->find(array($request->getParameter('id'))), sprintf('Object fotografia_producto does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaProductoForm($fotografia_producto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($fotografia_producto = Doctrine_Core::getTable('FotografiaProducto')->find(array($request->getParameter('id'))), sprintf('Object fotografia_producto does not exist (%s).', $request->getParameter('id')));
    $fotografia_producto->delete();

    $this->redirect('fotografiaProducto/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fotografia_producto = $form->save();

      $this->redirect('fotografiaProducto/edit?id='.$fotografia_producto->getId());
    }
  }
}
