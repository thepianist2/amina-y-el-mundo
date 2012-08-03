<?php

/**
 * juegoEpisodio actions.
 *
 * @package    amina
 * @subpackage juegoEpisodio
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class juegoEpisodioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->juego_episodios = Doctrine_Core::getTable('JuegoEpisodio')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new JuegoEpisodioForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JuegoEpisodioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id'))), sprintf('Object juego_episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new JuegoEpisodioForm($juego_episodio);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id'))), sprintf('Object juego_episodio does not exist (%s).', $request->getParameter('id')));
    $this->form = new JuegoEpisodioForm($juego_episodio);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($juego_episodio = Doctrine_Core::getTable('JuegoEpisodio')->find(array($request->getParameter('id'))), sprintf('Object juego_episodio does not exist (%s).', $request->getParameter('id')));
    $juego_episodio->delete();

    $this->redirect('juegoEpisodio/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $juego_episodio = $form->save();

      $this->redirect('juegoEpisodio/edit?id='.$juego_episodio->getId());
    }
  }
}
