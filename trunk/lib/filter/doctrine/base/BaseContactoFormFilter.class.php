<?php

/**
 * Contacto filter form base class.
 *
 * @package    amina
 * @subpackage filter
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContactoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono'   => new sfWidgetFormFilterInput(),
      'empresa'    => new sfWidgetFormFilterInput(),
      'comentario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'documento'  => new sfWidgetFormFilterInput(),
      'borrado'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'     => new sfValidatorPass(array('required' => false)),
      'email'      => new sfValidatorPass(array('required' => false)),
      'telefono'   => new sfValidatorPass(array('required' => false)),
      'empresa'    => new sfValidatorPass(array('required' => false)),
      'comentario' => new sfValidatorPass(array('required' => false)),
      'documento'  => new sfValidatorPass(array('required' => false)),
      'borrado'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contacto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contacto';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'nombre'     => 'Text',
      'email'      => 'Text',
      'telefono'   => 'Text',
      'empresa'    => 'Text',
      'comentario' => 'Text',
      'documento'  => 'Text',
      'borrado'    => 'Boolean',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
