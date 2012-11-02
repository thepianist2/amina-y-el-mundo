<?php

/**
 * ContenidoPadresYProfesores filter form base class.
 *
 * @package    amina
 * @subpackage filter
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContenidoPadresYProfesoresFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idEpisodio'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Episodio'), 'add_empty' => true)),
      'titulo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contenido'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'enlaceVideo'       => new sfWidgetFormFilterInput(),
      'soloAccesoPremium' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'soloAccesoLogado'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'borrado'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'activo'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'idEpisodio'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Episodio'), 'column' => 'id')),
      'titulo'            => new sfValidatorPass(array('required' => false)),
      'contenido'         => new sfValidatorPass(array('required' => false)),
      'enlaceVideo'       => new sfValidatorPass(array('required' => false)),
      'soloAccesoPremium' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'soloAccesoLogado'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'borrado'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'activo'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contenido_padres_y_profesores_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContenidoPadresYProfesores';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'idEpisodio'        => 'ForeignKey',
      'titulo'            => 'Text',
      'contenido'         => 'Text',
      'enlaceVideo'       => 'Text',
      'soloAccesoPremium' => 'Boolean',
      'soloAccesoLogado'  => 'Boolean',
      'borrado'           => 'Boolean',
      'activo'            => 'Boolean',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
