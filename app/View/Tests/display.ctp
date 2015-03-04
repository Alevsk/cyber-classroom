<style type="text/css">

.display
{
  display:block !important;
}

.question
{
  display:none;
}

</style>

<div class="row collapse">
	<h2><?php echo $test['Test']['name']; ?></h2>
</div>

<div class="row collapse">
  <ul class="pagination">
    <?php for($i = 0; $i < count($test['Question']); $i++) { ?>
      <li id="page-<?php echo ($i + 1); ?>">
        <a class="page-buttons" href="javascript:void(0)" id="page-button-<?php echo $i; ?>" data-page="<?php echo ($i + 1); ?>"><?php echo ($i + 1); ?></a>
      </li>
    <?php } ?>
  </ul>
</div>

<div class="row">
	<div class="large-12 columns">
	  <?php $q = 1; ?>
	  <?php echo $this->Form->create('Test',array('class' => 'custom', 'url' => array('action' => 'process'))); ?>
	  <?php echo $this->Form->input('Test.id',array('value' => $test['Test']['id'], 'type' => 'hidden')); ?>

	  <?php foreach($test['Question'] as $question) { ?>
		  <div id="question-<?php echo $q; ?>" class="question">
		    <h3><?php echo $question['title']; ?></h3>

		    <?php if($question['description']) { ?>
			    <div class="panel row collapse no-color-panel">
			    	<?php echo $question['description']; ?>
			    </div>
		    <?php } ?>

		      <div class="panel">
		        <?php if($question['question_type_id'] == 6) { ?>
			        <?php foreach($question['Answer'] as $answer) { ?>
			            
			            <label for="QuestionAnswer<?php echo $answer['id']; ?>">
			              <input type="radio" name="data[Question][<?php echo $question['id']; ?>]" id="QuestionAnswer<?php echo $answer['id']; ?>" value="<?php echo $answer['id']; ?>"/>
			              <?php echo htmlspecialchars_decode($answer['title']); ?>
			            </label>

			        <?php } ?>
		        <?php } else if($question['question_type_id'] == 1) { ?> 
		              <input type="text" name="data[Question][<?php echo $question['id']; ?>]" id="QuestionAnswer<?php echo $question['id']; ?>" value=""/>
		        <?php } ?>
		      </div>
		      <div class="row collapse">
		      	<?php if($q == count($test['Question'])) { ?>
		      		<?php echo $this->Form->submit(__('Terminar examen',true ),array('class' => 'button')); ?>
		      	<?php } else { ?>
		      		<a href="javascript:void(0)" class="button next"><?php echo __('Siguiente'); ?></a>
		      	<?php } ?>
		      	
		      </div>
		  </div>
		  <?php $q++; ?>
	  <?php } ?>
	  
	  <?php echo $this->Form->end(); ?>
	</div>
</div>


<script type="text/javascript">

	$(document).ready(function(){

      var currentPage = 1;
      var totalPages = <?php echo count($test['Question']); ?>

      $('#question-1').show();
      $('#page-1').addClass('current');

      $('.page-buttons').on("click", function(){

          $('.pagination li').removeClass('current');
          $('#page-'+$(this).data('page')).addClass('current');
          
          $('.question').removeClass('display').hide();
          $('#question-' + $(this).data('page')).addClass('display');
          currentPage = $(this).data('page');

      });

      $('.next').click(function(){
      	$("#page-button-" + currentPage).trigger( "click" );
      });

		///////////////////////////////////////////////////

		/*window.onbeforeunload = function (event) {
		  var message = '<?php echo __("¿Estas seguro que deseas salir? Tu progreso no sera guardado"); ?>';
		  if (typeof event == 'undefined') {
		    event = window.event;
		  }
		  if (event) {
		    event.returnValue = message;
		  }
		  return message;
		}*/

	});
</script>