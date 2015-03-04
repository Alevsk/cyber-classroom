<div class="row collapse">
  <h2><?php echo __('Material del examen') . ' <span class="secondary label">' . $test['Test']['name'] . '</span>'; ?></h2>
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

  });

</script>