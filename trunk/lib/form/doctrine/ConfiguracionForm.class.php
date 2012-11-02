<?php

/**
 * Configuracion form.
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConfiguracionForm extends BaseConfiguracionForm
{
  public function configure()
  {                                          //quitar campos que no usaremos
      unset($this['created_at'], $this['updated_at'], $this['borrado'], $this['activo']);
      
      $this->setWidget('variable', new sfWidgetFormInputText(array(), array('size' =>50, 'readonly'=>'readonly')));  
      $this->setWidget('valor', new sfWidgetFormInputText(array(), array('size' =>50, )));
      $this->setWidget('descripcion', new sfWidgetFormTextarea(array(),array('cols'=>60, 'rows'=>8)));
      
                $this->widgetSchema->setLabels(array(
  'variable'    => 'Variable *',
  'valor'   => 'Valor *',
  'descripcion'   => 'Descripción',                 
));  
                
 $this->validatorSchema['variable']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
$this->validatorSchema['valor']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
                     
  }
}
