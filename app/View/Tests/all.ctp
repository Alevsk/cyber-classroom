<div class="row collapse">
	<?php if(isset($testCategory)) { ?>
		<h2><?php echo __('Examenes de ') . ' <span class="secondary label">' . $testCategory['TestCategory']['name'] . '</span>'; ?></h2>
	<?php  } else { ?>
		<h2><?php echo __('Todos los examenes'); ?></h2>
	<?php  } ?>
</div>

<?php if($this->request->params['paging']['Test']['count'] > $this->request->params['paging']['Test']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['Test']['page'] != $this->request->params['paging']['Test']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['Test']['pageCount'],array('tag' => 'li')); ?>
		</ul>
	</div>
<?php } ?>

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
		      <th><?php echo $this->Paginator->sort('Test.name', __('Nombre',true)); ?><?php //echo __('Nombre'); ?></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Categoria principal del examen'); ?>"><?php echo __('Categoría'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Total de preguntas en este examen'); ?>"><?php echo __('Reactivos'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Fecha y hora de inicio'); ?>"><?php echo $this->Paginator->sort('Test.start_datetime', __('Inicio',true)); ?><?php //echo __('Inicio'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Fecha y hora de finalizacíón'); ?>"><?php echo $this->Paginator->sort('Test.end_datetime', __('Fin',true)); ?><?php //echo __('Fin'); ?></span></th>
		      <th><?php echo __('Asignar estudiantes'); ?></th>
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
				      <td><a class="button secondary" href="<?php echo $this->Html->url(array('controller' => 'Questions','action' => 'viewQuestions',$test['Test']['id'])); ?>"><?php echo count($test['Question']); ?></a></td>
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
				      <td><a href="<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'assign',$test['Test']['id'])); ?>" class="button small secondary viewTest"><i class="fa fa-users"></i></a></td>
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
				 	<td colspan="8"><?php echo __('Actualmente no hay registros para mostrar'); ?></td>
				</tr>
		  	<?php } ?>
		  </tbody>
		</table>
		<?php echo $this->Form->end(); ?>

</div>

<?php if($this->request->params['paging']['Test']['count'] > $this->request->params['paging']['Test']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['Test']['page'] != $this->request->params['paging']['Test']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['Test']['pageCount'],array('tag' => 'li')); ?>
		</ul>
	</div>
<?php } ?>

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

<div id="tempTestModal" class="reveal-modal white-modal">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<!-- Jquery Form Validation Code -->
<script>
	$(document).ready(function(){
		$('.ActivateSwitch').click(function(){	
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'activateTest')); ?>",
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