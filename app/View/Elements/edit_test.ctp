<div class="row collapse">
	<h2><?php echo $test['Test']['name']; ?></h2>
	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('Test', array('class' => 'custom', 'id' => 'TestEditForm', 'url' => array('action' => 'create'))); ?>
		<?php echo $this->Form->input('Test.id',array('value' => $test['Test']['id'], 'type' => 'hidden')); ?>

		<div class="row">
			<div class="large-8 columns left">
				<span class="label"><?php echo __('Nombre del examen'); ?></span>
				<?php echo htmlspecialchars_decode($this->Form->text('Test.name',array('value' => $test['Test']['name'],'required' => '', 'label' => false,'placeholder' => __('Escriba un nombre para el examen',true)))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><?php echo __('Categoria del examen'); ?></span>
				<select name="data[Test][test_category_id]" class="" id="TestTestCategoryIdEdit">
					<?php foreach($testCategories as $testCategory) { ?>
						<?php if($testCategory['TestCategory']['id'] == $test['Test']['test_category_id']) { ?>
							<option value="<?php echo $testCategory['TestCategory']['id']; ?>" selected><?php echo $testCategory['TestCategory']['name']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $testCategory['TestCategory']['id']; ?>"><?php echo $testCategory['TestCategory']['name']; ?></option>
						<?php } ?>
						
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div id="extraOptions">
			<fieldset>
				<div class="row">
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Fecha de inicio'); ?></span>
						<?php echo $this->Form->text('Test.start_date',array('id' => 'TestStartDateEdit', 'value' => $test['Test']['start_date'] ,'label' => false,'placeholder' => __('Dia en que comienza el examen',true))); ?>
					</div>
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Fecha de finalización'); ?></span>
						<?php echo $this->Form->text('Test.end_date',array('id' => 'TestEndDateEdit', 'value' => $test['Test']['end_date'], 'label' => false,'placeholder' => __('Dia en que finaliza el examen',true))); ?>
					</div>
				</div>

				<div class="row">
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Hora de inicio'); ?></span>
						<?php echo $this->Form->text('Test.start_time',array('value' => $test['Test']['start_time'], 'timeFormat' => '24', 'type' => 'time', 'label' => false,'placeholder' => __('El examen comienza',true))); ?>
					</div>
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Hora de finalizacíón'); ?></span>
						<?php echo $this->Form->text('Test.end_time',array('value' => $test['Test']['end_time'], 'timeFormat' => '24', 'type' => 'time', 'label' => false,'placeholder' => __('El examen termina',true))); ?>
					</div>
				</div>
		</fieldset>
		</div>

		<div class="row">
			<?php echo $this->Form->submit(__('Guardar',true),array('class' => 'button')); ?>
		</div>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<script>

	$( "#TestStartDateEdit" ).datepicker({
	  defaultDate: "+1w",
	  dateFormat: 'yy-mm-dd',
	  onClose: function( selectedDate ) {
	    $( "#TestEndDateEdit" ).datepicker( "option", "minDate", selectedDate );
	  }
	});
	$( "#TestEndDateEdit" ).datepicker({
	  defaultDate: "+1w",
	  dateFormat: 'yy-mm-dd',
	  onClose: function( selectedDate ) {
	    $( "#TestStartDateEdit" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});

	$('#TestEditForm').validate({
		errorClass: 'error',
		rules: {
	  		"data[Test][name]": {
	    	required: true,
	  		}
		}
	});

	Foundation.libs.forms.assemble();
</script>