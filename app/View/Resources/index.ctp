<div class="row collapse">
	<h2><?php echo __('Agregar nuevo material'); ?></h2>

	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('Resource', array('class' => 'custom', 'id' => 'ResourceCreateForm', 'url' => array('action' => 'create'))); ?>
		<div class="row collapse">
			<div class="large-4 columns left">
				<span class="label"><?php echo __('Nombre del recurso'); ?></span>
				<?php echo $this->Form->input('Resource.name',array('required' => '', 'type' => 'text','label' => false, 'placeholder' => __('Escriba un nombre para este documento',true))); ?>
			</div>
			<div class="large-8 columns left">
				<span class="label"><?php echo __('Enlace del documento'); ?></span>
				<?php echo $this->Form->input('Resource.url',array('required' => '', 'type' => 'text','label' => false, 'placeholder' => __('Escriba una url valida',true))); ?>
			</div>
		</div>
		<div class="row collapse">
			<?php echo $this->Form->submit(__('Crear',true),array('class' => 'button small')); ?>
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

<?php if($this->request->params['paging']['Resource']['count'] > $this->request->params['paging']['Resource']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['Resource']['page'] != $this->request->params['paging']['Resource']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['Resource']['pageCount'],array('tag' => 'li')); ?>
		</ul>
	</div>
<?php } ?>

<div class="row collapse">

		<?php echo $this->Form->Create('Resource',array('id' => 'TableRecordsForm','url' => array('action' => 'delete'))); ?>
		<table width="">
		  <thead>
		    <tr>
		      <th width="50"><?php echo __('#'); ?></th>
		      <th><?php echo $this->Paginator->sort('Resource.name', __('Nombre',true)); ?></th>
		      <th><?php echo __('Visualizar'); ?></th>
		      <th><?php echo __('Editar'); ?></th>
		      <th><?php echo __('Activo'); ?></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($resources) > 0) { ?>
			  	<?php foreach($resources as $resource) { ?>
				    <tr class="table_row">
				      <td><?php echo $this->Form->checkbox('Resource.id.' . $resource['Resource']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
				      <td style="text-align:left;"><?php echo $resource['Resource']['name']; ?></td>
				      <td><a href="javascript:void(0)" class="button small secondary viewResource" data-reveal-ajax="true" data-resource-id="<?php echo $resource['Resource']['id']; ?>"><i class="fa fa-eye"></i></a></td>
				      <td><a href="javascript:void(0)" class="button small secondary editResource" data-reveal-ajax="true" data-resource-id="<?php echo $resource['Resource']['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
				      <td>
		      				<div class="switch small round">
	  							<input id="<?php echo $resource['Resource']['id']; ?>" class="ActivateSwitch" name="<?php echo $resource['Resource']['id']; ?>" type="radio" <?php if(!$resource['Resource']['active'])  echo 'checked'; ?> >
	  							<label for="<?php echo $resource['Resource']['id']; ?>"><?php echo __('No'); ?></label>

	  							<input id="testcategory-<?php echo $resource['Resource']['id']; ?>" class="ActivateSwitch" name="<?php echo $resource['Resource']['id']; ?>" type="radio" <?php if($resource['Resource']['active']) echo 'checked'; ?> >
	  							<label for="testcategory-<?php echo $resource['Resource']['id']; ?>"><?php echo __('Si'); ?></label>

								<span></span>
							</div>
				      </td>
				    </tr>
			  	<?php } ?>
		  	<?php } else { ?>
				<tr class="table_row">
				 	<td colspan="5"><?php echo __('Actualmente no hay registros para mostrar'); ?></td>
				</tr>
		  	<?php } ?>
		  </tbody>
		</table>
		<?php echo $this->Form->end(); ?>

</div>

<?php if($this->request->params['paging']['Resource']['count'] > $this->request->params['paging']['Resource']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['Resource']['page'] != $this->request->params['paging']['Resource']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['Resource']['pageCount'],array('tag' => 'li')); ?>
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

<div id="tempResourceModal" class="reveal-modal white-modal" style="">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<!-- Jquery Form Validation Code -->
<script>
	$(document).ready(function(){

		$('.editResource').click(function(){
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Resources','action' => 'editResource')); ?>",
	    		data: "resource="+$(this).data('resource-id'),
	    		success: function(data) {
	              $('#tempResourceModal .modalContent').html(data);
	              $('#tempResourceModal').foundation('reveal', 'open');
	    		}
	  		});
		});

		$('.viewResource').click(function(){
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Resources','action' => 'getResource')); ?>",
	    		data: "resource="+$(this).data('resource-id'),
	    		success: function(data) {
	              $('#tempResourceModal .modalContent').html(data);
	              $('#tempResourceModal').foundation('reveal', 'open');
	    		}
	  		});
		});

     	$('#ResourceCreateForm').validate({
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

		$('.ActivateSwitch').click(function(){	
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Resources','action' => 'activate')); ?>",
	    		data: "resource="+$(this).attr('name'),
	    		dataType: 'json',
	    		success: function(data) {
	    			console.log(data);
	    		}
	  		});
		})

	});
</script>
<!-- Jquery Form Validation Code -->