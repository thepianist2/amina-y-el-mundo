<?php

/**
 * producto actions.
 *
 * @package    amina
 * @subpackage producto
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Producto')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');
     
        $this->productos = new sfDoctrinePager('Producto', 6);
	$this->productos->setQuery($q);   	
        $this->productos->setPage($this->getRequestParameter('page',1));
	$this->productos->init();
        //route del paginado
        $this->action = '@producto_index_page';          
  }
  
    public function executeShow(sfWebRequest $request)
  {
    $this->producto = Doctrine_Core::getTable('Producto')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->producto);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProductoForm();
  }

  
      public function executeBuscar(sfWebRequest $request)
  {
        
        $query = $request->getParameter('query');
       $q = Doctrine_Core::getTable('Producto')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.nombre LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%')  
      ->orderBy('a.created_at ASC'); 
     
        $this->productos = new sfDoctrinePager('Producto', 6);
	$this->productos->setQuery($q);   	
        $this->productos->setPage($this->getRequestParameter('page',1));
	$this->productos->init();
        //route del paginado
         $this->action = 'producto/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProductoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($producto = Doctrine_Core::getTable('Producto')->find(array($request->getParameter('id'))), sprintf('Object producto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProductoForm($producto);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($producto = Doctrine_Core::getTable('Producto')->find(array($request->getParameter('id'))), sprintf('Object producto does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProductoForm($producto);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($producto = Doctrine_Core::getTable('Producto')->find(array($request->getParameter('id'))), sprintf('Object producto does not exist (%s).', $request->getParameter('id')));
    $producto->borrado=1;
    $producto->activo=0;
    $producto->save();
    $this->getUser()->setFlash('mensajeSuceso','Producto eliminado.');

    $this->redirect('producto/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $producto = $form->save();

      $this->redirect('fotografiaProducto/index?idProducto='.$producto->id);
      $this->getUser()->setFlash('mensajeTerminado','Producto guardado.');
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
  
    
  public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($producto = Doctrine_Core::getTable('Producto')->find(array($request->getParameter('id'))), sprintf('Object producto does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $producto->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $producto->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $producto->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $producto->save();
    
//    $this->getUser()->setFlash('mensajeSuceso','Cambio realizado.');

//        $this->redirect('default/index');
    }
}
