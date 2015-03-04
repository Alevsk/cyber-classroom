<div class="row collapse">
  <h2><?php echo $categoryName; ?></h2>
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

  <div class="large-12 columns left">
    <?php echo $this->Form->Create('Question', array('class' => 'custom', 'id' => 'TestFilterForm', 'url' => '#')); ?>
    <select name="" id="QuestionFilterTestCategoryId">
        <option value="<?php echo $this->Html->url(array('action' => 'allQuestions')); ?>"><?php echo __('Todos'); ?></option>
      <?php foreach($testCategories as $testCategory) { ?>
        <?php if($this->request->params['pass'][0] == $testCategory['TestCategory']['id']) { ?>
          <option value="<?php echo $this->Html->url(array('action' => 'allQuestions', $testCategory['TestCategory']['id'])); ?>" selected><?php echo $testCategory['TestCategory']['name']; ?></option>
        <?php } else { ?>
          <option value="<?php echo $this->Html->url(array('action' => 'allQuestions', $testCategory['TestCategory']['id'])); ?>"><?php echo $testCategory['TestCategory']['name']; ?></option>
        <?php } ?>    
      <?php } ?>
    </select>
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

<div id="tempQuestionModal" class="reveal-modal white-modal">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<!-- Jquery Form Validation Code -->
<script>
  $(document).ready(function(){

    $('#QuestionFilterTestCategoryId').change(function(event) {
      window.location = $(this).val();
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

    $('.ActivateSwitch').click(function(){  
      $.ajax({
        type: "POST",
          url: "<?php echo $this->Html->url(array('controller' => 'Questions','action' => 'activateQuestion')); ?>",
          data: "question="+$(this).attr('name'),
          dataType: 'json',
          success: function(data) {
            console.log(data);
          }
        });
    })

  });
</script>
<!-- Jquery Form Validation Code -->