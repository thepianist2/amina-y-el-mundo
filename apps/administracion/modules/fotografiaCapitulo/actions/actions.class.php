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
   
       if($request->hasParameter('idCapitulo')){
       $this->getUser()->setAttribute('idCapitulo', $request->getParameter('idCapitulo'));
        }
              //si se pasa el id capitulo se muestran todas las fotogradias de el, sino todas sin excepcion
        if($request->hasParameter('idCapitulo') or $this->getUser()->hasAttribute('idCapitulo')){                  
    $this->fotografia_capitulos = Doctrine_Core::getTable('FotografiaCapitulo')
      ->createQuery('a')
      ->where('a.idCapitulo =?',$this->getUser()->getAttribute('idCapitulo')) 
      ->execute();
        }
        
    $this->form = new FotografiaCapituloForm();
    $this->form->setDefault('idCapitulo', $this->getUser()->getAttribute('idCapitulo'));
    
    $this->idCapitulo=$this->getUser()->getAttribute('idCapitulo');

    
    
    
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FotografiaCapituloForm();
    $this->form->setDefault('idCapitulo', $this->getUser()->getAttribute('idCapitulo'));      
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
        $this->fotografia_capitulos = Doctrine_Core::getTable('FotografiaCapitulo')
      ->createQuery('a')
      ->where('a.idCapitulo =?',$this->getUser()->getAttribute('idCapitulo')) 
      ->execute();    

    $this->form = new FotografiaCapituloForm();
    $this->form->setDefault('idCapitulo', $this->getUser()->getAttribute('idCapitulo'));
    $this->idProducto=$this->getUser()->getAttribute('idCapitulo');
    
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
    $this->forward404Unless($fotografia_capitulo = Doctrine_Core::getTable('FotografiaCapitulo')->find(array($request->getParameter('id'))), sprintf('Object fotografia_capitulo does not exist (%s).', $request->getParameter('id')));
    $fotografia_capitulo->delete();
    
    $this->redirect('fotografiaCapitulo/index?id='.$this->getUser()->getAttribute('idCapitulo'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fotografia_capitulo = $form->save();
      $this->getUser()->setFlash('mensajeSuceso','Imágen guardada.');
      $this->redirect('fotografiaCapitulo/index?id='.$this->getUser()->getAttribute('idCapitulo'));
    }
  }
}
