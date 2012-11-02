<?php

/**
 * Configuracion form base class.
 *
 * @method Configuracion getObject() Returns the current form's model object
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConfiguracionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'variable'    => new sfWidgetFormInputText(),
      'valor'       => new sfWidgetFormTextarea(),
      'descripcion' => new sfWidgetFormTextarea(),
      'tipo'        => new sfWidgetFormChoice(array('choices' => array('imagen' => 'imagen', 'variable' => 'variable', 'mensaje' => 'mensaje'))),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'variable'    => new sfValidatorString(array('max_length' => 255)),
      'valor'       => new sfValidatorString(),
      'descripcion' => new sfValidatorString(array('required' => false)),
      'tipo'        => new sfValidatorChoice(array('choices' => array(0 => 'imagen', 1 => 'variable', 2 => 'mensaje'))),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('configuracion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Configuracion';
  }

}
