<div class="row collapse">
  <h2><?php echo __('Estudiantes asignados al examen') . ' <span class="secondary label">' . $test['Test']['name'] . '</span>'; ?></h2>
  <div class="panel row collapse no-color-panel">
    <?php echo $this->Form->Create('Test', array('class' => 'custom', 'url' => array('action' => 'assign',$test['Test']['id']))); ?>
    <?php echo $this->Form->input('Test.id',array('type' => 'hidden','value' => $test['Test']['id'])); ?>

    <div class="row">
      <div class="large-12 columns left">
        <span class="label"><?php echo __('Asignación de estudiantes'); ?></span>
        <select name="data[Test][Users]" class="" id="TestUsers" data-customforms="disabled" multiple="multiple">
          <?php foreach($users as $user) { ?>
            <?php if(in_array($user['User']['id'], $usersID)) { ?>
              <option value="<?php echo $user['User']['id']; ?>" selected><?php echo $user['User']['username']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $user['User']['id']; ?>"><?php echo $user['User']['username']; ?></option>
            <?php } ?>
            
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="row" style="margin-top:20px;">
      <?php echo $this->Form->submit(__('Guardar',true),array('class' => 'button')); ?>
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

<?php if($this->request->params['paging']['UserTest']['count'] > $this->request->params['paging']['UserTest']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['UserTest']['page'] != $this->request->params['paging']['UserTest']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['UserTest']['pageCount'],array('tag' => 'li')); ?>
    </ul>
  </div>
<?php } ?>

<div class="row collapse">
    <?php echo $this->Form->Create('Test',array('id' => 'TableRecordsForm','url' => array('action' => 'unassign'))); ?>
    <?php echo $this->Form->input('Test.id',array('type' => 'hidden','value' => $test['Test']['id'])); ?>
    <table>
      <thead>
        <tr>
          <th width="50"><?php echo __('#'); ?></th>
          <th><?php echo __('Matrícula'); ?></th>
          <th><?php echo __('Nombre'); ?></th>
          <th><?php echo __('Email'); ?></th>
          <th><?php echo __('Historial'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(count($userTest) > 0) { ?>
          <?php foreach($userTest as $user) { ?>
            <tr class="table_row">
              <td><?php echo $this->Form->checkbox('UserTest.id.' . $user['UserTest']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
              <td><?php echo $user['User']['username']; ?></td>
              <td><?php echo $user['User']['name']; ?></td>
              <td><a href="mailto:<?php echo $user['User']['email']; ?>?Subject=<?php echo __('Mensaje: Sistema eellTESM'); ?>" target="_blank"><?php echo $user['User']['email']; ?></a></td>
              <td><a href="<?php echo $this->Html->url(array('controller' => 'Tests', 'action' => 'studentScores', $user['User']['id'])) ?>" class="button small secondary"><i class="fa fa-eye"></i></a></td>
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

<?php if($this->request->params['paging']['UserTest']['count'] > $this->request->params['paging']['UserTest']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['UserTest']['page'] != $this->request->params['paging']['UserTest']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['UserTest']['pageCount'],array('tag' => 'li')); ?>
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

<div id="tempUserModal" class="reveal-modal white-modal">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $("#TestAssignForm").submit(function() {

      var values = $('#TestUsers').val();
      var i = 0;
        for(; i < values.length; i++)
        {
          var input = $('<input/>').attr({
            "type":"hidden",
            "name":"data[Test][Users]["+i+"]",
            "value":$("#TestUsers option[value='"+values[i]+"']").val(),
          });

          $('#TestAssignForm').append(input);
        }

    });

    $('#TestUsers').multiSelect({
      selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Buscador'>",
      selectionHeader:  "<input type='text' class='search-input' autocomplete='off' placeholder='Buscador'>",
      afterInit: function(ms){
        var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
            selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e){
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });

        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });

  });

</script>