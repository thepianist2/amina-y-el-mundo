<?php

/**
 * VideoContenidoPadresYProfesores form base class.
 *
 * @method VideoContenidoPadresYProfesores getObject() Returns the current form's model object
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVideoContenidoPadresYProfesoresForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'idContenidoPadresYProfesores' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContenidoPadresYProfesores'), 'add_empty' => false)),
      'descripcion'                  => new sfWidgetFormInputText(),
      'enlaceVideo'                  => new sfWidgetFormInputText(),
      'soloAccesoPremium'            => new sfWidgetFormInputCheckbox(),
      'soloAccesoLogado'             => new sfWidgetFormInputCheckbox(),
      'borrado'                      => new sfWidgetFormInputCheckbox(),
      'activo'                       => new sfWidgetFormInputCheckbox(),
      'created_at'                   => new sfWidgetFormDateTime(),
      'updated_at'                   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idContenidoPadresYProfesores' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContenidoPadresYProfesores'))),
      'descripcion'                  => new sfValidatorPass(),
      'enlaceVideo'                  => new sfValidatorPass(),
      'soloAccesoPremium'            => new sfValidatorBoolean(array('required' => false)),
      'soloAccesoLogado'             => new sfValidatorBoolean(array('required' => false)),
      'borrado'                      => new sfValidatorBoolean(array('required' => false)),
      'activo'                       => new sfValidatorBoolean(array('required' => false)),
      'created_at'                   => new sfValidatorDateTime(),
      'updated_at'                   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('video_contenido_padres_y_profesores[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VideoContenidoPadresYProfesores';
  }

}
