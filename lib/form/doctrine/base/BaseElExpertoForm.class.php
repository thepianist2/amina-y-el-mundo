<?php

/**
 * ElExperto form base class.
 *
 * @method ElExperto getObject() Returns the current form's model object
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseElExpertoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'idEpisodio'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Episodio'), 'add_empty' => false)),
      'enlaceVideo'       => new sfWidgetFormInputText(),
      'descripcion'       => new sfWidgetFormInputText(),
      'soloAccesoPremium' => new sfWidgetFormInputCheckbox(),
      'soloAccesoLogado'  => new sfWidgetFormInputCheckbox(),
      'borrado'           => new sfWidgetFormInputCheckbox(),
      'activo'            => new sfWidgetFormInputCheckbox(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idEpisodio'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Episodio'))),
      'enlaceVideo'       => new sfValidatorPass(),
      'descripcion'       => new sfValidatorPass(),
      'soloAccesoPremium' => new sfValidatorBoolean(array('required' => false)),
      'soloAccesoLogado'  => new sfValidatorBoolean(array('required' => false)),
      'borrado'           => new sfValidatorBoolean(array('required' => false)),
      'activo'            => new sfValidatorBoolean(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('el_experto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ElExperto';
  }

}
