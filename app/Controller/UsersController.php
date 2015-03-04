<?php

App::uses('AppController', 'Controller');

class UsersController  extends AppController {

	public $name = 'Users';
	public $uses = array('User','Group','Test');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'User.username' => 'asc'
        )
    );

	public function index($display = null)
	{
		$groups = $this->Group->find('all',array('order' => 'Group.name DESC'));

		$this->Paginator->settings = $this->paginate;

		switch($display)
		{
			case "administrators":
				$this->Paginator->settings['conditions'] = array('User.group_id' => 1);
			break;

			case "professors":
				$this->Paginator->settings['conditions'] = array('User.group_id' => 2);
			break;

			case "students":
				$this->Paginator->settings['conditions'] = array('User.group_id' => 3);
			break;

			default:
				$this->Paginator->settings['conditions'] = array('User.group_id' => 1);
		}

		$users = $this->Paginator->paginate('User');

		$this->set("display",$display);
		$this->set("groups",$groups);
		$this->set("users",$users);
	}

	public function login() 
	{
		if(!empty($this->request->data))
		{
			$this->request->data = Sanitize::clean($this->request->data,
										  array('odd_spaces' => true,
												'encode' => true,
												'dollar' => true,
												'carriage' => true,
												'unicode' => true,
												'escape' => true,
												'backslash' => true));


			$user = $this->User->find('first',
						array('conditions' => 
							array(
								'OR' => array(
											'email' => $this->request->data['User']['email'],
											'username' => $this->request->data['User']['email']
										),
								'password' => Security::hash($this->request->data['User']['password'], null, true)
								), 'recursive' => -1
							)
						);
			
			if($user)
			{
				$user['User']['login_method'] = "system";
				$this->Session->write('User', $user['User']);

				switch($this->Session->read('User.group_id'))
				{
					case 1:
						//Administrator
						$this->redirect($this->administratorPaths['default']);
					break;

					case 2:
						//Professor
						$this->redirect($this->professorPaths['default']);
					break;

					case 3:
						//Student
						$this->redirect($this->studentPaths['default']);
					break;

					default:
						//default behaviour
						$this->redirect(array('controller' => 'Users','action' => 'logout'));
				}
			
			}
			else
			{
				$this->Session->setFlash(__("Usuario o clave de acceso incorrecta. Intenta nuevamente",true));
				$this->redirect(array('controller' => 'Users','action' => 'login'));
			}
		} 
	}

	//Only Access Administrator method
	public function create()
	{
		if($this->request->data)
		{
			$this->request->data = Sanitize::clean($this->request->data,
							  array('odd_spaces' => true,
									'encode' => true,
									'dollar' => true,
									'carriage' => true,
									'unicode' => true,
									'escape' => true,
									'backslash' => true));

			if(!isset($this->request->data['User']['id']))
			{	
				$this->User->create();
			}

			if($this->request->data['User']['password'] == $this->request->data['User']['re-password'])
			{
				/* Object field manipulation */
				if(!empty($this->request->data['User']['password']))
				{
					$this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], null, true);
				}
				else
				{
					$user = $this->User->find('first',array('conditions' => array('User.id' => $this->request->data['User']['id'])));
					$this->request->data['User']['password'] = $user['User']['password'];
				}
				/* End Object field manipulation */

				if($this->User->save($this->request->data))
				{
					$this->Session->setFlash(__("Acción completada con exito",true));
					$this->redirect(array('controller' => 'Users','action' => 'index'));
				}
				else
				{
					$this->Session->setFlash(__("Ya existe un usuario con este Email o Mátricula",true));
					$this->redirect(array('controller' => 'Users','action' => 'index'));
				}
			}
			else
			{
				$this->Session->setFlash(__("Los passwords no coinciden",true));
				$this->redirect(array('controller' => 'Users','action' => 'index'));
			}
		}
	}

	public function display() {

	}

	public function loadStudents()
	{
		if($this->request->data)
		{
			$this->request->data = Sanitize::clean($this->request->data,
							  array('odd_spaces' => true,
									'encode' => true,
									'dollar' => true,
									'carriage' => true,
									'unicode' => true,
									'escape' => true,
									'backslash' => true));

			$students = explode("\\n", $this->request->data['User']['students']);
			$cont = 0;

			if(!isset($this->request->data['User']['group_id']))
			{
				$this->request->data['User']['group_id'] = 3;
			}

			for($i = 0; $i < count($students); $i++)
			{
				$student = explode(",", $students[$i]);

				$data['User']['group_id'] = $this->request->data['User']['group_id'];
				$data['User']['username'] = $student[0];
				$data['User']['name'] = $student[1];
				$data['User']['email'] = $student[2];
				$data['User']['password'] = Security::hash($student[3], null, true);
				$data['User']['active'] = 1;

				$this->User->create();
				if($this->User->save($data))
				{
					$cont++;
				}
			}

			$this->Session->setFlash(__("Se agregaron ",true) . $cont . __(" registros nuevos",true));
			$this->redirect(array('controller' => 'Users','action' => 'loadStudents'));			
		}

		$groups = $this->Group->find('all',array('order' => 'Group.name DESC'));
		$this->set('groups', $groups);
	}

	public function settings()
	{
		if($this->request->data)
		{
			$this->request->data = Sanitize::clean($this->request->data,
							  array('odd_spaces' => true,
									'encode' => true,
									'dollar' => true,
									'carriage' => true,
									'unicode' => true,
									'escape' => true,
									'backslash' => true));

			if($this->request->data['User']['password'] == $this->request->data['User']['re-password'])
			{
				/* Object field manipulation */
				if(!empty($this->request->data['User']['password']))
				{
					$this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], null, true);
				}
				else
				{
					$user = $this->User->find('first',array('conditions' => array('User.id' => $this->userData['id'])));
					$this->request->data['User']['password'] = $user['User']['password'];
				}

				$this->request->data['User']['id'] = $this->userData['id'];
				unset($this->request->data['User']['name']);
				unset($this->request->data['User']['username']);
				unset($this->request->data['User']['email']);
				unset($this->request->data['User']['group_id']);
				/* End Object field manipulation */

				if($this->User->save($this->request->data))
				{
					//Updation Session data
					$this->Session->write('User.password', $this->request->data['User']['password']);

					$this->Session->setFlash(__("Acción completada con exito",true));
					$this->redirect(array('controller' => 'Users','action' => 'settings'));
				}
				else
				{
					$this->Session->setFlash(__("Ocurrio un error!",true));
					$this->redirect(array('controller' => 'Users','action' => 'settings'));
				}
			}
			else
			{
				$this->Session->setFlash(__("Los passwords no coinciden",true));
				$this->redirect(array('controller' => 'Users','action' => 'settings'));
			}
		}
		else
		{
			$groups = $this->Group->find('all',array('order' => 'Group.name DESC'));
			$user['User'] = $this->userData;
			$this->set('groups',$groups);
			$this->set('user',$user);
		}		
	}

	public function logout()
	{
		if($this->Session->check('User'))
		{
			$this->Session->destroy();	
		}		
		$this->redirect(array('controller' => 'Users','action' => 'login'));
	}

	public function delete()
	{
		if($this->request->data)
		{
			$this->request->data = Sanitize::clean($this->request->data,
										  array('odd_spaces' => true,
												'encode' => true,
												'dollar' => true,
												'carriage' => true,
												'unicode' => true,
												'escape' => true,
												'backslash' => true));

			foreach($this->request->data['User']['id'] as $key => $value)
			{
				//key: test id
				//value: 1 = delete / 0 = dont delete

				if($value)
				{
					$this->User->delete($key);
					$this->Test->deleteAll(array('Test.user_id' => $key), true);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		else
		{
			$this->redirect(array('controller' => 'Users','action' => 'index'));
		}
	}

	public function activate()
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			
			$this->request->data = Sanitize::clean($this->request->data,
										  array('odd_spaces' => true,
												'encode' => true,
												'dollar' => true,
												'carriage' => true,
												'unicode' => true,
												'escape' => true,
												'backslash' => true));

			$user = $this->User->find('first',array('conditions' => array('User.id' => $this->request->data('user'))));

			if($user['User']['active'])
			{
				$user['User']['active'] = 0;
			}
			else
			{
				$user['User']['active'] = 1;
			}

			if($this->User->save($user))
			{
				echo "Ok";
			}
			else
			{
				echo "Fail";
			}
			
		}
	}

	public function editUser()
	{
		$this->autoRender = false;
		if ($this->request->is('ajax')) 
		{
			$this->request->data = Sanitize::clean($this->request->data,
										  array('odd_spaces' => true,
												'encode' => true,
												'dollar' => true,
												'carriage' => true,
												'unicode' => true,
												'escape' => true,
												'backslash' => true));

			$user = $this->User->find('first',array('conditions' => array('User.id' => $this->request->data('user'))));
			$groups = $this->Group->find('all',array('order' => 'Group.name DESC'));

			$this->set('user',$user);
			$this->set("groups",$groups);
			$this->render('/Elements/edit_user'); 
		}		
	}

}

?>