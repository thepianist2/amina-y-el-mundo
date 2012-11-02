<?php

/**
 * contenidoPadresYProfesores actions.
 *
 * @package    amina
 * @subpackage contenidoPadresYProfesores
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contenidoPadresYProfesoresActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if($request->hasParameter('idEpisodio')){
       $this->getUser()->setAttribute('idEpisodio', $request->getParameter('idEpisodio'));
        }
                 //si se pasa el id episodio se muestran algunos no todos
    if($request->hasParameter('idEpisodio') or $this->getUser()->hasAttribute('idEpisodio')){ 
        $q = Doctrine_Core::getTable('ContenidoPadresYProfesores')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->andWhere('a.idEpisodio = ?',$this->getUser()->getAttribute('idEpisodio'))            
      ->orderBy('a.created_at DESC');
        
      $this->episodio = Doctrine_Core::getTable('Episodio')->find($this->getUser()->getAttribute('idEpisodio'));
     }else{
      $q = Doctrine_Core::getTable('ContenidoPadresYProfesores')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');              
        }
        

        $this->contenido_padres_y_profesoress = new sfDoctrinePager('ContenidoPadresYProfesores', 6);
	$this->contenido_padres_y_profesoress->setQuery($q);   	
        $this->contenido_padres_y_profesoress->setPage($this->getRequestParameter('page',1));
	$this->contenido_padres_y_profesoress->init();
        //route del paginado
        $this->action = '@contenidoPadresYProfesores_index_page';      
    
  }
  
  
      
      public function executeIndexTodos(sfWebRequest $request)
  {
       $this->getUser()->setAttribute('idEpisodio',null);
        

      $q = Doctrine_Core::getTable('ContenidoPadresYProfesores')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at ASC');              


        $this->contenido_padres_y_profesoress = new sfDoctrinePager('ContenidoPadresYProfesores', 6);
	$this->contenido_padres_y_profesoress->setQuery($q);   	
        $this->contenido_padres_y_profesoress->setPage($this->getRequestParameter('page',1));
	$this->contenido_padres_y_profesoress->init();
        //route del paginado
        $this->action = '@contenidoPadresYProfesores_index_page';   
        
        $this->setTemplate('index');
  }
  
          public function executeNewSinIdEpisodio(sfWebRequest $request)
  {
      $this->form = new ContenidoPadresYProfesoresForm2();
  }
  
          public function executeCreate2(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoPadresYProfesoresForm2();

    $this->processForm($request, $this->form);

    $this->setTemplate('newSinIdEpisodio');
  }
  

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ContenidoPadresYProfesoresForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContenidoPadresYProfesoresForm();
    $this->form->setDefault('idEpisodio', $this->getUser()->getAttribute('idEpisodio'));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoPadresYProfesoresForm($contenido_padres_y_profesores);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContenidoPadresYProfesoresForm($contenido_padres_y_profesores);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    $contenido_padres_y_profesores->borrado=1;
    $contenido_padres_y_profesores->activo=0;
    $contenido_padres_y_profesores->save();
    $this->getUser()->setFlash('mensajeSuceso','Contenido eliminado.');
    
    $this->redirect('contenidoPadresYProfesores/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $contenido_padres_y_profesores = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Contenido Guardado.');
      
      $this->redirect('fotografiaContenidoPadresYProfesores/index?idContenidoPadresYProfesores='.$contenido_padres_y_profesores->id);
    }else{    
        $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados que faltan.');  
    }
  }
  
    
        public function executeBuscar(sfWebRequest $request)
  {
        $query = $request->getParameter('query');
          if($this->getUser()->hasAttribute('idEpisodio')){

       $q = Doctrine_Core::getTable('ContenidoPadresYProfesores')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.idEpisodio = '.$this->getUser()->getAttribute('idEpisodio').' AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.idEpisodio = '.$this->getUser()->getAttribute('idEpisodio').' AND a.contenido LIKE ?','%'.$query.'%')          
      ->orderBy('a.created_at ASC'); 
          }else{
             $q = Doctrine_Core::getTable('ContenidoPadresYProfesores')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.titulo LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.contenido LIKE ?','%'.$query.'%') 
      ->orderBy('a.created_at ASC');         
          }
        $this->contenido_padres_y_profesoress = new sfDoctrinePager('ContenidoPadresYProfesores', 6);
	$this->contenido_padres_y_profesoress->setQuery($q);   	
        $this->contenido_padres_y_profesoress->setPage($this->getRequestParameter('page',1));
	$this->contenido_padres_y_profesoress->init();
        //route del paginado
         $this->action = 'contenidoPadresYProfesores/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
  }
  
  
      
        public function executeShow(sfWebRequest $request)
  {
    $this->contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->contenido_padres_y_profesores);
  }
  
  
      public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($contenido_padres_y_profesores = Doctrine_Core::getTable('ContenidoPadresYProfesores')->find(array($request->getParameter('id'))), sprintf('Object contenido_padres_y_profesores does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $contenido_padres_y_profesores->activo=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloLogado'){
        $contenido_padres_y_profesores->soloAccesoLogado=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $contenido_padres_y_profesores->soloAccesoPremium=$request->getParameter('valor');
    }
    
    $contenido_padres_y_profesores->save();
    
    }
  
  
}
