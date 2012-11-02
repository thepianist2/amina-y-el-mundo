<?php

/**
 * Contacto form.
 *
 * @package    amina
 * @subpackage form
 * @author     Allel software
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContactoForm extends BaseContactoForm
{
  public function configure()
  {                                               //quitar campos que no usaremos
      unset($this['created_at'], $this['updated_at'], $this['borrado']);   
        
        $this->setWidget('documento', new sfWidgetFormInputFile());  
      $this->setWidget('nombre', new sfWidgetFormInputText(array(), array('size' =>50)));  
      $this->setWidget('email', new sfWidgetFormInputText(array(), array('size' =>50)));  
      $this->setWidget('telefono', new sfWidgetFormInputText(array(), array('size' =>50)));  
        $this->setWidget('empresa', new sfWidgetFormInputText(array(), array('size' =>50)));  
    
              //campo contenido
        $this->setWidget('comentario', new sfWidgetFormTextareaTinyMCE(array(             
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
        
            $this->setValidator('comentario',new sfValidatorString(array('required' => true)));
            $this->setValidator('email',new sfValidatorEmail());
            $this->setValidator('telefono', new sfValidatorInteger(array('required' => false))); 
            
                //Validacion de campos
        $this->validatorSchema['documento'] = new sfValidatorFile(array(
                    'required' => false,
                    'path' => sfConfig::get('sf_upload_dir').'/documentos',
                    'mime_types' => array('application/msword','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'text/x-setext',
                    'text/html',
                    'application/pdf',
                    'application/x-pdf','application/msexcel',
                    'application/vnd.ms-excel'),
                ));  
        
          $this->widgetSchema->setLabels(array(
  'nombre'    => 'Nombre *',
  'email'   => 'Email *',
  'telefono'   => 'Telefono',              
  'comentario' => 'Comentario *',  
  'documento' => 'Documento'
));  
          
 $this->validatorSchema['nombre']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
 $this->validatorSchema['email']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
 $this->validatorSchema['telefono']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
 $this->validatorSchema['comentario']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));
 $this->validatorSchema['documento']->setMessages(array('required' => 'Campo Obligatorio.','invalid' => 'Campo inválido'));


  }
}
