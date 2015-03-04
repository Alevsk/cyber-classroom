<div class="row collapse">
	<h2><?php echo __('Editar material'); ?></h2>

	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('Resource', array('class' => 'custom', 'id' => 'ResourceCreateFormEdit', 'url' => array('action' => 'create'))); ?>
		<?php echo $this->Form->input('Resource.id',array('type' => 'hidden','label' => false, 'value' => $resource['Resource']['id'],'placeholder' => __('Escriba un nombre para este documento',true))); ?>
		<div class="row collapse">
			<div class="large-4 columns left">
				<span class="label"><?php echo __('Nombre del recurso'); ?></span>
				<?php echo $this->Form->input('Resource.name',array('required' => '', 'type' => 'text','label' => false, 'value' => $resource['Resource']['name'],'placeholder' => __('Escriba un nombre para este documento',true))); ?>
			</div>
			<div class="large-8 columns left">
				<span class="label"><?php echo __('Enlace del documento'); ?></span>
				<?php echo $this->Form->input('Resource.url',array('required' => '', 'type' => 'text','label' => false, 'value' => $resource['Resource']['url'], 'placeholder' => __('Escriba una url valida',true))); ?>
			</div>
		</div>
		<div class="row collapse">
			<?php echo $this->Form->submit(__('Editar',true),array('class' => 'button small')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<script>
	$(document).ready(function(){

     	$('#ResourceCreateFormEdit').validate({
        	errorClass: 'error',
        	rules: {
          		"data[Resource][name]": {
            		required: true,
          		},
          		"data[Resource][url]": {
          			required: true,
          			url: true,
          		}
        	}
      	});
      	
    });
</script>
<!-- Jquery Form Validation Code -->