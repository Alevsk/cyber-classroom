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

<?php if($this->request->params['paging']['Question']['count'] > $this->request->params['paging']['Question']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['Question']['page'] != $this->request->params['paging']['Question']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['Question']['pageCount'],array('tag' => 'li')); ?>
    </ul>
  </div>
<?php } ?>

<div class="row collapse">

  <div class="large-4 columns left">
    <?php echo $this->Form->Create('Question', array('class' => 'custom', 'id' => 'TestFilterForm', 'url' => '#')); ?>
    <select name="" id="QuestionFilterTestCategoryId">
        <option value="<?php echo $this->Html->url(array('action' => 'all')); ?>"><?php echo __('Todos'); ?></option>
      <?php foreach($testCategories as $testCategory) { ?>
        <?php if($this->request->params['pass'][0] == $testCategory['TestCategory']['id']) { ?>
          <option value="<?php echo $this->Html->url(array('action' => 'all', $testCategory['TestCategory']['id'])); ?>" selected><?php echo $testCategory['TestCategory']['name']; ?></option>
        <?php } else { ?>
          <option value="<?php echo $this->Html->url(array('action' => 'all', $testCategory['TestCategory']['id'])); ?>"><?php echo $testCategory['TestCategory']['name']; ?></option>
        <?php } ?>    
      <?php } ?>
    </select>
    <?php echo $this->Form->end(); ?>
  </div>

  <div class="large-8 columns left">
  <?php echo $this->Form->Create('Test', array('class' => 'custom', 'id' => 'TestQuestionAddForm', 'url' => array('controller' => 'Tests', 'action' => 'add'))); ?>
    
    <div class="large-2 columns right">
      <a href="javascript:void(0)" id="AddQuestionsToTest" class="button small success"><?php echo __('Agregar'); ?></a>
      <!--<?php echo $this->Form->submit(__('Agregar',true),array('class' => 'button small success')); ?>-->
    </div>

    <div class="large-6 columns right">
      <select name="data[Test][id]" id="TestQuestionAddForm">
        <?php foreach($tests as $test) { ?>
          <?php if($this->request->params['name']['test'] == $test['Test']['id']) { ?>
            <option value="<?php echo $test['Test']['id']; ?>" selected><?php echo $testCategory['TestCategory']['name']; ?></option>
          <?php } else { ?>
            <option value="<?php echo $test['Test']['id']; ?>"><?php echo $test['Test']['name']; ?></option>
          <?php } ?>    
        <?php } ?>
      </select> 
    </div>

  <?php echo $this->Form->end(); ?>
  </div>


</div>



<div class="row collapse">

    <?php echo $this->Form->Create('Question',array('id' => 'TableRecordsForm','url' => array('action' => 'delete'))); ?>
    <table width="">
      <thead>
        <tr>
          <th width="50"><?php echo __('#'); ?></th>
          <th><?php echo $this->Paginator->sort('Question.title', __('Titulo',true)); ?></th>
          <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Tipo de reactivo'); ?>"><?php echo $this->Paginator->sort('Question.question_type_id', __('Tipo',true)); ?><?php //echo __('Tipo'); ?></span></th>
          <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Categoría del reactivo'); ?>"><?php echo $this->Paginator->sort('Question.test_category_id', __('Categoría',true)); ?><?php //echo __('Categoría'); ?></span></th>
          <th><?php echo __('Editar'); ?></th>
          <th><?php echo __('Visualizar'); ?></th>
          <th><?php echo __('Activo'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(count($questions) > 0) { ?>
          <?php foreach($questions as $question) { ?>
            <tr class="table_row">
              <td><?php echo $this->Form->checkbox('Question.id.' . $question['Question']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
              <td style="text-align:left;"><?php echo $question['Question']['title']; ?></td>
              <td><?php echo $question['QuestionType']['name']; ?> <span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('opciones de este reactivo'); ?>">(<?php echo count($question['Answer']); ?>)</span></td>
              <td><?php echo $question['TestCategory']['name']; ?></td>

              <td><a href="javascript:void(0)" class="button small secondary editQuestion"  data-reveal-ajax="true" data-question-id="<?php echo $question['Question']['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
              <td><a href="javascript:void(0)" class="button small secondary viewQuestion"  data-reveal-ajax="true" data-question-id="<?php echo $question['Question']['id']; ?>"><i class="fa fa-eye"></i></a></td>
              <td>
                <div class="switch small round">
                  <input id="<?php echo $question['Question']['id']; ?>" class="ActivateSwitch" name="<?php echo $question['Question']['id']; ?>" type="radio" <?php if(!$question['Question']['active'])  echo 'checked'; ?> >
                  <label for="<?php echo $question['Question']['id']; ?>"><?php echo __('No'); ?></label>

                  <input id="question-<?php echo $question['Question']['id']; ?>" class="ActivateSwitch" name="<?php echo $question['Question']['id']; ?>" type="radio" <?php if($question['Question']['active']) echo 'checked'; ?> >
                  <label for="question-<?php echo $question['Question']['id']; ?>"><?php echo __('Si'); ?></label>

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

<?php if($this->request->params['paging']['Question']['count'] > $this->request->params['paging']['Question']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['Question']['page'] != $this->request->params['paging']['Question']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['Question']['pageCount'],array('tag' => 'li')); ?>
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

<div id="tempQuestionModal" class="reveal-modal white-modal">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<!-- Jquery Form Validation Code -->
<script>
  $(document).ready(function(){

      $('#AddQuestionsToTest').click(function(){

          $('#TableRecordsForm input:checked').each(function() {

            if($(this).val() == 1)
            {
              var tempinput = $(this).clone();
              tempinput.css({'display':'none'});
              $('#TestQuestionAddForm').append(tempinput);
            }

          });
          $('#TestQuestionAddForm').submit();      
      });

      $('#QuestionFilterTestCategoryId').change(function(event) {
        window.location = $(this).val();
      });

      $('.editQuestion').click(function(){
        $.ajax({
          type: "POST",
            url: "<?php echo $this->Html->url(array('controller' => 'Questions','action' => 'editQuestion')); ?>",
            data: "question="+$(this).data('question-id'),
            success: function(data) {
                  $('#tempQuestionModal .modalContent').html(data);
                  $('#tempQuestionModal').foundation('reveal', 'open');
            }
          });
      });

      $('.viewQuestion').click(function(){
        $.ajax({
          type: "POST",
            url: "<?php echo $this->Html->url(array('controller' => 'Questions','action' => 'getQuestion')); ?>",
            data: "question="+$(this).data("question-id"),
            success: function(data) {
              console.log(data);
              $('#tempQuestionModal .modalContent').html(data);
              $('#tempQuestionModal').foundation('reveal', 'open');
            }
          });

      });

      $('#createNewAnswer').click(function(){

        var numberOfCurrentAnswers = $("#answers > .columns:last-child").data("id") + 1;

        var mainAnswerContainer = $('<div></div>').addClass('large-4 columns left').attr({id:"answer"+numberOfCurrentAnswers,"data-id":numberOfCurrentAnswers});
        var rowCollapseDiv = $('<div></div>').addClass('row collapse inputButtonContainer');
        var rowCollapseDeleteAnswerButtonDiv = $('<div></div>').addClass('row collapse');

        var textBoxDiv = $('<div></div>').addClass('small-8 columns');
        var checkBoxDiv = $('<div></div>').addClass('small-2 columns left');

        var textBox = $('<input></input>').attr({           
                          name:"data[Answer]["+numberOfCurrentAnswers+"][title]",
                          placeholder:"<?php echo __('Escriba un texto'); ?>",
                          type:"text",
                          id:"Answer"+numberOfCurrentAnswers+"Title",
                      });

        var link = $('<a></a>').attr({
                          "data-id":"Answer"+numberOfCurrentAnswers+"Correct",
                      }).addClass('button postfix alert answerButton');

        var hiddenInput = $('<input></input>').attr({  
                              name:"data[Answer]["+numberOfCurrentAnswers+"][correct]",
                              type:"hidden",
                              value:0,                           
                              id:"Answer"+numberOfCurrentAnswers+"Correct", 
                          });

        var iIcon = $('<i></i>').addClass('fa fa-times');

        var deleteLink = $('<a></a>').attr({href:"javascript:void(0)","data-answer-id":"answer"+numberOfCurrentAnswers}).addClass('radius secondary label deleteAnswerButton').html('<?php echo __("Borrar"); ?>');

        rowCollapseDeleteAnswerButtonDiv.append(deleteLink);

        link.append(iIcon);

        textBoxDiv.append(textBox);
        checkBoxDiv.append(link);
        checkBoxDiv.append(hiddenInput);

        rowCollapseDiv.append(textBoxDiv);
        rowCollapseDiv.append(checkBoxDiv);

        mainAnswerContainer.append(rowCollapseDiv);
        mainAnswerContainer.append(rowCollapseDeleteAnswerButtonDiv);
        $('#answers').append(mainAnswerContainer)

      });

      $("#answers").on( "click", ".deleteAnswerButton",function() {
          $('#'+$(this).data('answer-id')).remove();
      });

      $("#answers").on( "click", ".answerButton",function() {

          if($('#QuestionQuestionTypeId').val() == 6)
          {
            //Only one answer
            $( ".answerButton" ).each(function( index ) {
                $(this).removeClass('success').addClass('alert');
                $("i", this).removeClass('fa-check').addClass('fa-times');
                $('#'+$(this).data("id")).val(0);
            });

            $(this).removeClass('alert').addClass('success');
            $("i", this).removeClass('fa-times').addClass('fa-check');
            $('#'+$(this).data("id")).val(1);
          }
          else
          {
            //Multiple answers
            if($(this).hasClass('success'))
            {
              //has class success so we change to alert
              $(this).removeClass('success').addClass('alert');
              $("i", this).removeClass('fa-check').addClass('fa-times');
              $('#'+$(this).data("id")).val(0);
            }
            else
            {
              //has class alert so we change to success
              $(this).removeClass('alert').addClass('success');
              $("i", this).removeClass('fa-times').addClass('fa-check');
              $('#'+$(this).data("id")).val(1);
            }
          }
      });

      $('#QuestionQuestionTypeId').change(function(event) {
        if($(this).val() == 4 || $(this).val() == 6)
        {
          $("#theOptions").show();
          $( ".answerButton" ).each(function( index ) {
                $(this).removeClass('success').addClass('alert');
                $("i", this).removeClass('fa-check').addClass('fa-times');
                $('#'+$(this).data("id")).val(0);
          });
        }
        else
        {
          $("#theOptions").hide();
        }
      }); 

      $('#TestCreateForm').validate({
          errorClass: 'error',
          rules: {
              "data[Question][title]": {
              required: true,
              }
          }
        });

    $('.ActivateSwitch').click(function(){  
      $.ajax({
        type: "POST",
          url: "<?php echo $this->Html->url(array('controller' => 'Questions','action' => 'activate')); ?>",
          data: "question="+$(this).attr('name'),
          dataType: 'json',
          success: function(data) {
            console.log(data);
          }
        });
    })

    $("#tempQuestionModal").bind('closed', function() {
      //Reveal closed callback function
      //Removing tinyMCE from edit Textarea
      tinyMCE.execCommand('mceFocus', false, 'QuestionEditDescription');                    
      tinyMCE.execCommand('mceRemoveControl', false, 'QuestionEditDescription')
      $('#tempQuestionModal .modalContent').html("");
    });

  });
</script>
<!-- Jquery Form Validation Code -->