<?php

/**
 * fotografiaCapitulo actions.
 *
 * @package    amina
 * @subpackage fotografiaCapitulo
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fotografiaCapituloActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->fotografia_capitulos = Doctrine_Core::getTable('FotografiaCapitulo')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FotografiaCapituloForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FotografiaCapituloForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($fotografia_capitulo = Doctrine_Core::getTable('FotografiaCapitulo')->find(array($request->getParameter('id'))), sprintf('Object fotografia_capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaCapituloForm($fotografia_capitulo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($fotografia_capitulo = Doctrine_Core::getTable('FotografiaCapitulo')->find(array($request->getParameter('id'))), sprintf('Object fotografia_capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new FotografiaCapituloForm($fotografia_capitulo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($fotografia_capitulo = Doctrine_Core::getTable('FotografiaCapitulo')->find(array($request->getParameter('id'))), sprintf('Object fotografia_capitulo does not exist (%s).', $request->getParameter('id')));
    $fotografia_capitulo->delete();

    $this->redirect('fotografiaCapitulo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fotografia_capitulo = $form->save();

      $this->redirect('fotografiaCapitulo/edit?id='.$fotografia_capitulo->getId());
    }
  }
}
