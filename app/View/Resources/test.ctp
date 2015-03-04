<div class="row collapse">
  <h2><?php echo __('Material del examen') . ' <span class="secondary label">' . $test['Test']['name'] . '</span>'; ?></h2>
  <div class="panel row collapse no-color-panel">
    <?php echo $this->Form->Create('Resource', array('class' => 'custom', 'url' => array('action' => 'add'))); ?>
    <?php echo $this->Form->input('Test.id',array('type' => 'hidden','value' => $test['Test']['id'])); ?>

    <div class="row">
      <div class="large-12 columns left">
        <span class="label"><?php echo __('Material de estudio que desea utilizar'); ?></span>
        <select name="data[Test][Resources]" class="" id="TestResources" data-customforms="disabled" multiple="multiple">
          <?php foreach($resources as $resource) { ?>
            <?php if(in_array($resource['Resource']['id'], $resourcesID)) { ?>
              <option value="<?php echo $resource['Resource']['id']; ?>" selected><?php echo $resource['Resource']['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $resource['Resource']['id']; ?>"><?php echo $resource['Resource']['name']; ?></option>
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

<?php if($this->request->params['paging']['ResourceTest']['count'] > $this->request->params['paging']['ResourceTest']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['ResourceTest']['page'] != $this->request->params['paging']['ResourceTest']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['ResourceTest']['pageCount'],array('tag' => 'li')); ?>
    </ul>
  </div>
<?php } ?>

<div class="row collapse">

    <?php echo $this->Form->Create('ResourceTest',array('id' => 'TableRecordsForm','url' => array('controller' => 'Resources','action' => 'deleteResources'))); ?>
    <table width="">
      <thead>
        <tr>
          <th width="50"><?php echo __('#'); ?></th>
          <th><?php echo $this->Paginator->sort('ResourceTest.name', __('Nombre',true)); ?></th>
          <th><?php echo __('Visualizar'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(count($resourceTest) > 0) { ?>
          <?php foreach($resourceTest as $resource) { ?>
            <tr class="table_row">
              <td><?php echo $this->Form->checkbox('ResourceTest.id.' . $resource['ResourceTest']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
              <td style="text-align:left;"><?php echo $resource['Resource']['name']; ?></td>
              <td><a href="javascript:void(0)" class="button small secondary viewResource" data-reveal-ajax="true" data-resource-id="<?php echo $resource['Resource']['id']; ?>"><i class="fa fa-eye"></i></a></td>
            </tr>
          <?php } ?>
        <?php } else { ?>
        <tr class="table_row">
          <td colspan="5"><?php echo __('Actualmente no hay registros para mostrar'); ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php echo $this->Form->end(); ?>

</div>

<?php if($this->request->params['paging']['ResourceTest']['count'] > $this->request->params['paging']['ResourceTest']['limit']) { ?>
  <div class="row collapse">
    <ul class="pagination">
      <?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
      <?php if($this->request->params['paging']['ResourceTest']['page'] != $this->request->params['paging']['ResourceTest']['pageCount']) { ?>
      <li>...</li>
      <?php } ?>
      <?php echo $this->Paginator->last(' ' . $this->request->params['paging']['ResourceTest']['pageCount'],array('tag' => 'li')); ?>
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

<div id="tempResourceModal" class="reveal-modal white-modal" style="">
  <a class="close-reveal-modal">&#215;</a>
  <div class="modalContent"></div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('.viewResource').click(function(){
      $.ajax({
        type: "POST",
          url: "<?php echo $this->Html->url(array('controller' => 'Resources','action' => 'getResource')); ?>",
          data: "resource="+$(this).data('resource-id'),
          success: function(data) {
                $('#tempResourceModal .modalContent').html(data);
                $('#tempResourceModal').foundation('reveal', 'open');
          }
        });
    });

    $("#ResourceTestForm").submit(function() {

      var values = $('#TestResources').val();
      var i = 0;
        for(; i < values.length; i++)
        {
          var input = $('<input/>').attr({
            "type":"hidden",
            "name":"data[Test][Resources]["+i+"]",
            "value":$("#TestResources option[value='"+values[i]+"']").val(),
          });

          $('#ResourceTestForm').append(input);
        }

    });

    $('#TestResources').multiSelect({
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