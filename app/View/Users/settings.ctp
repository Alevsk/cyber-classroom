
<div class="row collapse">
	<h2><?php echo __('Editando datos del usuario'); ?></h2>
	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('User', array('class' => 'custom', 'id' => 'UserCreateForm', 'url' => array('action' => 'settings'))); ?>
		<?php echo $this->Form->input('User.id',array('value' => $user['User']['id'],'required' => '', 'label' => false,'placeholder' => __('Escriba un nombre completo',true))); ?>

		<div class="row">
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-user"></i> <?php echo __('Nombre completo'); ?></span>
				<?php echo $this->Form->input('User.name',array('disabled' => true, 'value' => $user['User']['name'], 'required' => '', 'label' => false,'placeholder' => __('Escriba un nombre completo',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-envelope"></i> <?php echo __('Email'); ?></span>
				<?php echo $this->Form->input('User.email',array('disabled' => true, 'value' => $user['User']['email'], 'required' => '', 'label' => false,'placeholder' => __('Escriba un email valido',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-users"></i> <?php echo __('Tipo de usuario'); ?></span>
				<select name="data[User][group_id]" class="" id="UserGroupId" disabled>
					<?php foreach($groups as $group) { ?>
						<?php if($group['Group']['id'] == $user['User']['group_id']) { ?>
							<option value="<?php echo $group['Group']['id']; ?>" selected><?php echo $group['Group']['name']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $group['Group']['id']; ?>"><?php echo $group['Group']['name']; ?></option>
						<?php } ?>						
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-user"></i> <?php echo __('Matrícula'); ?></span>
				<?php echo $this->Form->input('User.username',array('disabled' => true, 'value' => $user['User']['username'], 'required' => '', 'label' => false,'placeholder' => __('Escriba una matrícula',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-lock"></i> <?php echo __('Contraseña'); ?></span>
				<?php echo $this->Form->input('User.password',array('id' => 'UserPassword','type' => 'password', 'label' => false,'placeholder' => __('Escriba una contraseña',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-lock"></i> <?php echo __('Repita la contraseña'); ?></span>
				<?php echo $this->Form->input('User.re-password',array('id' => 'UserRePassword', 'type' => 'password', 'label' => false,'placeholder' => __('Escriba una contraseña',true))); ?>
			</div>
		</div>

		<div class="row">
			<?php echo $this->Form->submit(__('Crear',true),array('class' => 'button')); ?>
		</div>
		
		<?php echo $this->Form->end(); ?>
	</div>

</div>

<script>
	$(document).ready(function(){ 
     	$('#UserCreateForm').validate({
        	errorClass: 'error',
        	rules: {
				"data[User][password]": {
					required: true,
					equalTo: "#UserRePassword"
				},
				"data[User][re-password]": {
					required: true,
	            	equalTo: "#UserPassword"
				}
        	}
      	});
	});
</script>