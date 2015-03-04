<div class="row collapse">
	<h2><?php echo __('Resumen del examen') . ' <span class="secondary label">' . $testResumen['Test']['name'] . '</span>'; ?></h2>

	<div class="large-6 columns">

		<table class="test-score">
			<tbody>
				<tr>
					<th><?php echo __('Matriccula'); ?></th>
					<td><?php echo $testResumen['User']['username']; ?></td>
				</tr>
				<tr>
					<th><?php echo __('Nombre'); ?></th>
					<td><?php echo $testResumen['User']['name']; ?></td>
				</tr>
				<tr>
					<th><?php echo __('Realizado'); ?></th>
					<td><?php echo $this->Time->format('F jS, Y H:i', $testResumen['UserTestAccomplished']['created']); ?></td>
				</tr>
				<tr>
					<th><?php echo __('Total de preguntas'); ?></th>
					<td><?php echo $testResumen['UserTestAccomplished']['total']; ?></td>
				</tr>
				<tr>
					<th><?php echo __('Respuestas correctas'); ?></th>
					<td><?php echo $testResumen['UserTestAccomplished']['correct']; ?></td>
				</tr>
				<tr>
					<th><?php echo __('Calificación'); ?></th>
					<td id="score"><?php echo (( (int)$testResumen['UserTestAccomplished']['correct'] / (int) $testResumen['UserTestAccomplished']['total'] ) * 100); ?></td>
				</tr>
			</tbody>
		</table>

	</div>
</div>

<?php foreach($testResumen['UserTestAnswer'] as $question) { ?>
	<div class="panel row collapse no-color-panel">
		<h4 class=""><?php echo $question['Question']['Question']['title']; ?></h4>
		<?php if($question['Question']['Question']['description']) { ?>
			    <div class="row collapse">
			    	<?php echo $question['Question']['Question']['description']; ?>
			    </div>
		<?php } ?>
		<div class="row collapse">
			<?php if($question['Question']['Question']['question_type_id'] == 1) { ?>
				<p><strong><?php echo __('Tu respuesta:'); ?></strong></p>
				<input type="text" disabled="true" value="<?php echo $question['value']; ?>" />
			<?php } else { ?>

				<p><strong><?php echo __('Tu respuesta:'); ?></strong></p>
				<p>
					<?php if($question['Question']['Answered']['Answer']['id'] == $question['Question']['Answer']['id']) { ?>
						<a href="javascript:void(0)" class="button small success"><i class="fa fa-check"></i></a>
					<?php } else { ?>
						<a href="javascript:void(0)" class="button small alert"><i class="fa fa-times"></i></a>
					<?php } ?> 
					<?php echo htmlspecialchars_decode($question['Question']['Answered']['Answer']['title']); ?>
				</p>
				<p><strong><?php echo __('Respuesta correcta:'); ?></strong></p>
				<p><a href="javascript:void(0)" class="button small success"><i class="fa fa-check"></i></a> <?php echo htmlspecialchars_decode($question['Question']['Answer']['title']); ?></p>

			<?php } ?>

		</div>
	</div>
<?php } ?>

<script type="text/javascript">

	$(document).ready(function(){

		var score = parseInt($('#score').html());

		if(score < 70)
		{
			$('#score').css({'color':'#FF0000'});
		}

	});

</script>