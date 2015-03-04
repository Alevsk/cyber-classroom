<div class="row collapse">
	<h2><?php echo __('Alta masiva de usuarios'); ?></h2>

	<div class="panel row collapse">
		<p>
			Formato de datos aceptado:
		</p>
		<p>
			<span style="font-weight:bold !important;font-size:20px !important;">matricula,nombre completo,email,contraseña</span>
		</p>
	</div>

	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('User', array('class' => 'custom', 'url' => array('action' => 'loadStudents'))); ?>
		<div class="row">
			<div class="large-12 columns left">
				<span class="label"><i class="fa fa-users"></i> <?php echo __('Tipo de usuario'); ?></span>
				<select name="data[User][group_id]" class="" id="UserGroupId">
					<?php foreach($groups as $group) { ?>
						<option value="<?php echo $group['Group']['id']; ?>"><?php echo $group['Group']['name']; ?></option>
					<?php } ?>
				</select>
			</div>	
		</div>
	    <div class="row">
	      <div class="large-12 columns">
	        <span class="label"><?php echo __('Cargar datos de usuarios'); ?></span>
	        <?php echo $this->Form->textarea('User.students',array('class' => 'textarea-no-styles students-loader',  'required' => '', 'label' => false,'placeholder' => __('Formato (matricula,nombre,email,contraseña)',true))); ?>
	      </div>
	    </div>
	    <div class="row">
	    	<div class="large-2 columns left">
	    		<?php echo $this->Form->submit(__('Procesar',true),array('class' => 'button')); ?>
	    	</div>    	
	    </div>
	    <?php echo $this->Form->end(); ?>
	</div>	
</div>
<!-- Jquery Form Validation Code -->
<script>
	$(document).ready(function(){

     	$('#UserLoadStudentsForm').validate({
        	errorClass: 'error',
        	rules: {
				"data[User][students]": {
	            	required: true
				}
        	}
      	});

	});
</script>
<!-- Jquery Form Validation Code -->