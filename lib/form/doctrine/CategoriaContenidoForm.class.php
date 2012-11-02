<?php

/**
 * CategoriaContenido form.
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoriaContenidoForm extends BaseCategoriaContenidoForm
{
  public function configure()
  {
                                                                  //quitar campos que no usaremos
      unset($this['created_at'], $this['updated_at'], $this['borrado'], $this['activo'], $this['imagen']);
      
      $this->setWidget('texto', new sfWidgetFormInputText(array(), array('size' =>50))); 
      $this->setValidator('texto',new sfValidatorString(array('required' => true)));     
                           $this->widgetSchema->setLabels(array(
  'texto'   => 'Nombre *',

));
                           
   $this->validatorSchema['texto']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));

  }
}
