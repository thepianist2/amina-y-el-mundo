<?php

/**
 * Contacto form base class.
 *
 * @method Contacto getObject() Returns the current form's model object
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContactoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'telefono'   => new sfWidgetFormInputText(),
      'empresa'    => new sfWidgetFormInputText(),
      'comentario' => new sfWidgetFormTextarea(),
      'documento'  => new sfWidgetFormTextarea(),
      'borrado'    => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 100)),
      'email'      => new sfValidatorString(array('max_length' => 100)),
      'telefono'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'empresa'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'comentario' => new sfValidatorString(),
      'documento'  => new sfValidatorString(array('required' => false)),
      'borrado'    => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('contacto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contacto';
  }

}
