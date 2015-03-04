<div class="row collapse">
	<h2><?php echo __('Historial de ') . ' <span class="secondary label">' . $user['User']['username'] . '</span>'; ?></h2>
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

<?php if($this->request->params['paging']['UserTestAccomplished']['count'] > $this->request->params['paging']['UserTestAccomplished']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['UserTestAccomplished']['page'] != $this->request->params['paging']['UserTestAccomplished']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['UserTestAccomplished']['pageCount'],array('tag' => 'li')); ?>
    </ul>
  </div>
<?php } ?>

<div class="row collapse">
		<?php echo $this->Form->Create('Test',array('id' => 'TableRecordsForm','url' => array('action' => 'deleteScores'))); ?>
    	<?php echo $this->Form->input('User.id',array('type' => 'hidden','value' => $user['User']['id'])); ?>
		<table>
		  <thead>
		    <tr>
		      <th width="50"><?php echo __('#'); ?></th>
		      <th><?php echo __('Examen'); ?></th>
		      <th><?php echo $this->Paginator->sort('UserTestAccomplished.created', __('Realizado',true)); ?></th>
		      <th><?php echo $this->Paginator->sort('UserTestAccomplished.correct', __('Aciertos',true)); ?></th>
		      <th><?php echo $this->Paginator->sort('UserTestAccomplished.total', __('Reactivos',true)); ?></th>
		      <th><?php echo __('Calificacion'); ?></span></th>
		      <th><?php echo __('Ver detalles'); ?></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($tests) > 0) { ?>
			  	<?php foreach($tests as $test) { ?>
				    <tr class="table_row">
				      <td><?php echo $this->Form->checkbox('UserTestAccomplished.id.' . $test['UserTestAccomplished']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
				      <td style="text-align:left;"><?php echo $test['Test']['name']; ?></td>
				      <td><?php echo $this->Time->format('F jS, Y H:i', $test['UserTestAccomplished']['created']); ?></td>
				      <td><?php echo $test['UserTestAccomplished']['correct']; ?></td>
				      <td><?php echo $test['UserTestAccomplished']['total']; ?></td>
				      <td><?php echo (( (int)$test['UserTestAccomplished']['correct'] / (int) $test['UserTestAccomplished']['total'] ) * 100); ?></td>
				      <td><a href="<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'testResumen',$test['UserTestAccomplished']['id'])); ?>" class="button small secondary"><i class="fa fa-eye"></i></a></td>
				    </tr>
			  	<?php } ?>
		  	<?php } else { ?>
				<tr class="table_row">
				 	<td colspan="7"><?php echo __('Actualmente no hay registros para mostrar'); ?></td>
				</tr>
		  	<?php } ?>
		  </tbody>
		</table>
</div>

<?php if($this->request->params['paging']['UserTestAccomplished']['count'] > $this->request->params['paging']['UserTestAccomplished']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['UserTestAccomplished']['page'] != $this->request->params['paging']['UserTestAccomplished']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['UserTestAccomplished']['pageCount'],array('tag' => 'li')); ?>
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
