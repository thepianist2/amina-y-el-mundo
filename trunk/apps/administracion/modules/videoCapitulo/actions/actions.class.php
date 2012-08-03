<?php

/**
 * videoCapitulo actions.
 *
 * @package    amina
 * @subpackage videoCapitulo
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class videoCapituloActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->video_capitulos = Doctrine_Core::getTable('VideoCapitulo')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new VideoCapituloForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new VideoCapituloForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id'))), sprintf('Object video_capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new VideoCapituloForm($video_capitulo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id'))), sprintf('Object video_capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new VideoCapituloForm($video_capitulo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($video_capitulo = Doctrine_Core::getTable('VideoCapitulo')->find(array($request->getParameter('id'))), sprintf('Object video_capitulo does not exist (%s).', $request->getParameter('id')));
    $video_capitulo->delete();

    $this->redirect('videoCapitulo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $video_capitulo = $form->save();

      $this->redirect('videoCapitulo/edit?id='.$video_capitulo->getId());
    }
  }
}
