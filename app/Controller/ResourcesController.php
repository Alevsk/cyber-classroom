<?php

App::uses('AppController', 'Controller');

class ResourcesController  extends AppController {

	public $name = 'Resources';
	public $uses = array('Resource','ResourceTest','Test','UserTest');
	public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Resource.name' => 'asc'
        )
    );

	public function index() {

		$this->Paginator->settings = $this->paginate;
		$resources = $this->Paginator->paginate('Resource');
	    $this->set("resources",$resources);

	}

	public function test($id)
	{
		$id = (int) $id;

		$test = $this->Test->find('first',array('conditions' => array('Test.id' => $id)));

		if($test['Test']['user_id'] == $this->userData['id'])
		{
			
			$resources = $this->Resource->find('all', array('conditions' => array('Resource.active' => 1)));

			$this->Paginator->settings = array('limit' => 10);
			$this->Paginator->settings['conditions'] = array('ResourceTest.test_id' => $test['Test']['id']);
			$resourceTest = $this->Paginator->paginate('ResourceTest');

			$allResources = $this->ResourceTest->find('all', array('conditions' => array('ResourceTest.test_id' => $test['Test']['id'])));
			$resourcesID = array();

			foreach($allResources as $resource)
			{
				$resourcesID[] = $resource['Resource']['id'];
			}

			$this->set('resourcesID', $resourcesID);
			$this->set('test', $test);
			$this->set('resources', $resources);
			$this->set('resourceTest', $resourceTest);
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));			
		}
	}

	public function add()
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
			
			$test = $this->Test->find('first',array('conditions' => array('Test.id' => $this->request->data['Test']['id'])));

			if($test['Test']['user_id'] == $this->userData['id'])
			{
				$this->ResourceTest->deleteAll(array('ResourceTest.test_id' => $test['Test']['id']), false);
				$total = count($this->request->data['Test']['Resources']);

				for($i = 0; $i < $total; $i++)
				{
					$data['ResourceTest']['test_id'] = $test['Test']['id'];
					$data['ResourceTest']['resource_id'] = $this->request->data['Test']['Resources'][$i];

					$this->ResourceTest->create();
					$this->ResourceTest->save($data);
				}

				$this->Session->setFlash(__("Acción completada con exito",true));
				$this->redirect(array('controller' => 'Resources','action' => 'test', $test['Test']['id']));

			}
			else
			{
				$this->Session->setFlash(__("Ocurrio un error!",true));
				$this->redirect(array('controller' => 'Tests','action' => 'index'));			
			}

		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));			
		}
	}

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

			if(!isset($this->request->data['Resource']['id']))
			{
				$this->request->data['Resource']['active'] = 1;
				$this->Resource->create();
			}

			$this->request->data['Resource']['url'] = str_replace("/edit","/preview", $this->request->data['Resource']['url']);

			if($this->Resource->save($this->request->data))
			{
				$this->Session->setFlash(__("Acción completada con exito",true));
				$this->redirect(array('controller' => 'Resources','action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__("Ocurrio un error!",true));
				$this->redirect(array('controller' => 'Resources','action' => 'index'));
			}

		}
		else
		{
			$this->redirect(array('controller' => 'Resources','action' => 'index'));
		}

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

			foreach($this->request->data['Resource']['id'] as $key => $value)
			{
				//key: Resource id
				//value: 1 = delete / 0 = dont delete

				if($value)
				{
					$this->Resource->delete($key);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'Resources','action' => 'index'));
		}
		else
		{
			$this->redirect(array('controller' => 'Resources','action' => 'index'));
		}
	}

	public function deleteResources()
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

			foreach($this->request->data['ResourceTest']['id'] as $key => $value)
			{
				//key: ResourceTest id
				//value: 1 = delete / 0 = dont delete

				if($value)
				{
					$this->ResourceTest->delete($key);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'Resources','action' => 'index'));
		}
		else
		{
			$this->redirect(array('controller' => 'Resources','action' => 'test'));
		}
	}


	public function activate(){
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

			$resource = $this->Resource->find('first',array('conditions' => array('Resource.id' => $this->request->data('resource'))));

			if($resource['Resource']['active'])
			{
				$resource['Resource']['active'] = 0;
			}
			else
			{
				$resource['Resource']['active'] = 1;
			}

			if($this->Resource->save($resource))
			{
				echo "Ok";
			}
			else
			{
				echo "Fail";
			}
			
		}
	}

	public function getResource()
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

			$resource = $this->Resource->find('first',array('conditions' => array('Resource.id' => $this->request->data('resource'))));
			$this->set('resource',$resource);
			$this->render('/Elements/view_resource'); 
		}
	}

	public function editResource()
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


			$resource = $this->Resource->find('first',array('conditions' => array('Resource.id' => $this->request->data('resource'))));

			$this->set('resource',$resource);
			$this->render('/Elements/edit_Resource'); 
		}		
	}

	public function view($id = null) 
	{

		$id = (int) $id;

		$test = $this->UserTest->find('first', array('conditions' => array('UserTest.user_id' => $this->userData['id'], 'UserTest.test_id' => $id)));

		if($test)
		{
			$this->Paginator->settings = array('limit' => 10);
			$this->Paginator->settings['conditions'] = array('ResourceTest.test_id' => $test['Test']['id']);
			$resourceTest = $this->Paginator->paginate('ResourceTest');

			$this->set('test', $test);
			$this->set('resourceTest', $resourceTest);
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));			
		}
	}
}

?>