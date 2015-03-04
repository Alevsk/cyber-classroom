<div class="contain-to-grid sticky" style="height:45px;">
  <nav class="top-bar">
    <ul class="title-area">
      <!-- Title Area -->
      <li class="name">
        <!--<h1><a href="<?php echo $this->Html->url('/'); ?>">LoL México <sup>beta</sup></a></h1>-->
        <h1><a href="<?php echo $this->Html->url('/'); ?>">eellTESM <sup>beta</sup></a></h1>
      </li>
      <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
      <!-- Left Nav Section -->
      <ul class="left">
        <li class="divider"></li>


        <?php if($this->Session->read('User.group_id') == 1) { ?>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'Users','action' => 'index')); ?>"><?php echo __('Usuarios'); ?></a></a></li> 
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'TestCategories','action' => 'index')); ?>"><?php echo __('Temas'); ?></a></a></li>
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'Resources','action' => 'index')); ?>"><?php echo __('Material de estudio'); ?></a></a></li>
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'all')); ?>"><?php echo __('Examenes'); ?></a></a></li>
              <li class="divider"></li>
        <?php } ?>

        <?php if($this->Session->read('User.group_id') == 2) { ?>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'index')); ?>"><?php echo __('Examenes'); ?></a></a></li> 
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'Questions','action' => 'all')); ?>"><?php echo __('Reactivos'); ?></a></a></li>
              <li class="divider"></li>
        <?php } ?>

        <?php if($this->Session->read('User.group_id') == 3) { ?>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'home')); ?>"><?php echo __('Examenes'); ?></a></a></li>
              <li class="divider"></li>
              <li><a href="<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'scores')); ?>"><?php echo __('Calificaciones'); ?></a></a></li>
              <li class="divider"></li>
        <?php } ?>

        <?php if($this->Session->check('User')) { ?>
          <li class="has-dropdown"><a href="#"><i class="accessibility foundicon-adult"></i> <?php echo $this->Session->read('User.username') ; ?></a>

            <ul class="dropdown">
              <!--<li><a href="<?php echo $this->Html->url(array('controller' => 'teams','action' => 'index')); ?>"><i class="general foundicon-people"></i> <?php echo __('Mis equipos'); ?></a></li>
              <li class="divider"></li>-->
              <li><a href="<?php echo $this->html->url(array('controller' => 'users', 'action' => 'settings')); ?>"><i class="general foundicon-settings"></i> <?php echo __('Configuración'); ?></a></li>
            </ul>
          </li>
          <li class="divider"></li>
        <?php } ?>
      </ul>

      <!-- Right Nav Section -->
      <ul class="right">
        <li class="divider show-for-small"></li>
        <li class="has-form">
          <?php if($this->Session->check('User')) { ?>
            <a class="button" href="<?php echo $this->Html->url(array('controller' => 'users','action' => 'logout'))?>"><i class="general foundicon-lock"></i> <?php echo __('Logout'); ?></a>
          <?php } else { ?>
            <a class="button" href="#" data-dropdown="login-form-menu"><?php echo __('Login'); ?></a>            
          <?php } ?>
        </li>
      </ul>
    </section>
  </nav>
</div>