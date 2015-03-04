<div class="row collapse">
	<h2><?php echo __('Crear un nuevo examen'); ?></h2>
	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('Test', array('class' => 'custom', 'id' => 'TestCreateForm', 'url' => array('action' => 'create'))); ?>

		<div class="row">
			<div class="large-8 columns left">
				<span class="label"><?php echo __('Nombre del examen'); ?></span>
				<?php echo $this->Form->text('Test.name',array('required' => '', 'label' => false,'placeholder' => __('Escriba un nombre para el examen',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><?php echo __('Categoria del examen'); ?></span>
				<select name="data[Test][test_category_id]" class="" id="TestTestCategoryId">
					<?php foreach($testCategoriesDisplay as $testCategory) { ?>
						<option value="<?php echo $testCategory['TestCategory']['id']; ?>"><?php echo $testCategory['TestCategory']['name']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="row moreOptions">
			<a href="javascript:void(0)" id="moreOptions" class="button small success"><i class="general foundicon-plus"></i> <?php echo __('Mostrar y ocultar configuracion extra'); ?></a>
		</div>
		
		<div id="theOptions">
			<fieldset>
				<div class="row">
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Fecha de inicio'); ?></span>
						<?php echo $this->Form->text('Test.start_date',array('label' => false,'placeholder' => __('Dia en que comienza el examen',true))); ?>
					</div>
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Fecha de finalización'); ?></span>
						<?php echo $this->Form->text('Test.end_date',array('label' => false,'placeholder' => __('Dia en que finaliza el examen',true))); ?>
					</div>
				</div>

				<div class="row">
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Hora de inicio'); ?></span>
						<?php echo $this->Form->text('Test.start_time',array('timeFormat' => '24', 'type' => 'time', 'label' => false,'placeholder' => __('El examen comienza',true))); ?>
					</div>
					<div class="large-4 columns left">
						<span class="label"><?php echo __('Hora de finalizacíón'); ?></span>
						<?php echo $this->Form->text('Test.end_time',array('timeFormat' => '24', 'type' => 'time', 'label' => false,'placeholder' => __('El examen termina',true))); ?>
					</div>
				</div>

				<div class="row">
					<h3 class="subheader"><?php echo __('Opciones de contenido auto generado'); ?></h3>
					<div class="large-7 columns left">
						<span class="label"><?php echo __('Seleccione los temas que desea utilizar'); ?></span>
						<select name="data[Test][Auto]" class="" id="TestAuto" data-customforms="disabled" multiple="multiple">
							<?php foreach($testCategories as $testCategory) { ?>
								<option value="<?php echo $testCategory['TestCategory']['id']; ?>" data-count="<?php echo $testCategory[0]['total_questions']; ?>" data-name="<?php echo $testCategory['TestCategory']['name']; ?>"><?php echo $testCategory['TestCategory']['name'] . " (" . $testCategory[0]['total_questions'] .  ")"; ?></option>
							<?php } ?>
						</select>
						<a href="javascript:void(0)" id="loadCategories" class="button small success" style="width:100%;"><i class="fa fa-cloud-upload"></i> <?php echo __('Cargar temas'); ?></a>
					</div>
					<div class="large-5 columns left">
						<span class="label"><?php echo __('¿Cuántas preguntas de este tema?'); ?></span>
						<div id="numberOfQuestionsPerTopic"></div>
					</div>
				</div>

		</fieldset>
		</div>

		<div class="row">
			<?php echo $this->Form->submit(__('Crear',true),array('class' => 'button')); ?>
		</div>
		
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="row collapse">
	<a href="javascript:void(0)" class="delete-records small button alert">
		<i class="general foundicon-trash"></i> 
		<?php echo __('Eliminar'); ?>
	</a>
	<a href="javascript:void(0)" class="select-records small button secondary">
		<i class="general foundicon-checkmark"></i>
		<?php echo __('Seleccioar todos'); ?>
	</a>
	<a href="javascript:void(0)" class="unselect-records small button secondary">
		<i class="general foundicon-remove"></i> 
		<?php echo __('Descartar seleccion'); ?>
	</a>
</div>

<div class="row collapse">

		<?php echo $this->Form->Create('Test',array('id' => 'TableRecordsForm','url' => array('action' => 'delete'))); ?>
		<table width="">
		  <thead>
		    <tr>
		      <th width="50"><?php echo __('#'); ?></th>
		      <th><?php echo __('Nombre'); ?></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Categoria principal del examen'); ?>"><?php echo __('Categoría'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Total de preguntas en este examen'); ?>"><?php echo __('Reactivos'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Material de estudio'); ?>"><?php echo __('Recursos'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Fecha y hora de inicio'); ?>"><?php echo __('Inicio'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Fecha y hora de finalizacíón'); ?>"><?php echo __('Fin'); ?></span></th>
		      <th><?php echo __('Editar'); ?></th>
		      <th><?php echo __('Activo'); ?></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($tests) > 0) { ?>
			  	<?php foreach($tests as $test) { ?>
				    <tr class="table_row">
				      <td><?php echo $this->Form->checkbox('Test.id.' . $test['Test']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
				      <td style="text-align:left;"><?php echo $test['Test']['name']; ?></td>
				      <td><?php echo $test['TestCategory']['name']; ?></td>
				      <td><a class="button secondary" href="<?php echo $this->Html->url(array('controller' => 'Questions','action' => 'index',$test['Test']['id'])); ?>"><?php echo count($test['Question']); ?></a></td>
				      <td><a class="button secondary" href="<?php echo $this->Html->url(array('controller' => 'Resources','action' => 'test',$test['Test']['id'])); ?>"><i class="fa fa-book"></i></a></td>
				      <td>
				      	<?php if($test['Test']['start_datetime']) { ?>
				      		<?php echo $this->Time->format('F jS, Y H:i', $test['Test']['start_datetime']); ?>
				      	<?php } else { ?>
				      		<?php echo __('Examen abierto'); ?>
				      	<?php } ?>
				      </td>
				      <td>
				      	<?php if($test['Test']['end_datetime']) { ?>
				      		<?php echo $this->Time->format('F jS, Y H:i', $test['Test']['end_datetime']); ?>
				      	<?php } else { ?>
				      		<?php echo __('Examen abierto'); ?>
				      	<?php } ?>
				      </td>
				      <td><a href="javascript:void(0)" class="button secondary editTest" data-reveal-ajax="true" data-test-id="<?php echo $test['Test']['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
				      <td>
	      				<div class="switch small round">
  							<input id="<?php echo $test['Test']['id']; ?>" class="ActivateSwitch" name="<?php echo $test['Test']['id']; ?>" type="radio" <?php if(!$test['Test']['active'])  echo 'checked'; ?> >
  							<label for="<?php echo $test['Test']['id']; ?>"><?php echo __('No'); ?></label>

  							<input id="test-<?php echo $test['Test']['id']; ?>" class="ActivateSwitch" name="<?php echo $test['Test']['id']; ?>" type="radio" <?php if($test['Test']['active']) echo 'checked'; ?> >
  							<label for="test-<?php echo $test['Test']['id']; ?>"><?php echo __('Si'); ?></label>

							<span></span>
						</div>
				      </td>
				    </tr>
			  	<?php } ?>
		  	<?php } else { ?>
				<tr class="table_row">
				 	<td colspan="7"><?php echo __('Actualmente no hay registros para mostrar'); ?></td>
				</tr>
		  	<?php } ?>
		  </tbody>
		</table>
		<?php echo $this->Form->end(); ?>

</div>

<div id="tempTestModal" class="reveal-modal white-modal">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<div class="row collapse">
	<a href="javascript:void(0)" class="delete-records small button alert">
		<i class="general foundicon-trash"></i> 
		<?php echo __('Eliminar'); ?>
	</a>
	<a href="javascript:void(0)" class="select-records small button secondary">
		<i class="general foundicon-checkmark"></i>
		<?php echo __('Seleccioar todos'); ?>
	</a>
	<a href="javascript:void(0)" class="unselect-records small button secondary">
		<i class="general foundicon-remove"></i> 
		<?php echo __('Descartar seleccion'); ?>
	</a>
</div>
<!-- Jquery Form Validation Code -->
<script>
	$(document).ready(function(){


		//$('#TestAuto').multiSelect();

		$('#TestAuto').multiSelect({
		  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Buscador'>",
		  afterInit: function(ms){
		    var that = this,
		        $selectableSearch = that.$selectableUl.prev(),
		        $selectionSearch = that.$selectionUl.prev(),
		        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

		    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
		    .on('keydown', function(e){
		      if (e.which === 40){
		        that.$selectableUl.focus();
		        return false;
		      }
		    });

		    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
		    .on('keydown', function(e){
		      if (e.which == 40){
		        that.$selectionUl.focus();
		        return false;
		      }
		    });
		  },
		  afterSelect: function(){
		    this.qs1.cache();
		    this.qs2.cache();
		  },
		  afterDeselect: function(){
		    this.qs1.cache();
		    this.qs2.cache();
		  }
		});

		$('.ms-list').on('scroll', function () {
    		$('#numberOfQuestionsPerTopic').scrollTop($(this).scrollTop());
		});

		$('#numberOfQuestionsPerTopic').on('scroll', function () {
    		$('.ms-list').scrollTop($(this).scrollTop());
		});


		$('#loadCategories').click(function(){
			var values = $('#TestAuto').val();
			if(values.length > 0)
			{
				var i = 0;
				$('#numberOfQuestionsPerTopic').html("");
				for(; i < values.length; i++)
				{
					var input = $('<input/>').attr({
						//"placeholder":$("#TestAuto option[value='"+values[i]+"']").attr("data-name"),
						"placeholder":"Maximo "+$("#TestAuto option[value='"+values[i]+"']").attr("data-count"),
						"type":"text",
						"name":"data[Test][Auto]["+$("#TestAuto option[value='"+values[i]+"']").val()+"]",
						"autocomplete":"off",
					});

					$('#numberOfQuestionsPerTopic').append(input);
				}
			}
		});

		$('.editTest').click(function(){
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'editTest')); ?>",
	    		data: "test="+$(this).data('test-id'),
	    		success: function(data) {
	              $('#tempTestModal .modalContent').html(data);
	              $('#tempTestModal').foundation('reveal', 'open');
	    		}
	  		});
		});

	    $( "#TestStartDate" ).datepicker({
	      defaultDate: "+1w",
	      dateFormat: 'yy-mm-dd',
	      onClose: function( selectedDate ) {
	        $( "#TestEndDate" ).datepicker( "option", "minDate", selectedDate );
	      }
	    });
	    $( "#TestEndDate" ).datepicker({
	      defaultDate: "+1w",
	      dateFormat: 'yy-mm-dd',
	      onClose: function( selectedDate ) {
	        $( "#TestStartDate" ).datepicker( "option", "maxDate", selectedDate );
	      }
	    });

     	$('#TestCreateForm').validate({
        	errorClass: 'error',
        	rules: {
          		"data[Test][name]": {
            	required: true,
          		}
        	}
      	});

		$('.ActivateSwitch').click(function(){	
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'activate')); ?>",
	    		data: "test="+$(this).attr('name'),
	    		dataType: 'json',
	    		success: function(data) {
	    			console.log(data);
	    		}
	  		});
		})
	});
</script>
<!-- Jquery Form Validation Code -->