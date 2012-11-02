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
             if($request->hasParameter('idContenidoPadresYProfesores')){
       $this->getUser()->setAttribute('idContenidoPadresYProfesores', $request->getParameter('idContenidoPadresYProfesores'));
        }
              //si se pasa la unidad tematica se muestra solo los episodio de el, sino todos
        if($request->hasParameter('idContenidoPadresYProfesores') or $this->getUser()->hasAttribute('idContenidoPadresYProfesores')){                  
    $this->fotografia_contenido_padres_y_profesoress = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')
      ->createQuery('a')
      ->where('a.idContenidoPadresYProfesores =?',$this->getUser()->getAttribute('idContenidoPadresYProfesores')) 
      ->execute();
        }
        
    $this->form = new FotografiaContenidoPadresYProfesoresForm();
    $this->form->setDefault('idContenidoPadresYProfesores', $this->getUser()->getAttribute('idContenidoPadresYProfesores'));
    
    $this->idContenidoPadresYProfesores=$this->getUser()->getAttribute('idContenidoPadresYProfesores');
      
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FotografiaContenidoPadresYProfesoresForm();
    $this->form->setDefault('idContenidoPadresYProfesores', $this->getUser()->getAttribute('idContenidoPadresYProfesores'));    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->fotografia_contenido_padres_y_profesoress = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')
      ->createQuery('a')
      ->where('a.idContenidoPadresYProfesores =?',$this->getUser()->getAttribute('idContenidoPadresYProfesores')) 
      ->execute();    
  
    $this->form = new FotografiaContenidoPadresYProfesoresForm();
    $this->form->setDefault('idContenidoPadresYProfesores', $this->getUser()->getAttribute('idContenidoPadresYProfesores'));    
    $this->idContenidoPadresYProfesores=$this->getUser()->getAttribute('idContenidoPadresYProfesores');
    $this->processForm($request, $this->form);

    $this->setTemplate('index');
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
    $this->forward404Unless($fotografia_contenido_padres_y_profesores = Doctrine_Core::getTable('FotografiaContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object fotografia_contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $fotografia_contenido_padres_y_profesores->delete();

    $this->redirect('fotografiaContenidoPadresYProfesores/index?idContenidoPadresYProfesores='.$fotografia_contenido_padres_y_profesores->getIdContenidoPadresYProfesores());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $fotografia_contenido_padres_y_profesores = $form->save();
      $this->getUser()->setFlash('mensajeSuceso','Imágen guardada.');
      $this->redirect('fotografiaContenidoPadresYProfesores/index?idContenidoPadresYProfesores='.$fotografia_contenido_padres_y_profesores->getIdContenidoPadresYProfesores());
    }
  }
}
