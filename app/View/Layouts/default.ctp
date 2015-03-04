<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __( 'eelITESM: Sistema de examenes en linea ITESM');
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<html>
<head>
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php

    echo $this->Html->css('normalize');
    echo $this->Html->css('foundation.min');
    /*echo $this->Html->css('foundation');*/
    echo $this->Html->css('app');
    
    /* Custom CSS */
    echo $this->Html->css('custom');
    /* End Custom CSS */

    

    /* Custom Fonts */
    echo $this->Html->css('accessibility_foundicons');
    echo $this->Html->css('general_foundicons');
    echo $this->Html->css('general_enclosed_foundicons');
    echo $this->Html->css('social_foundicons'); 
    echo $this->Html->css('browser-icons');
    echo $this->Html->css('font-awesome.min');  
    echo $this->Html->css('multi-select'); 
    /* End Custom Fonts */

  ?>

  <style>

    /* Place all stylesheet code here */
    @font-face {
      font-family: 'LeagueGothic';
      src: url('<?php echo $this->webroot; ?>fonts/lg/League_Gothic-webfont.eot');
      src: url('<?php echo $this->webroot; ?>fonts/lg/League_Gothic-webfont.eot?#iefix') format('embedded-opentype'),
           url('<?php echo $this->webroot; ?>fonts/lg/League_Gothic-webfont.woff') format('woff'),
           url('<?php echo $this->webroot; ?>fonts/lg/League_Gothic-webfont.ttf') format('truetype'),
           url('<?php echo $this->webroot; ?>fonts/lg/League_Gothic-webfont.svg#LeagueGothic') format('svg');
      font-weight: normal;
      font-style: normal;
    }
    @font-face {
      font-family: 'GeneralFoundicons';
      src: url('<?php echo $this->webroot; ?>fonts/general_foundicons.eot');
      src: url('<?php echo $this->webroot; ?>fonts/general_foundicons.eot?#iefix') format('embedded-opentype'),
           url('<?php echo $this->webroot; ?>fonts/general_foundicons.woff') format('woff'),
           url('<?php echo $this->webroot; ?>fonts/general_foundicons.ttf') format('truetype'),
           url('<?php echo $this->webroot; ?>fonts/general_foundicons.svg#GeneralFoundicons') format('svg');
      font-weight: normal;
      font-style: normal;
    }
    @font-face {
      font-family: 'GeneralEnclosedFoundicons';
      src: url('<?php echo $this->webroot; ?>fonts/general_enclosed_foundicons.eot');
      src: url('<?php echo $this->webroot; ?>fonts/general_enclosed_foundicons.eot?#iefix') format('embedded-opentype'),
           url('<?php echo $this->webroot; ?>fonts/general_enclosed_foundicons.woff') format('woff'),
           url('<?php echo $this->webroot; ?>fonts/general_enclosed_foundicons.ttf') format('truetype'),
           url('<?php echo $this->webroot; ?>fonts/general_enclosed_foundicons.svg#GeneralEnclosedFoundicons') format('svg');
      font-weight: normal;
      font-style: normal;
    }
    @font-face {
      font-family: 'SocialFoundicons';
      src: url('<?php echo $this->webroot; ?>fonts/social_foundicons.eot');
      src: url('<?php echo $this->webroot; ?>fonts/social_foundicons.eot?#iefix') format('embedded-opentype'),
           url('<?php echo $this->webroot; ?>fonts/social_foundicons.woff') format('woff'),
           url('<?php echo $this->webroot; ?>fonts/social_foundicons.ttf') format('truetype'),
           url('<?php echo $this->webroot; ?>fonts/social_foundicons.svg#SocialFoundicons') format('svg');
      font-weight: normal;
      font-style: normal;
    }
    @font-face {
      font-family: 'AccessibilityFoundicons';
      src: url('<?php echo $this->webroot; ?>fonts/accessibility_foundicons.eot');
      src: url('<?php echo $this->webroot; ?>fonts/accessibility_foundicons.eot?#iefix') format('embedded-opentype'),
           url('<?php echo $this->webroot; ?>fonts/accessibility_foundicons.woff') format('woff'),
           url('<?php echo $this->webroot; ?>fonts/accessibility_foundicons.ttf') format('truetype'),
           url('<?php echo $this->webroot; ?>fonts/accessibility_foundicons.svg#AccessibilityFoundicons') format('svg');
      font-weight: normal;
      font-style: normal;
    }

    [class*="social foundicon-"]:before {
      font-family: "SocialFoundicons";
    }
    [class*="general foundicon-"]:before {
      font-family: "GeneralFoundicons";
    }
    [class*="gen-enclosed foundicon-"]:before {
      font-family: "GeneralEnclosedFoundicons";
    }
    [class*="accessibility foundicon-"]:before {
      font-family: "AccessibilityFoundicons";
    }

    .error label, label.error {
      background: none repeat scroll 0 0 #C60F13;
      clear: both;
      color: #FFFFFF;
      margin-top: -15px;
      padding: 5px;
  }
  </style>

</head>
<body>
  
  <!-- Foundation Stuff -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <?php echo $this->Html->script('vendor/custom.modernizr'); ?>
    <?php echo $this->Html->script('validation/jquery.validate'); ?>
    <?php echo $this->Html->script('vendor/jquery.scrollTo-min'); ?>
    <?php echo $this->Html->script('vendor/jquery.form.min'); ?>
    <?php echo $this->Html->script('vendor/jquery.multi-select'); ?>
    <?php echo $this->Html->script('vendor/jquery.quicksearch'); ?>
    <?php echo $this->Html->script('system/table'); ?>
    <?php //echo $this->Html->script('tinymce4/tinymce.min'); ?>
    <?php echo $this->Html->script('tinymce3/tiny_mce'); ?>

    <script type="text/javascript">
      jQuery.extend(jQuery.validator.messages, {
        required: "<?php echo __('Este campo no puede estar vacio'); ?>",
        remote: "<?php echo __('Tienes que corregir este campo'); ?>",
        email: "<?php echo __('Escribe una dirección de correo valida'); ?>",
        url: "<?php echo __('Escribe una direccion URL valida'); ?>",
        date: "<?php echo __('Escribe una fecha valida'); ?>",
        dateISO: "<?php echo __('Escribe una fecha valida (ISO)'); ?>",
        number: "<?php echo __('Escribe una numero valido'); ?>",
        digits: "<?php echo __('Escribe solo numeros'); ?>",
        creditcard: "<?php echo __('Escribe una numero de tarjeta de credito valido'); ?>",
        equalTo: "<?php echo __('Las contraseñas no coinciden'); ?>",
        accept: "<?php echo __('Escribe un valor con una extensión valida'); ?>",
        maxlength: jQuery.validator.format("Tienes que escribir menos de {0} caracteres"),
        minlength: jQuery.validator.format("Tienes que escribir almenos {0} caracteres"),
        rangelength: jQuery.validator.format("Escribe un valor entre {0} y {1} caracteres de longitud"),
        range: jQuery.validator.format("Escribe un valor entre {0} y {1}"),
        max: jQuery.validator.format("Escribe un valor menor o igual a {0}"),
        min: jQuery.validator.format("Escribe un valor mayor o igual a {0}")
    });
    </script>

    <script type="text/javascript">
      document.write('<script src=' +
      ('__proto__' in {} ? '<?php echo $this->webroot . ('js/vendor/zepto'); ?>' : '<?php echo $this->webroot . ('js/vendor/jquery'); ?>') +
      '.js><\/script>')
    </script>

    <?php echo $this->Html->script('foundation.min'); ?>


    <script type="text/javascript">
      tinyMCE.init({
          mode : "textareas",
          editor_deselector : "textarea-no-styles",
          theme : "advanced",
          theme_advanced_resizing : true,
          theme_advanced_resize_horizontal : false,
          theme_advanced_buttons1 : "fontselect,fontsizeselect,formatselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,pasteword,undo,redo,justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,backcolor,separator,hr,link,unlink,jbimages,image,media,table,code,separator,asciisvg,tiny_mce_wiris_formulaEditor,preview,fullscreen",
          theme_advanced_buttons2 : "",
          theme_advanced_buttons3 : "",
          theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
          theme_advanced_toolbar_location : "top",
          theme_advanced_toolbar_align : "left",
          theme_advanced_statusbar_location : "bottom",
          plugins : 'asciimath,asciisvg,table,inlinepopups,media,tiny_mce_wiris,preview,fullscreen,paste,jbimages',              
          content_css : "css/content.css",
          relative_urls: false,
          AScgiloc : '<?php echo $this->webroot; ?>php/svgimg.php',
          ASdloc : '<?php echo $this->webroot; ?>js/tinymce3/plugins/asciisvg/js/d.svg',
      });
      /* END TinyMCE 3 */

      $(function() {
        $(document).foundation();
      });
    </script>
  <!-- End Foundation Stuff-->

  <!-- NAV BAR -->
  <?php echo $this->element('menu'); ?>
  <!-- /NAV BAR -

  <!-- The Web Content -->
  <div class="row">
      <div class="large-12 columns">
        <?php echo $this->element('foundation-modal'); ?>
        <?php echo $this->fetch('content'); ?>
      </div>
  </div>

  <?php echo $this->element('sql_dump'); ?> 
  <!-- End The Web Content -->

</body>
</html>

