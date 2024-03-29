<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('VideoContenidoPadresYProfesores', 'doctrine');

/**
 * BaseVideoContenidoPadresYProfesores
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idContenidoPadresYProfesores
 * @property text $descripcion
 * @property text $enlaceVideo
 * @property boolean $soloAccesoPremium
 * @property boolean $soloAccesoLogado
 * @property boolean $borrado
 * @property boolean $activo
 * @property ContenidoPadresYProfesores $ContenidoPadresYProfesores
 * 
 * @method integer                         getIdContenidoPadresYProfesores() Returns the current record's "idContenidoPadresYProfesores" value
 * @method text                            getDescripcion()                  Returns the current record's "descripcion" value
 * @method text                            getEnlaceVideo()                  Returns the current record's "enlaceVideo" value
 * @method boolean                         getSoloAccesoPremium()            Returns the current record's "soloAccesoPremium" value
 * @method boolean                         getSoloAccesoLogado()             Returns the current record's "soloAccesoLogado" value
 * @method boolean                         getBorrado()                      Returns the current record's "borrado" value
 * @method boolean                         getActivo()                       Returns the current record's "activo" value
 * @method ContenidoPadresYProfesores      getContenidoPadresYProfesores()   Returns the current record's "ContenidoPadresYProfesores" value
 * @method VideoContenidoPadresYProfesores setIdContenidoPadresYProfesores() Sets the current record's "idContenidoPadresYProfesores" value
 * @method VideoContenidoPadresYProfesores setDescripcion()                  Sets the current record's "descripcion" value
 * @method VideoContenidoPadresYProfesores setEnlaceVideo()                  Sets the current record's "enlaceVideo" value
 * @method VideoContenidoPadresYProfesores setSoloAccesoPremium()            Sets the current record's "soloAccesoPremium" value
 * @method VideoContenidoPadresYProfesores setSoloAccesoLogado()             Sets the current record's "soloAccesoLogado" value
 * @method VideoContenidoPadresYProfesores setBorrado()                      Sets the current record's "borrado" value
 * @method VideoContenidoPadresYProfesores setActivo()                       Sets the current record's "activo" value
 * @method VideoContenidoPadresYProfesores setContenidoPadresYProfesores()   Sets the current record's "ContenidoPadresYProfesores" value
 * 
 * @package    amina
 * @subpackage model
 * @author     Allel software
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVideoContenidoPadresYProfesores extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('videoContenidoPadresYProfesores');
        $this->hasColumn('idContenidoPadresYProfesores', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('descripcion', 'text', null, array(
             'type' => 'text',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('enlaceVideo', 'text', null, array(
             'type' => 'text',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('soloAccesoPremium', 'boolean', null, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'default' => '0',
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('soloAccesoLogado', 'boolean', null, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'default' => '0',
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('borrado', 'boolean', null, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'default' => '0',
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('activo', 'boolean', null, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'default' => '1',
             'autoincrement' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ContenidoPadresYProfesores', array(
             'local' => 'idContenidoPadresYProfesores',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}