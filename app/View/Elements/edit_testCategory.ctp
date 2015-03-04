<div class="row collapse">
	<h2><?php echo $category['TestCategory']['name']; ?> </h2>

	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('TestCategory', array('class' => 'custom','id' => 'TestCategoryEditForm', 'url' => array('action' => 'create'))); ?>
		<?php echo $this->Form->input('TestCategory.id',array('value' => $category['TestCategory']['id'], 'type' => 'hidden')); ?>
		<div class="row collapse">
			
			<div class="large-4 columns left">
				<span class="label"><?php echo __('Nombre de la categoría'); ?></span>
				<?php echo htmlspecialchars_decode($this->Form->input('TestCategory.name',array('value' => $category['TestCategory']['name'],'required' => '', 'label' => false,'placeholder' => __('Escriba un nombre para su categoría',true)))); ?>
			</div>
		</div>
		<div class="row collapse">
			<?php echo $this->Form->submit(__('Guardar',true),array('class' => 'button small')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	
</div>

<script>
	$(document).ready(function(){ 
     	$('#TestCategoryEditForm').validate({
        	errorClass: 'error',
        	rules: {
          		"data[TestCategory][name]": {
            	required: true,
          		}
        	}
      	});
	});
</script>