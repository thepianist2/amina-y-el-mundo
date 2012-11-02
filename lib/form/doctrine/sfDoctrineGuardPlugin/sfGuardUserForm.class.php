<?php

/**
 * sfGuardUser form.
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
public function configure()
  {
                  //quitar campos que no usaremos
      unset($this['created_at'], $this['updated_at'], $this['last_login'], $this['algorithm'], $this['salt'], $this['is_active'], $this['groups_list'], $this['permissions_list']);
      
      $this->setWidget('password', new sfWidgetFormInputPassword());

    $this->widgetSchema['confirmaPass'] = new sfWidgetFormInputPassword();  
    $this->validatorSchema['confirmaPass'] = new sfValidatorPass();
    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('confirmaPass', '==', 'password', array(), array('invalid' => 'Las contraseñas no coinciden')));
      
    
                      $imagenPicFileSrc = '/uploads/'.$this->getObject()->imagenPerfil;
            $this->widgetSchema['imagenPerfil'] = new sfWidgetFormInputFileEditable(array('file_src'  => $imagenPicFileSrc, 
                                       'is_image' => true,
			            'edit_mode' => !$this->isNew(),
				    'delete_label' => 'Eliminar'),
                                    array('id' => 'imagenPerfil'));   
 
$this->validatorSchema['imagenPerfil'] = new sfValidatorFile(array(
                      'mime_types' => 'web_images',
    		      'path' => sfConfig::get('sf_upload_dir'),
		      'required' => false));
      
$this->validatorSchema['imagenPerfil_delete'] = new sfValidatorBoolean(); 

       $this->setValidator('email_address', new sfValidatorEmail()); 
    
      $this->widgetSchema->setLabels(array(
  'first_name'    => 'Nombre',
  'last_name'   => 'Apellidos',
  'email_address' => 'Email *',
  'username' => 'Usuario *',
  'password' => 'Contraseña *',
  'is_active' => 'Activo',   
  'is_super_admin' => 'Es Super administrador',        
  'groups_list' => 'Grupos',      
  'permissions_list' => 'Permisos',      
  'confirmaPass' => 'Repetir Contraseña *',  
  'imagenPerfil' => 'Imagen de perfil',   
  'esPremium' => 'Es usuario premium',          
));
      
      //mensajes
      
    $this->validatorSchema['email_address']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido, escriba bien su correo'));
    $this->validatorSchema['username']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));    
    $this->validatorSchema['password']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
  }
}
