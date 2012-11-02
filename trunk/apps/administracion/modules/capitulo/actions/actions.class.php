<?php

/**
 * capitulo actions.
 *
 * @package    amina
 * @subpackage capitulo
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class capituloActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
       if($request->hasParameter('idEpisodio')){
       $this->getUser()->setAttribute('idEpisodio', $request->getParameter('idEpisodio'));
        }
        
        //si se pasa la unidad tematica se muestra solo los episodio de el, sino todos
        if($request->hasParameter('idEpisodio') or $this->getUser()->hasAttribute('idEpisodio')){
    $q = Doctrine_Core::getTable('Capitulo')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->andWhere('a.idEpisodio = ?',$this->getUser()->getAttribute('idEpisodio'))            
      ->orderBy('a.created_at DESC');
      $this->episodio = Doctrine_Core::getTable('Episodio')->find(array($this->getUser()->getAttribute('idEpisodio')));

        }else{
      $q = Doctrine_Core::getTable('Capitulo')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              
        }
        

        $this->capitulos = new sfDoctrinePager('Capitulo', 6);
	$this->capitulos->setQuery($q);   	
        $this->capitulos->setPage($this->getRequestParameter('page',1));
	$this->capitulos->init();
        //route del paginado
        $this->action = '@capitulo_index_page';        
      
  }
  
  
    public function executeIndexTodos(sfWebRequest $request)
  {

       $this->getUser()->setAttribute('idEpisodio', null);

      $q = Doctrine_Core::getTable('Capitulo')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              

        $this->capitulos = new sfDoctrinePager('Capitulo', 6);
	$this->capitulos->setQuery($q);   	
        $this->capitulos->setPage($this->getRequestParameter('page',1));
	$this->capitulos->init();
        //route del paginado
        $this->action = '@capitulo_index_page';  
        $this->setTemplate('index');
      
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CapituloForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));

  }
  
     public function executeNewSinIdEpisodio(sfWebRequest $request)
  {
    $this->form = new CapituloForm2();
    
  }
  
    public function executeCreate2(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CapituloForm2();   

    $this->processForm($request, $this->form);

    $this->setTemplate('newSinIdEpisodio');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CapituloForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));
    

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id'))), sprintf('Object capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new CapituloForm($capitulo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id'))), sprintf('Object capitulo does not exist (%s).', $request->getParameter('id')));
    $this->form = new CapituloForm($capitulo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
      public function executeShow(sfWebRequest $request)
  {
    $this->capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->capitulo);
  }

  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id'))), sprintf('Object capitulo does not exist (%s).', $request->getParameter('id')));
    $capitulo->borrado=1;
    $capitulo->activo=0;
    $capitulo->save();
    $this->getUser()->setFlash('mensajeSuceso','Capitulo eliminado.');

    $this->redirect('capitulo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $capitulo = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Capitulo Guardado.');

      $this->redirect('capitulo/index?idCapitulo='.$capitulo->getIdEpisodio());
    }else{
      $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');

    }
  }
  
      public function executeBuscar(sfWebRequest $request)
  {
                $query = $request->getParameter('query');
          if($this->getUser()->hasAttribute('idEpisodio')){

       $q = Doctrine_Core::getTable('Capitulo')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.idEpisodio = '.$this->getUser()->getAttribute('idEpisodio').'  AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.idEpisodio = '.$this->getUser()->getAttribute('idEpisodio').'  AND a.descripcion LIKE ?','%'.$query.'%')                             
      ->orderBy('a.created_at ASC'); 
          }else{
             $q = Doctrine_Core::getTable('Capitulo')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.descripcion LIKE ?','%'.$query.'%')                       
      ->orderBy('a.created_at ASC');         
          }
        $this->capitulos = new sfDoctrinePager('Capitulo', 6);
	$this->capitulos->setQuery($q);   	
        $this->capitulos->setPage($this->getRequestParameter('page',1));
	$this->capitulos->init();
        //route del paginado
         $this->action = 'episodio/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }
  
    
    public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($capitulo = Doctrine_Core::getTable('Capitulo')->find(array($request->getParameter('id'))), sprintf('Object capitulo does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $capitulo->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $capitulo->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $capitulo->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $capitulo->save();
    
    }
  
}
