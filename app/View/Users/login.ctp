<script type="text/javascript">

  $(document).ready(function(){

      $('#UserLoginForm').validate({
        errorClass: 'error',
        rules: {
          "data[User][email]": {
            required: true,
            email: false,
          },
          "data[User][password]": {
            required: true,
          }
        }
      });

  });

</script>

<div class="large-12" style="margin-top:40px;">

  <div class="large-7 columns">
    <h3><?php echo __('Ultimas noticias'); ?></h3>

    <a class="twitter-timeline" href="https://twitter.com/Tecmtymorelia" data-widget-id="402171325512298496">Tweets por @Tecmtymorelia</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

  </div>

  <div class="large-5 columns">
     <h3 class="radius secondary label" style="font-weight:bold !important;font-size:20px !important;"><?php echo __('Acceso al sistema'); ?></h3>

     <div class="panel row collapse no-color-panel">

    <?php echo $this->Form->create('User',array('class' => 'custom')); ?>

      <div class="row">
        <div class="row">
          <div class="large-12 columns left">
              <span class="label" style="text-align:left;"><i class="fa fa-user"></i> <?php echo __('Email o Matrícula '); ?></span>
              <?php echo $this->Form->input('email',array('label' => false, 'required' => '', 'placeholder' => __('Escribe tu email o Matrícula',true))); ?>
          </div>
        </div>
        <div class="row">
          <div class="large-12 columns left">
              <span class="label" style="text-align:left;"><i class="fa fa-lock"></i> <?php echo __('Contraseña'); ?></span>
             <?php echo $this->Form->input('password',array('label' => false, 'required' => '', 'placeholder' => __('Escribe tu constraseña',true))); ?>
          </div>
        </div>    
        <div class="row collapse">
          <?php echo $this->Form->submit(__('Login',true),array('class' => 'button small success')); ?>
        </div>
      </div>

    <?php echo $this->Form->end(); ?>
  </div>
</div>

</div>

