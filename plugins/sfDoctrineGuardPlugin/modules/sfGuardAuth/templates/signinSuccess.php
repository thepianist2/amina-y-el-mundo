<?php use_helper('I18N') ?>

<h1 style="margin-left: 330px;"><?php echo __('Signin', null, 'sf_guard') ?></h1>

<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>