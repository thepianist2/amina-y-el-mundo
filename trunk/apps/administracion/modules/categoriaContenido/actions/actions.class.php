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
    $q = Doctrine_Core::getTable('CategoriaContenido')
      ->createQuery('a')
      ->orderBy('a.texto DESC');
          

        $this->categoria_contenidos = new sfDoctrinePager('CategoriaContenido', 6);
	$this->categoria_contenidos->setQuery($q);   	
        $this->categoria_contenidos->setPage($this->getRequestParameter('page',1));
	$this->categoria_contenidos->init();
        //route del paginado
        $this->action = '@categoriaContenido_index_page';    
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
  
          public function executeBuscar(sfWebRequest $request)
  {
        $query = $request->getParameter('query');
             $q = Doctrine_Core::getTable('CategoriaContenido')
      ->createQuery('a')
      ->where('a.texto LIKE ?','%'.$query.'%') 
      ->orderBy('a.texto ASC');         

        $this->categoria_contenidos = new sfDoctrinePager('CategoriaContenido', 6);
	$this->categoria_contenidos->setQuery($q);   	
        $this->categoria_contenidos->setPage($this->getRequestParameter('page',1));
	$this->categoria_contenidos->init();

        //route del paginado
         $this->action = 'categoriaContenido/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
  }
  
    public function executeShow(sfWebRequest $request)
  {
    $this->categoria_contenido = Doctrine_Core::getTable('CategoriaContenido')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->categoria_contenido);
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
    $this->forward404Unless($categoria_contenido = Doctrine_Core::getTable('CategoriaContenido')->find(array($request->getParameter('id'))), sprintf('Object categoria_contenido does not exist (%s).', $request->getParameter('id')));
    $categoria_contenido->delete();

    $this->redirect('categoriaContenido/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    $errorExiste=false;
    $valores = $request->getParameter($form->getName());
    $texto = $valores['texto'];
        if($form->getObject()->isNew() or $form->getObject()->texto != $valores['texto'])
        {
            if(Doctrine_Core::getTable('CategoriaContenido')->verificarExisteNombreCategoria($texto))
            {
                 $errorExiste=true;
            }
        }
        
    if ($form->isValid() && $errorExiste==false)
    {
      $categoria_contenido = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Categoria de contenido guardada.');
      $this->redirect('categoriaContenido/index');
    }else{
        if($errorExiste){
             $this->getUser()->setFlash('mensajeErrorGrave','Esta categoria ya existe, seleccione otro nombre');
        }else{
             $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados.');
        } 
    }
  }
}
