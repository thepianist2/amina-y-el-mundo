<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Episodio', 'doctrine');

/**
 * BaseEpisodio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idUnidadTematica
 * @property string $titulo
 * @property text $descripcion
 * @property text $enlaceVideo
 * @property boolean $soloAccesoPremium
 * @property boolean $soloAccesoLogado
 * @property boolean $borrado
 * @property boolean $activo
 * @property UnidadTematica $UnidadTematica
 * @property Doctrine_Collection $JuegoEpisodio
 * @property Doctrine_Collection $ElExperto
 * @property Doctrine_Collection $Capitulo
 * @property Doctrine_Collection $ContenidoPadresYProfesores
 * 
 * @method integer             getIdUnidadTematica()           Returns the current record's "idUnidadTematica" value
 * @method string              getTitulo()                     Returns the current record's "titulo" value
 * @method text                getDescripcion()                Returns the current record's "descripcion" value
 * @method text                getEnlaceVideo()                Returns the current record's "enlaceVideo" value
 * @method boolean             getSoloAccesoPremium()          Returns the current record's "soloAccesoPremium" value
 * @method boolean             getSoloAccesoLogado()           Returns the current record's "soloAccesoLogado" value
 * @method boolean             getBorrado()                    Returns the current record's "borrado" value
 * @method boolean             getActivo()                     Returns the current record's "activo" value
 * @method UnidadTematica      getUnidadTematica()             Returns the current record's "UnidadTematica" value
 * @method Doctrine_Collection getJuegoEpisodio()              Returns the current record's "JuegoEpisodio" collection
 * @method Doctrine_Collection getElExperto()                  Returns the current record's "ElExperto" collection
 * @method Doctrine_Collection getCapitulo()                   Returns the current record's "Capitulo" collection
 * @method Doctrine_Collection getContenidoPadresYProfesores() Returns the current record's "ContenidoPadresYProfesores" collection
 * @method Episodio            setIdUnidadTematica()           Sets the current record's "idUnidadTematica" value
 * @method Episodio            setTitulo()                     Sets the current record's "titulo" value
 * @method Episodio            setDescripcion()                Sets the current record's "descripcion" value
 * @method Episodio            setEnlaceVideo()                Sets the current record's "enlaceVideo" value
 * @method Episodio            setSoloAccesoPremium()          Sets the current record's "soloAccesoPremium" value
 * @method Episodio            setSoloAccesoLogado()           Sets the current record's "soloAccesoLogado" value
 * @method Episodio            setBorrado()                    Sets the current record's "borrado" value
 * @method Episodio            setActivo()                     Sets the current record's "activo" value
 * @method Episodio            setUnidadTematica()             Sets the current record's "UnidadTematica" value
 * @method Episodio            setJuegoEpisodio()              Sets the current record's "JuegoEpisodio" collection
 * @method Episodio            setElExperto()                  Sets the current record's "ElExperto" collection
 * @method Episodio            setCapitulo()                   Sets the current record's "Capitulo" collection
 * @method Episodio            setContenidoPadresYProfesores() Sets the current record's "ContenidoPadresYProfesores" collection
 * 
 * @package    amina
 * @subpackage model
 * @author     Allel software
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEpisodio extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('episodio');
        $this->hasColumn('idUnidadTematica', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('titulo', 'string', 150, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 150,
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
             'notnull' => false,
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
        $this->hasOne('UnidadTematica', array(
             'local' => 'idUnidadTematica',
             'foreign' => 'id'));

        $this->hasMany('JuegoEpisodio', array(
             'local' => 'id',
             'foreign' => 'idEpisodio'));

        $this->hasMany('ElExperto', array(
             'local' => 'id',
             'foreign' => 'idEpisodio'));

        $this->hasMany('Capitulo', array(
             'local' => 'id',
             'foreign' => 'idEpisodio'));

        $this->hasMany('ContenidoPadresYProfesores', array(
             'local' => 'id',
             'foreign' => 'idEpisodio'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}