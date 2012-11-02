<?php

/**
 * JuegoEpisodio form.
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JuegoEpisodioForm2 extends BaseJuegoEpisodioForm
{
  public function configure()
  {
                                                            //quitar campos que no usaremos
      unset($this['created_at'], $this['updated_at'], $this['borrado'], $this['activo']);
    

      $this->setValidator('idEpisodio', new sfValidatorInteger());  
      
                                           //campo tipo de rango salario
        $tipo = Doctrine::getTable('Episodio')->getLista();
        $tipo[null]='--Seleccione el Episodio--';
        asort($tipo);
        $this->setWidget('idEpisodio', new sfWidgetFormSelect(array('choices' => $tipo)));
      
      
      
      $this->setWidget('titulo', new sfWidgetFormInputText(array(), array('size' =>50)));   
      $this->widgetSchema['archivoFlash'] = new sfWidgetFormInputFile();
      //Validacion de campos
        $this->validatorSchema['archivoFlash'] = new sfValidatorFile(array(
                    'required' => true,
                    'path' => sfConfig::get('sf_upload_dir').'/juegoEpisodio',
                    'mime_types' => array('application/x-shockwave-flash'),
            
                ));
        
                        //campo descripcion
        $this->setWidget('descripcion', new sfWidgetFormTextareaTinyMCE(array(             
                    'width' => 500,
                    'height' => 350,
                    'config' =>           
                    'language : "es",'.
                    'file_browser_callback: "sfMediaBrowserWindowManager.tinymceCallback",'.
                    'plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",' .
                    'theme_advanced_buttons1 : "styleselect,formatselect,fontselect,fontsizeselect,|,styleprops,|,del,ins,attribs",'.
                    'theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,cleanup,code",'.
                    'theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr",'.
                    'theme_advanced_buttons4 : "visualchars,nonbreaking,blockquote,pagebreak,|,insertfile,insertimage,|,insertdate,inserttime,preview,|,forecolor,backcolor ,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,| ",'
                    ))); 
        
          $this->setValidator('descripcion',new sfValidatorString(array('required' => true))); 
              
          $this->widgetSchema->setLabels(array(
  'titulo'   => 'Título *',
  'descripcion'   => 'Descripción',                     
  'soloAccesoPremium' => 'Solo acceso a premium ?',
  'soloAccesoLogado' => 'Solo acceso a logueado ?' ,
  'archivoFlash' => 'Archivo flash del juego *'  
));  
          
          
$this->validatorSchema['titulo']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
$this->validatorSchema['descripcion']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));

$this->validatorSchema['archivoFlash']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido debe ser archivo flash .swf','mime_types'=>'Campo inválido debe ser archivo flash .swf'));
     
      
  }
}
