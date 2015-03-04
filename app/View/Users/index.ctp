<div class="row collapse">
	<h2><?php echo __('Crear un nuevo usuario'); ?></h2>
	<div class="panel row collapse no-color-panel">
		<?php echo $this->Form->Create('User', array('class' => 'custom', 'id' => 'UserCreateForm', 'url' => array('action' => 'create'))); ?>

		<div class="row">
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-user"></i> <?php echo __('Nombre completo'); ?></span>
				<?php echo $this->Form->input('User.name',array('required' => '', 'label' => false,'placeholder' => __('Escriba un nombre completo',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-envelope"></i> <?php echo __('Email'); ?></span>
				<?php echo $this->Form->input('User.email',array('required' => '', 'label' => false,'placeholder' => __('Escriba un email valido',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-users"></i> <?php echo __('Tipo de usuario'); ?></span>
				<select name="data[User][group_id]" class="" id="UserGroupId">
					<?php foreach($groups as $group) { ?>
						<option value="<?php echo $group['Group']['id']; ?>"><?php echo $group['Group']['name']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-user"></i> <?php echo __('Matrícula'); ?></span>
				<?php echo $this->Form->input('User.username',array('required' => '', 'label' => false,'placeholder' => __('Escriba una matrícula',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-lock"></i> <?php echo __('Contraseña'); ?></span>
				<?php echo $this->Form->input('User.password',array('type' => 'password', 'required' => '', 'label' => false,'placeholder' => __('Escriba una contraseña',true))); ?>
			</div>
			<div class="large-4 columns left">
				<span class="label"><i class="fa fa-lock"></i> <?php echo __('Repita la contraseña'); ?></span>
				<?php echo $this->Form->input('User.re-password',array('type' => 'password', 'required' => '', 'label' => false,'placeholder' => __('Escriba una contraseña',true))); ?>
			</div>
		</div>

		<div class="row">
			<?php echo $this->Form->submit(__('Crear',true),array('class' => 'button')); ?>
		</div>
		<div class="row">
			<a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'loadStudents')); ?>" class="button small success"><?php echo __('Alta masiva de usuarios'); ?></a>
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
<?php if($this->request->params['paging']['User']['count'] > $this->request->params['paging']['User']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['User']['page'] != $this->request->params['paging']['User']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['User']['pageCount'],array('tag' => 'li')); ?>
		</ul>
	</div>
<?php } ?>

<div class="row collapse">

		<ul class="button-group" id="user_table_selection">
		          <li><a href="<?php echo $this->Html->url(array('action' => 'index','administrators')); ?>" class="button displayContent small secondary <?php if($display == "administrators") echo 'selected'; ?>" data-show-content="admins"><?php echo __('Administradores'); ?></a></li>
		          <li><a href="<?php echo $this->Html->url(array('action' => 'index','professors')); ?>" class="button displayContent small secondary <?php if($display == "professors") echo 'selected'; ?>" data-show-content="professors"><?php echo __('Profesores'); ?></a></li>
		          <li><a href="<?php echo $this->Html->url(array('action' => 'index','students')); ?>" class="button displayContent small secondary <?php if($display == "students") echo 'selected'; ?>" data-show-content="students"><?php echo __('Estudiantes'); ?></a></li>
		 </ul>

		<?php echo $this->Form->Create('User',array('id' => 'TableRecordsForm','url' => array('action' => 'delete'))); ?>
		<table width="" id="admins">
		  <thead>
		    <tr>
		      <th width="50"><?php echo __('#'); ?></th>
		      <th><?php echo $this->Paginator->sort('User.username', __('Matrícula',true)); ?><?php //echo __('Matrícula'); ?></th>
		      <th><?php echo $this->Paginator->sort('User.name', __('Nombre',true)); ?><?php //echo __('Nombre'); ?></th>
		      <th><?php echo $this->Paginator->sort('User.email', __('Email',true)); ?><?php //echo __('Email'); ?></th>

		      <?php if($this->request->params['pass'][0] == "students") { ?>
		      	<th><?php echo __('Historial'); ?></th>
		      <?php } ?>

		      <th><?php echo __('Editar'); ?></th>
		      <th><?php echo __('Activo'); ?></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(count($users) > 0) { ?>
			  	<?php foreach($users as $user) { ?>
				    <tr class="table_row">
				      <td><?php echo $this->Form->checkbox('User.id.' . $user['User']['id'],array('class' => 'tableCheckbox', 'label' => false)); ?></td>
				      <td><?php echo $user['User']['username']; ?></td>
				      <td><?php echo $user['User']['name']; ?></td>
				      <td><a href="mailto:<?php echo $user['User']['email']; ?>?Subject=<?php echo __('Mensaje: Sistema eellTESM'); ?>" target="_blank"><?php echo $user['User']['email']; ?></a></td>

				      <?php if($user['User']['group_id'] == 3) { ?>
				      	<td><a href="<?php echo $this->Html->url(array('controller' => 'Tests', 'action' => 'studentScores', $user['User']['id'])) ?>" class="button small secondary"><i class="fa fa-eye"></i></a></td>
				      <?php } ?>

				      <td><a href="javascript:void(0)" class="button small secondary editUser" data-reveal-ajax="true" data-user-id="<?php echo $user['User']['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
				      <td>
	      				<div class="switch small round">
  							<input id="<?php echo $user['User']['id']; ?>" class="ActivateSwitch" name="<?php echo $user['User']['id']; ?>" type="radio" <?php if(!$user['User']['active'])  echo 'checked'; ?> >
  							<label for="<?php echo $user['User']['id']; ?>"><?php echo __('No'); ?></label>

  							<input id="user-<?php echo $user['User']['id']; ?>" class="ActivateSwitch" name="<?php echo $user['User']['id']; ?>" type="radio" <?php if($user['User']['active']) echo 'checked'; ?> >
  							<label for="user-<?php echo $user['User']['id']; ?>"><?php echo __('Si'); ?></label>

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

<?php if($this->request->params['paging']['User']['count'] > $this->request->params['paging']['User']['limit']) { ?>
	<div class="row collapse">
		<ul class="pagination">
			<?php echo $this->Paginator->numbers(array('currentTag' => 'a','currentClass' => 'current','separator' => '','tag' => 'li','first' => __('Inicio ',true))); ?>
			<?php if($this->request->params['paging']['User']['page'] != $this->request->params['paging']['User']['pageCount']) { ?>
			<li>...</li>
			<?php } ?>
			<?php echo $this->Paginator->last(' ' . $this->request->params['paging']['User']['pageCount'],array('tag' => 'li')); ?>
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

<!-- Jquery Form Validation Code -->
<script>
	$(document).ready(function(){
		$('.editUser').click(function(){
			console.log('editUser');
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Users','action' => 'editUser')); ?>",
	    		data: "user="+$(this).data('user-id'),
	    		success: function(data) {
	              $('#tempUserModal .modalContent').html(data);
	              $('#tempUserModal').foundation('reveal', 'open');
	    		}
	  		});
		});

     	$('#UserCreateForm').validate({
        	errorClass: 'error',
        	rules: {
          		"data[User][name]": {
            		required: true,
          		},
          		"data[User][email]": {
	            	required: true,
	            	email: true,
          		},
          		"data[User][username]": {
	            	required: true,
				},
				"data[User][password]": {
	            	required: true,
	            	equalTo: "#UserRe-password"
				},
				"data[User][re-password]": {
	            	required: true,
	            	equalTo: "#UserPassword"
				}
        	}
      	});

		$('.ActivateSwitch').click(function(){	
			$.ajax({
				type: "POST",
	    		url: "<?php echo $this->Html->url(array('controller' => 'Users','action' => 'activate')); ?>",
	    		data: "user="+$(this).attr('name'),
	    		dataType: 'json',
	    		success: function(data) {
	    			console.log(data);
	    		}
	  		});
		})
	});
</script>
<!-- Jquery Form Validation Code -->