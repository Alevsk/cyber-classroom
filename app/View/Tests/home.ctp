<div class="row collapse">
	<h2><?php echo __('Examenes disponibles'); ?></h2>
</div>

<div class="row collapse">
		<table width="">
		  <thead>
		    <tr>
		      <th><?php echo __('Nombre'); ?></th>
		      <th><?php echo __('Material de estudio'); ?></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Fecha y hora de inicio'); ?>"><?php echo __('Inicio'); ?></span></th>
		      <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Fecha y hora de finalizacíón'); ?>"><?php echo __('Fin'); ?></span></th>
		      <th><?php echo __('Comenzar'); ?></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($tests) > 0) { ?>
			  	<?php foreach($tests as $test) { ?>

			  		<?php if($test['Test']['active']) { ?>

				    <tr class="table_row">
				      <td><?php echo $test['Test']['name']; ?></td>
				      <td><a class="button secondary" href="<?php echo $this->Html->url(array('controller' => 'Resources','action' => 'view',$test['Test']['id'])); ?>"><i class="fa fa-book"></i></a></td>
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
				      <td><a href="<?php echo $this->Html->url(array('controller' => 'Tests','action' => 'display',$test['Test']['id'])); ?>" class="button small secondary editTest"><i class="fa fa-arrow-right"></i></a></td>
				    </tr>

			  		<?php } ?>

			  	<?php } ?>
		  	<?php } else { ?>
				<tr class="table_row">
				 	<td colspan="7"><?php echo __('Actualmente no hay registros para mostrar'); ?></td>
				</tr>
		  	<?php } ?>
		  </tbody>
		</table>
</div>

<div id="tempTestModal" class="reveal-modal white-modal">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>
