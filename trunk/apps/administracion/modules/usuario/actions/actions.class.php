<?php
//buscador action, y verificar funciona todo
/**
 * usuario actions.
 *
 * @package    amina
 * @subpackage usuario
 * @author     Allel software
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usuarioActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
        $q = Doctrine_Core::getTable('sfGuardUser')
      ->createQuery('a')
      ->where('a.borrado = ?',0)
      ->orderBy('a.created_at DESC');
     
        $this->sf_guard_users = new sfDoctrinePager('sfGuardUser', 6);
	$this->sf_guard_users->setQuery($q);   	
        $this->sf_guard_users->setPage($this->getRequestParameter('page',1));
	$this->sf_guard_users->init();
        //route del paginado
        $this->action = '@usuario_index_page';      
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new sfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
  
      public function executeBuscar(sfWebRequest $request)
  {
        
        $query = $request->getParameter('query');
       $q = Doctrine_Core::getTable('sfGuardUser')
      ->createQuery('a')
      ->where('a.borrado = 0 AND a.username LIKE ?','%'.$query.'%')
      ->orWhere('a.borrado = 0 AND a.first_name LIKE ?','%'.$query.'%')  
      ->orWhere('a.borrado = 0 AND a.last_name LIKE ?','%'.$query.'%')         
          
      ->orderBy('a.created_at ASC'); 
     
        $this->sf_guard_users = new sfDoctrinePager('sfGuardUser', 6);
	$this->sf_guard_users->setQuery($q);   	
        $this->sf_guard_users->setPage($this->getRequestParameter('page',1));
	$this->sf_guard_users->init();
        //route del paginado
         $this->action = 'usuario/buscar';
        
        $this->query = $query;
        
        $this->setTemplate('index');
     
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserFormEdit($sf_guard_user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserFormEdit($sf_guard_user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
  
      public function executeShow(sfWebRequest $request)
  {
    $this->sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->sf_guard_user);
  }

  public function executeDelete(sfWebRequest $request)
  {

    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $sf_guard_user->borrado=1;
    $sf_guard_user->is_active=0;
    $sf_guard_user->save();

    $this->redirect('usuario/index');
  }
  
  
    public function executeRedirectVerUsuario(sfWebRequest $request)
  {

    $this->usuario = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id')));
    $this->usuario->borrado=0;
    $this->usuario->save();
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
   $errorExiste=false;
    $errorExisteEmail=false;
   $errorExisteUserName=false;
   $usuarioSiExiste=null;
   $valores = $request->getParameter($form->getName());
   $username = $valores['username'];
   $email = $valores['email_address'];
   
        if($form->getObject()->isNew() or $form->getObject()->username != $valores['username'] or $form->getObject()->email_address != $valores['email_address'] )
        {
            if(Doctrine_Core::getTable('sfGuardUser')->verificarExisteEmail($email))
            {
                 $errorExisteEmail=true;
                 $errorExiste=true;
                 $usuarioSiExiste= Doctrine_Core::getTable('sfGuardUser')->getByEmail($email);
                 
            }
                 
            if(Doctrine_Core::getTable('sfGuardUser')->verificarExisteUserName($username))
            {
                 $errorExisteUserName=true;
                 $errorExiste=true;
                 $usuarioSiExiste= Doctrine_Core::getTable('sfGuardUser')->getByUserName($username);       
                 
            }          
                
        }
    
    if ($form->isValid() && $errorExiste==false)
    {
      $sf_guard_user = $form->save();
      $this->getUser()->setFlash('mensajeTerminado','Usuario guardado.');
      $this->redirect('usuario/index');
    }else{
       if($errorExiste){
           
           if($errorExisteEmail){

               
          $this->getUser()->setFlash('mensajeErrorGrave','Este correo ya existe');
        
           }
           
           if($errorExisteUserName){
          $this->getUser()->setFlash('mensajeErrorGrave','Este nombre de usuario ya existe');
               
           }

               $this->redirect('usuario/redirectVerUsuario?id='.$usuarioSiExiste->id);
//           
//            $this->getUser()->setFlash('mensajeErrorGrave','Este usuario ya existe, será te hemos redireccionado al usuario existente');
//            $this->getUser()->setFlash('mensajeSuceso','Edita este usuario existente o vuelve atrás si quieres crear otro usuario');
            
//            $this->redirect('usuario/show?id='.$usuarioSiExiste->id);
            

        }else{
            $this->getUser()->setFlash('mensajeErrorGrave','Porfavor, revise los campos marcados.');
        }  
    }
  }
  
  
    public function executeSwitchValor(sfWebRequest $request){
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sfGuardUser does not exist (%s).', $request->getParameter('id')));
    if($request->getParameter('variable')=='activo'){
        $sf_guard_user->is_active=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='superAdmin'){
        $sf_guard_user->is_super_admin=$request->getParameter('valor');
    }
    if($request->getParameter('variable')=='soloPremium'){
        $sf_guard_user->esPremium=$request->getParameter('valor');
    }
    
    $sf_guard_user->save();
    
//    $this->getUser()->setFlash('mensajeSuceso','Cambio realizado.');

//        $this->redirect('usuario/index');
    }
}
