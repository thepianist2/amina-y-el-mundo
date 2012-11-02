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
             if($request->hasParameter('idProducto')){
       $this->getUser()->setAttribute('idProducto', $request->getParameter('idProducto'));
        }
              //si se pasa la unidad tematica se muestra solo los episodio de el, sino todos
        if($request->hasParameter('idProducto') or $this->getUser()->hasAttribute('idProducto')){                  
    $this->fotografia_productos = Doctrine_Core::getTable('FotografiaProducto')
      ->createQuery('a')
      ->where('a.idProducto =?',$this->getUser()->getAttribute('idProducto')) 
      ->execute();
        }
        
    $this->form = new FotografiaProductoForm();
    $this->form->setDefault('idProducto', $this->getUser()->getAttribute('idProducto'));
    
    $this->idProducto=$this->getUser()->getAttribute('idProducto');

  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FotografiaProductoForm();
    $this->form->setDefault('idProducto', $this->getUser()->getAttribute('idProducto'));    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->fotografia_productos = Doctrine_Core::getTable('FotografiaProducto')
      ->createQuery('a')
      ->where('a.idProducto =?',$this->getUser()->getAttribute('idProducto')) 
      ->execute();
    
    $this->form = new FotografiaProductoForm();
    $this->form->setDefault('idProducto', $this->getUser()->getAttribute('idProducto'));
    $this->idProducto=$this->getUser()->getAttribute('idProducto');

    $this->processForm($request, $this->form);

    $this->setTemplate('index');
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
    $this->forward404Unless($fotografia_producto = Doctrine_Core::getTable('FotografiaProducto')->find(array($request->getParameter('id'))), sprintf('Object fotografia_producto does not exist (%s).', $request->getParameter('id')));
    $fotografia_producto->delete();
    
    $this->redirect('fotografiaProducto/index?idProducto='.$this->getUser()->getAttribute('idProducto'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fotografia_producto = $form->save();
      $this->getUser()->setFlash('mensajeSuceso','Imágen guardada.');
      $this->redirect('fotografiaProducto/index?idProducto='.$this->getUser()->getAttribute('idProducto'));
    }
  }
}
