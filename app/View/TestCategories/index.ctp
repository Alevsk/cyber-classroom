<div class="row collapse">
	<h2><?php echo __('Crear una nueva categoría'); ?></h2>

	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('TestCategory', array('class' => 'custom', 'id' => 'TestCategoryCreateForm', 'url' => array('action' => 'create'))); ?>
		<div class="row collapse">
			
			<div class="large-4 columns left">
				<span class="label"><?php echo __('Nombre de la categoría'); ?></span>
				<?php echo $this->Form->input('TestCategory.name',array('required' => '', 'label' => false,'placeholder' => __('Escriba un nombre para su categoría',true))); ?>
			</div>
		</div>
		<div class="row collapse">
			<?php echo $this->Form->submit(__('Crear',true),array('class' => 'button small')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	
	
</div>

<?php if($this->request->params['paging']['TestCategory']['count'] > $this->request->params['paging']['TestCategory']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['TestCategory']['page'] != $this->request->params['paging']['TestCategory']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['TestCategory']['pageCount'],array('tag' => 'li')); ?>
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

		<?php echo $this->Form->Create('TestCategory',array('id' => 'TableRecordsForm','url' => array('action' => 'delete'))); ?>
		<table width="">
		  <thead>
		    <tr>
		      <th width="50"><?php echo __('#'); ?></th>
		      <th><?php echo $this->Paginator->sort('TestCategory.name', __('Nombre',true)); ?><?php //echo __('Nombre'); ?></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Examenes de esta categoría'); ?>"><?php echo __('Examenes'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Preguntas de esta categoría'); ?>"><?php echo __('Preguntas'); ?></span></th>
		      <th><?php echo __('Editar'); ?></th>
		      <th><?php echo __('Activo'); ?></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($categories) > 0) { ?>
			  	<?php foreach($categories as $category) { ?>
				    <tr class="table_row">
				      <td><?php echo $this->Form->checkbox('TestCategory.id.' . $category['TestCategory']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
				      <td style="text-align:left;"><?php echo $category['TestCategory']['name']; ?></td>
				      <td><a href="<?php echo $this->Html->url(array('controller' => 'Tests', 'action' => 'all',$category['TestCategory']['id']))?>" class="button small secondary"><?php echo count($category['Test']); ?></a></td>
				      <td><a href="<?php echo $this->Html->url(array('controller' => 'Questions', 'action' => 'allQuestions',$category['TestCategory']['id']))?>" class="button small secondary"><?php echo count($category['Question']); ?></a></td>
				      <td><a href="javascript:void(0)" class="button small secondary editTestCategory" data-reveal-ajax="true" data-testcategory-id="<?php echo $category['TestCategory']['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
				      <td>
		      				<div class="switch small round">
	  							<input id="<?php echo $category['TestCategory']['id']; ?>" class="ActivateSwitch" name="<?php echo $category['TestCategory']['id']; ?>" type="radio" <?php if(!$category['TestCategory']['active'])  echo 'checked'; ?> >
	  							<label for="<?php echo $category['TestCategory']['id']; ?>"><?php echo __('No'); ?></label>

	  							<input id="testcategory-<?php echo $category['TestCategory']['id']; ?>" class="ActivateSwitch" name="<?php echo $category['TestCategory']['id']; ?>" type="radio" <?php if($category['TestCategory']['active']) echo 'checked'; ?> >
	  							<label for="testcategory-<?php echo $category['TestCategory']['id']; ?>"><?php echo __('Si'); ?></label>
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

<?php if($this->request->params['paging']['TestCategory']['count'] > $this->request->params['paging']['TestCategory']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['TestCategory']['page'] != $this->request->params['paging']['TestCategory']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['TestCategory']['pageCount'],array('tag' => 'li')); ?>
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

<div id="tempTestCategoryModal" class="reveal-modal white-modal">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<!-- Jquery Form Validation Code -->
<script>
	$(document).ready(function(){

		$('.editTestCategory').click(function(){
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'TestCategories','action' => 'editTestCategory')); ?>",
	    		data: "testCategory="+$(this).data('testcategory-id'),
	    		success: function(data) {
	              $('#tempTestCategoryModal .modalContent').html(data);
	              $('#tempTestCategoryModal').foundation('reveal', 'open');
	    		}
	  		});
		});

     	$('#TestCategoryCreateForm').validate({
        	errorClass: 'error',
        	rules: {
          		"data[TestCategory][name]": {
            	required: true,
          		}
        	}
      	});

		$('.ActivateSwitch').click(function(){	
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'TestCategories','action' => 'activate')); ?>",
	    		data: "testCategory="+$(this).attr('name'),
	    		dataType: 'json',
	    		success: function(data) {
	    			console.log(data);
	    		}
	  		});
		})

	});
</script>
<!-- Jquery Form Validation Code -->