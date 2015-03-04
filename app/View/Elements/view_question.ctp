<div id="question-temp" class="question">
  <h3><?php echo $question['Question']['title']; ?></h3>
  <!--<p>Tipo de pregunta: <strong><?php echo $question['QuestionType']['name']; ?></strong></p>-->
  <div class="row questionDescription">
    <div class="panel row collapse no-color-panel">
      <?php if($question['Question']['description']) echo $question['Question']['description']; ?>
    </div>
  </div>

    <!--<div class="panel">-->
      <?php if($question['QuestionType']['id'] == 6) { ?>
        <?php foreach($question['Answer'] as $answer) { ?>

            <div class="large-12 row collapse">
                <div class="large-1 columns left">
                  <?php if($answer['correct']) { ?>
                    <a href="javascript:void(0)" data-id="Answer<?php echo $answer['id']; ?>Correct" class="button small success"><i class="fa fa-check"></i></a>
                    <?php echo $this->Form->text('Answer.' . $answer['id'] . '.correct',array('type' => 'hidden', 'label' => false, 'value' => 0)); ?>
                  <?php } else { ?>
                    <a href="javascript:void(0)" data-id="Answer<?php echo $answer['id']; ?>Correct" class="button small alert"><i class="fa fa-times"></i></a>
                    <?php echo $this->Form->text('Answer.' . $answer['id'] . '.correct',array('type' => 'hidden', 'label' => false, 'value' => 0)); ?>                 
                  <?php } ?>

                </div>
                <div class="large-11 columns">
                  <?php echo htmlspecialchars_decode($answer['title']); ?>
                </div>
            </div>

        <?php } ?>
      <?php } 
        else if($question['QuestionType']['id'] == 4) { ?>
        <?php foreach($question['Answer'] as $answer) { ?>


            <div class="large-12 row">
              <div class="row collapse">
                <div class="small-1 columns left">
                  <?php if($answer['correct']) { ?>
                    <a href="javascript:void(0)" data-id="Answer<?php echo $answer['id']; ?>Correct" class="button postfix success"><i class="fa fa-check"></i></a>
                    <?php echo $this->Form->text('Answer.' . $answer['id'] . '.correct',array('type' => 'hidden', 'label' => false, 'value' => 0)); ?>
                  <?php } else { ?>
                    <a href="javascript:void(0)" data-id="Answer<?php echo $answer['id']; ?>Correct" class="button postfix alert"><i class="fa fa-times"></i></a>
                    <?php echo $this->Form->text('Answer.' . $answer['id'] . '.correct',array('type' => 'hidden', 'label' => false, 'value' => 0)); ?>                 
                  <?php } ?>

                </div>
                <div class="small-10 columns">
                  <?php //echo htmlspecialchars_decode($this->Form->text('Answer.' . $answer['id'] . '.title',array('disabled' => true, 'label' => false,'value' => $answer['title']))); ?>
                  <?php echo htmlspecialchars_decode($answer['title']); ?>
                </div>
              </div>
            </div>

            
 

        <?php } ?>
      <?php } else { ?> 
            <input type="text" name="data[Question][answer]" id="QuestionAnswer" value=""/>
      <?php } ?>
    <!--</div>-->
</div>