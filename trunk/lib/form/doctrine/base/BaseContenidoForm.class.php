<?php

/**
 * Contenido form base class.
 *
 * @method Contenido getObject() Returns the current form's model object
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContenidoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'idUsuario'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'idCategoriaContenido' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CategoriaContenido'), 'add_empty' => false)),
      'titulo'               => new sfWidgetFormInputText(),
      'contenido'            => new sfWidgetFormInputText(),
      'borrado'              => new sfWidgetFormInputCheckbox(),
      'activo'               => new sfWidgetFormInputCheckbox(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idUsuario'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'idCategoriaContenido' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CategoriaContenido'))),
      'titulo'               => new sfValidatorString(array('max_length' => 255)),
      'contenido'            => new sfValidatorPass(),
      'borrado'              => new sfValidatorBoolean(array('required' => false)),
      'activo'               => new sfValidatorBoolean(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('contenido[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contenido';
  }

}
