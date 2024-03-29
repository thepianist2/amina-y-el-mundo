<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin
{
  /**
   * @see sfForm
   */
  public function configure()
  {
      
                $this->widgetSchema->setLabels(array(
  'username'    => 'Usuario o Email *',
  'password'   => 'Contraseña *',
  'remember' => 'Recordar', 
));  
          
          
$this->validatorSchema['username']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
$this->validatorSchema['password']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
      
      
      
      
  }
}
