<div class="row collapse">
  <h2><?php echo __('Editando pregunta'); ?></h2>
  <div class="panel row collapse no-color-panel">
    <?php echo $this->Form->Create('Question', array('class' => 'custom', 'id' => 'TestCreateForm', 'url' => array('action' => 'create'))); ?>
    <?php echo $this->Form->input('Question.id',array('type' => 'hidden','value' => $question['Question']['id'])); ?>
    <?php echo $this->Form->input('Question.test_id',array('type' => 'hidden','value' => $question['Question']['test_id'])); ?>

    <div class="row">
      <div class="large-6 columns left">
        <span class="label"><?php echo __('Titulo de la pregunta'); ?></span>
        <?php echo htmlspecialchars_decode($this->Form->text('Question.title',array('value' => $question['Question']['title'],'required' => '', 'label' => false,'placeholder' => __('Escriba un titulo',true)))); ?>
      </div>
      
      <div class="large-3 columns left">
        <span class="label"><?php echo __('Tipo de pregunta'); ?></span>
        <select name="data[Question][question_type_id]" class="" id="QuestionQuestionTypeIdEdit">
          <?php foreach($questionTypes as $questionType) { ?>

            <?php if($questionType['QuestionType']['id'] == $question['Question']['question_type_id']) { ?>
              <option value="<?php echo $questionType['QuestionType']['id']; ?>" selected><?php echo $questionType['QuestionType']['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $questionType['QuestionType']['id']; ?>"><?php echo $questionType['QuestionType']['name']; ?></option>
            <?php } ?>
            
          <?php } ?>
        </select>
      </div>

      <div class="large-3 columns left">
        <span class="label"><?php echo __('Tema de la pregunta'); ?></span> 
        <select name="data[Question][test_category_id]" class="" id="QuestionTestCategoryId">
          <?php foreach($testCategories as $testCategory) { ?>
            <?php if($question['Question']['test_category_id'] == $testCategory['TestCategory']['id']) { ?>
              <option value="<?php echo $testCategory['TestCategory']['id']; ?>" selected><?php echo $testCategory['TestCategory']['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $testCategory['TestCategory']['id']; ?>"><?php echo $testCategory['TestCategory']['name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>

    <?php if($question['Question']['question_type_id'] == 1) { ?>
      <div id="theOptionsEdit" style="display: none;">
    <?php } else { ?>
      <div id="theOptionsEdit" style="display: block;">
    <?php } ?>

      <a href="javascript:void(0)" id="createNewAnswerEdit" class="button small success"><i class="general foundicon-plus"></i> <?php echo __('Agregar una respuesta'); ?></a>
      <div id="answersEdit">

        <?php $i = 0; ?>
        <?php foreach($question['Answer'] as $answer) { ?>

          <div class="large-3 columns left" id="answer<?php echo $i; ?>Edit" data-id="<?php echo $i; ?>">
            <div class="row collapse inputButtonContainer">
              <div class="small-11 columns">
                <?php echo html_entity_decode($this->Form->textarea('Answer.' . $i . '.title',array('value' => $answer['title'], 'label' => false, 'id' => 'Answer' . $i . 'TitleEdit', 'class' => 'answerTextAreaEdit' ,'placeholder' => __('Escriba un texto',true)))); ?>
              </div>
              <div class="small-11 columns left" style="margin-top:-20px;">
                <?php if($answer['correct']) { ?>
                    <a href="javascript:void(0)" data-id="Answer<?php echo $i; ?>CorrectEdit" class="button postfix success answerButtonEdit"><i class="fa fa-check"></i></a>
                    <?php echo $this->Form->text('Answer.' . $i . '.correct',array('id' => 'Answer' . $i . 'CorrectEdit','type' => 'hidden', 'label' => false, 'value' => 1)); ?>
                <?php } else { ?>
                    <a href="javascript:void(0)" data-id="Answer<?php echo $i; ?>CorrectEdit" class="button postfix alert answerButtonEdit"><i class="fa fa-times"></i></a>
                    <?php echo $this->Form->text('Answer.' . $i . '.correct',array('id' => 'Answer' . $i . 'CorrectEdit','type' => 'hidden', 'label' => false, 'value' => 0)); ?>
                <?php } ?>

                <?php echo $this->Form->input('Answer.' . $i . '.id',array('type' => 'hidden','value' => $answer['id'])); ?>
                
              </div>
            </div>
            <div class="row collapse">
              <a href="javascript:void(0)" data-textarea-id = "Answer<?php echo $i; ?>TitleEdit" data-answer-id = "answer<?php echo $i; ?>Edit" class="radius secondary label deleteAnswerButtonEdit"><?php echo __('Borrar'); ?></a>
            </div>
          </div>
          <?php $i++; ?>
        <?php } ?>

      </div>
    </div>
    

    <div class="row">
      <div class="large-12 columns">
        <span class="label"><?php echo __('Descripción'); ?></span>
        <?php echo $this->Form->textarea('Question.description',array('value' => $question['Question']['description'], 'id' => 'QuestionEditDescription','required' => '', 'label' => false,'placeholder' => __('Escriba una descripcion',true))); ?>
      </div>
    </div>

    <div class="row">
      <?php echo $this->Form->submit(__('Editar',true),array('class' => 'button')); ?>
    </div>
    
    <?php echo $this->Form->end(); ?>
  </div>

</div>

<!-- Jquery Form Validation Code -->
<script>
  $(document).ready(function(){

      $('#createNewAnswerEdit').click(function(){

        var numberOfCurrentAnswers = 0; 
        if(isNaN($("#answersEdit > .columns:last-child").data("id"))) {
          numberOfCurrentAnswers = 1;
        } else {
          numberOfCurrentAnswers = $("#answersEdit > .columns:last-child").data("id") + 1;
        }
        

        var mainAnswerContainer = $('<div></div>').addClass('large-3 columns left').attr({id:"answer"+numberOfCurrentAnswers+"Edit","data-id":numberOfCurrentAnswers});
        var rowCollapseDiv = $('<div></div>').addClass('row collapse inputButtonContainer');
        var rowCollapseDeleteAnswerButtonDiv = $('<div></div>').addClass('row collapse');

        var textBoxDiv = $('<div></div>').addClass('small-11 columns');
        var checkBoxDiv = $('<div></div>').addClass('small-11 columns left').css({"margin-top":"-20px"});

        var textBox = $('<textarea></textarea>').attr({           
                          name:"data[Answer]["+numberOfCurrentAnswers+"][title]",
                          placeholder:"<?php echo __('Escriba un texto'); ?>",
                          type:"text",
                          id:"Answer"+numberOfCurrentAnswers+"TitleEdit",
                      }).addClass('answerTextArea');

        var link = $('<a></a>').attr({
                          "data-id":"Answer"+numberOfCurrentAnswers+"CorrectEdit",
                      }).addClass('button postfix alert answerButtonEdit');

        var hiddenInput = $('<input></input>').attr({  
                              name:"data[Answer]["+numberOfCurrentAnswers+"][correct]",
                              type:"hidden",
                              value:0,                           
                              id:"Answer"+numberOfCurrentAnswers+"CorrectEdit", 
                          });

        var iIcon = $('<i></i>').addClass('fa fa-times');

        var deleteLink = $('<a></a>').attr({href:"javascript:void(0)","data-answer-id":"answer"+numberOfCurrentAnswers+"Edit","data-textarea-id":"Answer"+numberOfCurrentAnswers+"TitleEdit"}).addClass('radius secondary label deleteAnswerButtonEdit').html('<?php echo __("Borrar"); ?>');

        rowCollapseDeleteAnswerButtonDiv.append(deleteLink);

        link.append(iIcon);

        textBoxDiv.append(textBox);
        checkBoxDiv.append(link);
        checkBoxDiv.append(hiddenInput);

        rowCollapseDiv.append(textBoxDiv);
        rowCollapseDiv.append(checkBoxDiv);

        mainAnswerContainer.append(rowCollapseDiv);
        mainAnswerContainer.append(rowCollapseDeleteAnswerButtonDiv);
        $('#answersEdit').append(mainAnswerContainer)

        //Dynamically adding TinyMCE textarea

        tinyMCE.init({
            mode : "exact",
            editor_selector : "answerTextAreaEdit",
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
        tinyMCE.execCommand('mceAddControl', false, 'Answer'+numberOfCurrentAnswers+'TitleEdit');

      });

      $("#answersEdit").on( "click", ".deleteAnswerButtonEdit",function() {
          tinyMCE.execCommand('mceFocus', false, $(this).data('textarea-id'));
          tinyMCE.execCommand('mceRemoveControl', false, $(this).data('textarea-id'));
          $('#'+$(this).data('answer-id')).remove();
      });

      $("#answersEdit").on( "click", ".answerButtonEdit",function() {
        console.log($(this).data("id"));

          if($('#QuestionQuestionTypeIdEdit').val() == 6)
          {
            //Only one answer
            $( ".answerButtonEdit" ).each(function( index ) {
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

      $('#QuestionQuestionTypeIdEdit').change(function(event) {
        if($(this).val() == 4 || $(this).val() == 6)
        {
          $("#theOptionsEdit").show();
          $( ".answerButtonEdit" ).each(function( index ) {
                $(this).removeClass('success').addClass('alert');
                $("i", this).removeClass('fa-check').addClass('fa-times');
                $('#'+$(this).data("id")).val(0);
          });
        }
        else
        {
          $("#theOptionsEdit").hide();
        }
      }); 

    //Dynamically adding TinyMCE textarea
    tinyMCE.execCommand('mceAddControl', false, 'QuestionEditDescription');

    $(".answerTextAreaEdit").each(function() {
      tinyMCE.init({
          mode : "exact",
          editor_selector : "answerTextAreaEdit",
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

      tinyMCE.execCommand('mceAddControl', false, $(this).attr('id'));
    });

    //Reloading Foundation elements
    Foundation.libs.forms.assemble();
  });
</script>
<!-- Jquery Form Validation Code -->