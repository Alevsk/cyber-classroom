<div class="row collapse">
  <h2><?php echo __('Preguntas del examen') . ' <span class="secondary label">' . $test['Test']['name'] . '</span>'; ?></h2>
  <div class="panel row collapse no-color-panel">
    <?php echo $this->Form->Create('Question', array('class' => 'custom', 'id' => 'TestCreateForm', 'url' => array('action' => 'create'))); ?>
    <?php echo $this->Form->input('Question.test_id',array('type' => 'hidden','value' => $test['Test']['id'])); ?>

    <div class="row">
      <div class="large-6 columns left">
        <span class="label"><?php echo __('Titulo de la pregunta'); ?></span>
        <?php echo $this->Form->text('Question.title',array('required' => '', 'label' => false,'placeholder' => __('Escriba un titulo',true))); ?>
      </div>
      
      <div class="large-3 columns left">
        <span class="label"><?php echo __('Tipo de pregunta'); ?></span>
        <select name="data[Question][question_type_id]" id="QuestionQuestionTypeId">
          <?php foreach($questionTypes as $questionType) { ?>
            <option value="<?php echo $questionType['QuestionType']['id']; ?>"><?php echo $questionType['QuestionType']['name']; ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="large-3 columns left">
        <span class="label"><?php echo __('Tema de la pregunta'); ?></span> 
        <select name="data[Question][test_category_id]" id="QuestionTestCategoryId">
          <?php foreach($testCategories as $testCategory) { ?>
            <?php if($test['Test']['test_category_id'] == $testCategory['TestCategory']['id']) { ?>
              <option value="<?php echo $testCategory['TestCategory']['id']; ?>" selected><?php echo $testCategory['TestCategory']['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $testCategory['TestCategory']['id']; ?>"><?php echo $testCategory['TestCategory']['name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>

    
    <div id="theOptions">
      <a href="javascript:void(0)" id="createNewAnswer" class="button small success"><i class="general foundicon-plus"></i> <?php echo __('Agregar una respuesta'); ?></a>
      <div id="answers">
      </div>
    </div>
    

    <div class="row">
      <div class="large-12 columns">
        <span class="label"><?php echo __('Descripción'); ?></span>
        <?php echo $this->Form->textarea('Question.description',array('required' => '', 'label' => false,'placeholder' => __('Escriba una descripcion',true))); ?>
      </div>
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

    <?php echo $this->Form->Create('Question',array('id' => 'TableRecordsForm','url' => array('action' => 'delete'))); ?>
    <?php echo $this->Form->input('Test.id',array('type' => 'hidden','value' => $test['Test']['id'])); ?>
    <table width="">
      <thead>
        <tr>
          <th width="50"><?php echo __('#'); ?></th>
          <th><?php echo $this->Paginator->sort('Question.title', __('Titulo',true)); ?></th>
          <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Tipo de reactivo'); ?>"><?php echo $this->Paginator->sort('Question.question_type_id', __('Tipo',true)); ?></span></th>
          <th><span data-tooltip data-options="disable-for-touch:true" data-tooltip class="has-tip tip-top" title="<?php echo __('Categoría del reactivo'); ?>"><?php echo $this->Paginator->sort('Question.test_category_id', __('Categoría',true)); ?></span></th>
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
              $('#tempQuestionModal .modalContent').html(data);
              $('#tempQuestionModal').foundation('reveal', 'open');
            }
          });

      });

      $('#createNewAnswer').click(function(){

        var numberOfCurrentAnswers = 0; 
        if(isNaN($("#answers > .columns:last-child").data("id"))) {
          numberOfCurrentAnswers = 1;
        } else {
          numberOfCurrentAnswers = $("#answers > .columns:last-child").data("id") + 1;
        }

        var mainAnswerContainer = $('<div></div>').addClass('large-2 columns left').attr({id:"Answer"+numberOfCurrentAnswers,"data-id":numberOfCurrentAnswers});
        var rowCollapseDiv = $('<div></div>').addClass('row collapse inputButtonContainer');
        var rowCollapseDeleteAnswerButtonDiv = $('<div></div>').addClass('row collapse');

        var textBoxDiv = $('<div></div>').addClass('small-11 columns');
        var checkBoxDiv = $('<div></div>').addClass('small-11 columns left').css({"margin-top":"-20px"});

        var textBox = $('<textarea></textarea>').attr({           
                          name:"data[Answer]["+numberOfCurrentAnswers+"][title]",
                          placeholder:"<?php echo __('Escriba un texto'); ?>",
                          type:"text",
                          id:"Answer"+numberOfCurrentAnswers+"Title",
                      }).addClass('answerTextArea');

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

        var deleteLink = $('<a></a>').attr({href:"javascript:void(0)","data-answer-id":"Answer"+numberOfCurrentAnswers}).addClass('radius secondary label deleteAnswerButton').html('<?php echo __("Borrar"); ?>');

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

        //Dynamically adding TinyMCE textarea

        tinyMCE.init({
            mode : "exact",
            editor_selector : "answerTextArea",
            theme : "advanced",
            theme_advanced_resizing: true,
            theme_advanced_resizing_use_cookie : false,
            theme_advanced_toolbar_location : "top",
            theme_advanced_statusbar_location : "none",
            theme_advanced_buttons1 : "jbimages,asciisvg,tiny_mce_wiris_formulaEditor,separator,bold,separator,preview",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            force_br_newlines : false,
            force_p_newlines : false,
            forced_root_block : '',
            plugins : 'asciimath,asciisvg,inlinepopups,media,tiny_mce_wiris,preview,jbimages',              
            content_css : "css/content.css",
            relative_urls: false,
            AScgiloc : '<?php echo $this->webroot; ?>php/svgimg.php',
            ASdloc : '<?php echo $this->webroot; ?>js/tinymce3/plugins/asciisvg/js/d.svg',
        });
        tinyMCE.execCommand('mceAddControl', false, 'Answer'+numberOfCurrentAnswers+'Title');

      });

      $("#answers").on( "click", ".deleteAnswerButton",function() {
          //Removing tinyMCE instance

          tinyMCE.execCommand('mceFocus', false, $(this).data('answer-id')+'Title');
          tinyMCE.execCommand('mceRemoveControl', false, $(this).data('answer-id')+'Title');
          console.log('#'+$(this).data('answer-id')+'Title');

          //Removing element from DOM
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
      tinyMCE.execCommand('mceRemoveControl', false, 'QuestionEditDescription');

      $(".answerTextAreaEdit").each(function() {
        tinyMCE.execCommand('mceFocus', false, $(this).attr('id'));                    
        tinyMCE.execCommand('mceRemoveControl', false, $(this).attr('id'));
      });

      $('#tempQuestionModal .modalContent').html("");
    });

  });
</script>
<!-- Jquery Form Validation Code -->