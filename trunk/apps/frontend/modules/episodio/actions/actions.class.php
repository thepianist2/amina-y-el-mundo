<?php

/**
 * episodio actions.
 *
 * @package    amina
 * @subpackage episodio
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class episodioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->episodios = Doctrine_Core::getTable('Episodio')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EpisodioForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EpisodioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id'))), sprintf('Object episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new EpisodioForm($episodio);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id'))), sprintf('Object episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new EpisodioForm($episodio);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($episodio = Doctrine_Core::getTable('Episodio')->find(array($request->getParameter('id'))), sprintf('Object episodio does not exist (%s).', $request->getParameter('id')));
    $episodio->delete();

    $this->redirect('episodio/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $episodio = $form->save();

      $this->redirect('episodio/edit?id='.$episodio->getId());
    }
  }
}
