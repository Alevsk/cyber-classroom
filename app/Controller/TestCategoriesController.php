<?php

App::uses('AppController', 'Controller');

class TestCategoriesController  extends AppController {

	public $name = 'TestCategories';
	public $uses = array('TestCategory');
	public $paginate = array(
        'limit' => 10,
        'order' => array(
            'TestCategory.title' => 'asc'
        )
    );

	public function index() {

		$this->Paginator->settings = $this->paginate;
	  	$categories = $this->Paginator->paginate('TestCategory');
	  	$this->set('categories', $categories);
	
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

			/* Object field manipulation */
			$this->request->data['TestCategory']['active'] = 1;
			/* End Object field manipulation */

			if($this->request->data['']['id'])
			{
				//Request: Edit an Object
				//Future Validation: Validate that current user is the owner of this testCategory
				//END future Validation: Validate that current user is the owner of this testCategory
			}
			else
			{
				//Request: Create new Object
				$this->TestCategory->create();
			}

			if($this->TestCategory->save($this->request->data))
			{
				$this->Session->setFlash(__("Acción completada con exito",true));
				$this->redirect(array('controller' => 'TestCategories','action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__("Ocurrio un error!",true));
				$this->redirect(array('controller' => 'TestCategories','action' => 'index'));
			}
		}
		else
		{
			$this->redirect(array('controller' => 'TestCategories','action' => 'index'));
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

			foreach($this->request->data['TestCategory']['id'] as $key => $value)
			{
				//key: test category id
				//value: 1 = delete / 0 = dont delete

				if($value)
				{
					$this->TestCategory->delete($key);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'TestCategories','action' => 'index'));
		}
		else
		{
			$this->redirect(array('controller' => 'TestCategories','action' => 'index'));
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

			$Category = $this->TestCategory->find('first',array('conditions' => array('TestCategory.id' => $this->request->data('testCategory'))));

			if($Category['TestCategory']['active'])
			{
				$Category['TestCategory']['active'] = 0;
			}
			else
			{
				$Category['TestCategory']['active'] = 1;
			}

			if($this->TestCategory->save($Category))
			{
				echo "Ok";
			}
			else
			{
				echo "Fail";
			}
		}
	}

	public function editTestCategory()
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

			//Future Validation: Validate that current user is the owner of this testCategory
			//END future Validation: Validate that current user is the owner of this testCategory

			$category = $this->TestCategory->find('first',array('conditions' => array('TestCategory.id' => $this->request->data('testCategory'))));
			$this->set('category',$category);
			$this->render('/Elements/edit_testCategory'); 
		}		
	}
}

?>