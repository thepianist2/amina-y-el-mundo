<?php

/**
 * Episodio form base class.
 *
 * @method Episodio getObject() Returns the current form's model object
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEpisodioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'idUnidadTematica'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UnidadTematica'), 'add_empty' => false)),
      'titulo'            => new sfWidgetFormInputText(),
      'descripcion'       => new sfWidgetFormInputText(),
      'enlaceVideo'       => new sfWidgetFormInputText(),
      'soloAccesoPremium' => new sfWidgetFormInputCheckbox(),
      'soloAccesoLogado'  => new sfWidgetFormInputCheckbox(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idUnidadTematica'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UnidadTematica'))),
      'titulo'            => new sfValidatorString(array('max_length' => 150)),
      'descripcion'       => new sfValidatorPass(),
      'enlaceVideo'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'soloAccesoPremium' => new sfValidatorBoolean(array('required' => false)),
      'soloAccesoLogado'  => new sfValidatorBoolean(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('episodio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Episodio';
  }

}
