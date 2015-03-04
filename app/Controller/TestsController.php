<?php

App::uses('AppController', 'Controller');

class TestsController  extends AppController {

	public $name = 'Tests';
	public $uses = array('Test','TestCategory', 'Question', 'Answer', 'Resource', 'ResourceTest', 'User', 'UserTest','UserTestAccomplished','UserTestAnswer');
	public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Test.name' => 'asc'
        )
    );

    public function home()
    {
    	$availableTest = $this->UserTest->find('all', array('conditions' => array('UserTest.user_id' => $this->userData['id'])));

    	$this->set('tests',$availableTest);
    }

	public function index() {

	    $tests = $this->Test->find('all',array('order' => 'Test.name ASC', 'conditions' => array('Test.user_id' => $this->userData['id'])));
	    
	    $joins = array(
	    			array('table' => 'questions',
	    				  'alias' => 'Question',
	    				  'type' => 'inner',
	    				  'conditions' => array('Question.test_category_id = TestCategory.id',				
	    				  						),
	    				)
	    );

	    $testCategoriesDisplay = $this->TestCategory->find("all", array('conditions' => array('TestCategory.active' => 1)));

	    $testCategories = $this->TestCategory->find("all",array(
														    	'group' => array('TestCategory.id'),
														    	'joins' => $joins,
														    	'order' => 'TestCategory.name ASC', 
														    	'recurive' => -1 ,
														    	'conditions' => array('TestCategory.active' => 1,
														    						  'Question.user_id' => $this->userData['id'],
														    						  'Question.origin' => 1,
														    						 ),
														    	'fields' => array('TestCategory.name',
														    					  'TestCategory.active',
														    					  'TestCategory.created',
														    					  'TestCategory.modified',
														    					  'COUNT(Question.id) as total_questions',
														    					 )
														    	)
	    );

	    $resources = $this->Resource->find('all', array('conditions' => array('Resource.active' => 1)));

	    $this->set("tests",$tests);
	    $this->set("testCategories",$testCategories);
	    $this->set("testCategoriesDisplay",$testCategoriesDisplay);
	    $this->set("resources",$resources);
	}

	public function add(){
		
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
				foreach($this->request->data['Question']['id'] as $key => $value)
				{
					$question = $this->Question->find('first', array('conditions' => array('Question.id' => $key)));

					unset($question['Question']['id']);
					unset($question['Question']['created']);
					unset($question['Question']['modified']);
					$question['Question']['origin'] = 0;
					$question['Question']['test_id'] = $this->request->data['Test']['id'];
					$question['Question']['user_id'] = $this->userData['id'];

					$this->Question->create();
					$this->Question->save($question);

					$lastIdQuestion = $this->Question->getLastInsertID();

					if(count($question['Answer']) > 0)
					{
						foreach($question['Answer'] as $answer)
						{
							unset($answer['id']);
							unset($answer['created']);
							unset($answer['modified']);

							$answer['question_id'] = $lastIdQuestion;

							$this->Answer->create();
							$this->Answer->save($answer);
						}
					}
				}

				$this->Session->setFlash(__("Acción completada con exito",true));
				$this->redirect(array('controller' => 'Questions','action' => 'index', $this->request->data['Test']['id']));
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

	public function all($id = null)
	{
		$id = (int) $id;

		if($id)
		{
			$testCategory = $this->TestCategory->find("first",array('conditions' => array('TestCategory.id' => $id),'recurive' => -1));

			$this->Paginator->settings = $this->paginate;
			$this->Paginator->settings['conditions'] = array('Test.test_category_id' => $id);
			$this->set("testCategory",$testCategory);
		}

		$tests = $this->Paginator->paginate('Test');
		$this->set("tests",$tests);
	}

	public function unassign()
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

			foreach($this->request->data['UserTest']['id'] as $key => $value)
			{
				//value: 1 = delete / 0 = dont delete
				if($value)
				{
					$this->UserTest->delete($key);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'Tests','action' => 'assign', $this->request->data['Test']['id']));
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'all'));
		}
	}

	public function assign($id = null)
	{
		$id = (int) $id;

		if($id)
		{
			$test = $this->Test->find('first',array('conditions' => array('Test.id' => $id)));

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

				$this->UserTest->deleteAll(array('UserTest.test_id' => $test['Test']['id']), false);

				$total = count( $this->request->data['Test']['Users']);
				for($i = 0; $i < $total; $i++)
				{
					unset($data);
					$data['UserTest']['test_id'] = $test['Test']['id'];
					$data['UserTest']['user_id'] = $this->request->data['Test']['Users'][$i];

					$this->UserTest->create();
					$this->UserTest->save($data);
				}

				$this->Session->setFlash(__("Acción completada con exito",true));
				$this->redirect(array('controller' => 'Tests','action' => 'assign', $id));			
			}

			$this->Paginator->settings['limit'] = 10;
			$this->Paginator->settings['conditions'] = array('UserTest.test_id' => $test['Test']['id']);
			$userTest = $this->Paginator->paginate('UserTest');

			$allUserTest = $this->UserTest->find('all', array('conditions' => array('UserTest.test_id' => $test['Test']['id'])));

			$usersID[] = array();

			foreach ($allUserTest as $user) {
				$usersID[] = $user['User']['id'];
			}

			$users = $this->User->find('all', array('conditions' => array('User.active' => 1, 'User.group_id' => 3)));

			$this->set('usersID',$usersID);
			$this->set('test',$test);
			$this->set('users', $users);
			$this->set('userTest', $userTest);
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


			/* Object field manipulation */
			if(!$this->request->data['Test']['start_time'])
			{
				$this->request->data['Test']['start_time'] = "01:00:00";
			}
			else
			{
				$this->request->data['Test']['start_time'] = $this->request->data['Test']['start_time'] . ":00";
			}

			if(!$this->request->data['Test']['end_time'])
			{
				$this->request->data['Test']['end_time'] = "23:59:59";
			}
			else
			{
				$this->request->data['Test']['end_time'] = $this->request->data['Test']['end_time'] . ":00";
			}
				
			if($this->request->data['Test']['start_date'])
			{
				$this->request->data['Test']['start_datetime'] = $this->request->data['Test']['start_date'] . " " . $this->request->data['Test']['start_time'];
			}
			else
			{
				$this->request->data['Test']['start_datetime'] = NULL;
			}

			if($this->request->data['Test']['end_date'])
			{
				$this->request->data['Test']['end_datetime'] = $this->request->data['Test']['end_date'] . " " . $this->request->data['Test']['end_time'];
			}
			else
			{
				$this->request->data['Test']['end_datetime'] = NULL;
			}

			$this->request->data['Test']['active'] = 1;
			$this->request->data['Test']['user_id'] = $this->userData['id'];
			/* End Object field manipulation */

			if($this->request->data['Test']['id'])
			{
				//Request: Edit an Object
				if($this->request->data['Test']['user_id'] != $this->userData['id'])
				{
					$this->Session->setFlash(__("Ocurrio un error!",true));
					$this->redirect(array('controller' => 'Tests','action' => 'index'));
				}
			}
			else
			{
				$this->Test->create();
			}
			
			if($this->Test->save($this->request->data))
			{

				//Check for $this->request->data['Test']['Auto'] values and see if user want auto generated content
				if($this->request->data['Test']['Auto'])
				{
					foreach($this->request->data['Test']['Auto'] as $key => $value)
					{
						$questions = $this->Question->find('all',array('conditions' => array('Question.user_id' => $this->userData['id'],'Question.test_category_id' => $key, 'Question.active' => 1, 'Question.origin' => 1), 'limit' => $value, 'order' => 'RAND()'));
						$lastIdTest = $this->Test->getLastInsertID();

						foreach($questions as $question)
						{
							unset($question['Question']['id']);
							unset($question['Question']['created']);
							unset($question['Question']['modified']);
							$question['Question']['origin'] = 0;
							$question['Question']['test_id'] = $lastIdTest;
							$question['Question']['user_id'] = $this->userData['id'];

							$this->Question->create();
							$this->Question->save($question);

							$lastIdQuestion = $this->Question->getLastInsertID();

							if(count($question['Answer']) > 0)
							{
								foreach($question['Answer'] as $answer)
								{
									unset($answer['id']);
									unset($answer['created']);
									unset($answer['modified']);

									$answer['question_id'] = $lastIdQuestion;

									$this->Answer->create();
									$this->Answer->save($answer);
								}
							}
						}
					}
				}

				$this->Session->setFlash(__("Acción completada con exito",true));
				$this->redirect(array('controller' => 'Tests','action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__("Ocurrio un error!",true));
				$this->redirect(array('controller' => 'Tests','action' => 'index'));
			}
		}
		else
		{
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
		}

	}

	public function scores()
	{
		$this->Paginator->settings['limit'] = 10;
		$this->Paginator->settings['conditions'] = array('UserTestAccomplished.user_id' => $this->userData['id']);
		$tests = $this->Paginator->paginate('UserTestAccomplished');

		$this->set('tests',$tests);
	}

	public function studentScores($id = null)
	{
		$id = (int) $id;

		if($id)
		{
			$this->Paginator->settings['limit'] = 10;
			$this->Paginator->settings['conditions'] = array('UserTestAccomplished.user_id' => $id);
			$tests = $this->Paginator->paginate('UserTestAccomplished');
			$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
			
			$this->set('tests',$tests);
			$this->set('user',$user);	
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
		} 		
		
	}

	public function testResumen($id)
	{
		$id = (int) $id;

		if($id)
		{ 
			$testResumen = $this->UserTestAccomplished->find('first', array('conditions' => array('UserTestAccomplished.id' => $id)));

			$total = count($testResumen['UserTestAnswer']);
			for($i = 0; $i < $total; $i++)
			{
				$testResumen['UserTestAnswer'][$i]['Question'] = $this->Answer->find('first', array('conditions' => array('Answer.correct' => 1,'Answer.question_id' => $testResumen['UserTestAnswer'][$i]['question_id'])));
				
				if($testResumen['UserTestAnswer'][$i]['answer_id'] != 0)
				{
					$testResumen['UserTestAnswer'][$i]['Question']['Answered'] = $this->Answer->find('first', array('recursive' => -1,'conditions' => array('Answer.id' => $testResumen['UserTestAnswer'][$i]['answer_id'])));
				}
				else
				{
					$testResumen['UserTestAnswer'][$i]['Question'] = $this->Question->find('first', array('recursive' => -1,'conditions' => array('Question.id' => $testResumen['UserTestAnswer'][$i]['question_id'])));
				}
				
			}

			$this->set('testResumen', $testResumen);

		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'home'));
		}
	}

	public function resumen($id)
	{
		$id = (int) $id;

		if($id)
		{ 
			$testResumen = $this->UserTestAccomplished->find('first', array('conditions' => array('UserTestAccomplished.id' => $id)));

			if($testResumen['UserTestAccomplished']['user_id'] == $this->userData['id'])
			{
				$total = count($testResumen['UserTestAnswer']);
				for($i = 0; $i < $total; $i++)
				{
					$testResumen['UserTestAnswer'][$i]['Question'] = $this->Answer->find('first', array('conditions' => array('Answer.correct' => 1,'Answer.question_id' => $testResumen['UserTestAnswer'][$i]['question_id'])));
					
					if($testResumen['UserTestAnswer'][$i]['answer_id'] != 0)
					{
						$testResumen['UserTestAnswer'][$i]['Question']['Answered'] = $this->Answer->find('first', array('recursive' => -1,'conditions' => array('Answer.id' => $testResumen['UserTestAnswer'][$i]['answer_id'])));
					}
					else
					{
						$testResumen['UserTestAnswer'][$i]['Question'] = $this->Question->find('first', array('recursive' => -1,'conditions' => array('Question.id' => $testResumen['UserTestAnswer'][$i]['question_id'])));
					}
					
				}

				$this->set('testResumen', $testResumen);
			}
			else
			{
				$this->Session->setFlash(__("Ocurrio un error!",true));
				$this->redirect(array('controller' => 'Tests','action' => 'home'));
			}
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'home'));
		}
	}

	public function process()
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

			$availableTest = $this->UserTest->find('first', array('conditions' => array('UserTest.user_id' => $this->userData['id'], 'UserTest.test_id' => $this->request->data['Test']['id'])));

			if($availableTest)
			{
				//Test info
				$test = $this->Test->find('first', array('conditions' => array('Test.id' => $this->request->data['Test']['id'])));
				$questions = $this->Question->find('all', array('conditions' => array('Question.test_id' => $test['Test']['id'], 
																'Question.active' => 1),
															   )
												  );

				
				//Process answers correct / wrong questions and calculate correct answers

				$correct = 0;
				foreach($questions as $question)
				{
					$question['Question']['id'];
					$correctAnswers = array();

					foreach($question['Answer'] as $answer)
					{
						if($answer['correct'] == 1)
						{
							$correctAnswers[] = $answer['id'];
						}
					}

					if($question['Question']['question_type_id'] = 6)
					{
						//Mutiple options, one single answer
						if(isset($this->request->data['Question'][$question['Question']['id']]) && in_array($this->request->data['Question'][$question['Question']['id']], $correctAnswers))
						{
							$correct++;
						}
					}
					else if($question['Question']['question_type_id'] = 4)
					{
						//Mutiple options, multiple answers
					}
					else
					{
						//Open question
					}
				}

				$accomplishedTest['UserTestAccomplished']['user_id'] = $this->userData['id'];
				$accomplishedTest['UserTestAccomplished']['test_id'] = $this->request->data['Test']['id'];
				$accomplishedTest['UserTestAccomplished']['correct'] = $correct;
				$accomplishedTest['UserTestAccomplished']['total'] =  count($questions);

				//Create new entry in UserTestAccomplished with the score
				$this->UserTestAccomplished->create();
				if($this->UserTestAccomplished->save($accomplishedTest))
				{
					$lastID = $this->UserTestAccomplished->getLastInsertID();

					//Create new entries in UserTestAnswers (Historical)
					foreach ($this->request->data['Question'] as $key => $value) 
					{
						$userTestAnswer['UserTestAnswer']['user_test_accomplished_id'] = $lastID;
						$userTestAnswer['UserTestAnswer']['question_id'] = $key;

						$question = $this->Question->find('first',array('fields' => array('Question.question_type_id'), 'conditions' => array('Question.id' => $key)));

						if($question['Question']['question_type_id'] == 1)
						{
							$userTestAnswer['UserTestAnswer']['answer_id'] = 0;
							$userTestAnswer['UserTestAnswer']['value'] = $value;
						}
						else
						{
							$userTestAnswer['UserTestAnswer']['answer_id'] = $value;
						}
	
						if(!empty($value))
						{
							$this->UserTestAnswer->create();
							$this->UserTestAnswer->save($userTestAnswer);
						}
					}

					$this->Session->setFlash(__("Examen completado con exito",true));
					$this->redirect(array('controller' => 'Tests','action' => 'resumen', $lastID));
				}
				else
				{
					$this->Session->setFlash(__("Ocurrio un error!",true));
					$this->redirect(array('controller' => 'Tests','action' => 'home'));
				}
		
			}
			else
			{
				$this->Session->setFlash(__("Ocurrio un error!",true));
				$this->redirect(array('controller' => 'Tests','action' => 'home'));			
			}
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'home'));
		}
	}

	public function display($id = null)
	{

		$id = (int) $id;

		$availableTest = $this->UserTest->find('first', array('conditions' => array('UserTest.user_id' => $this->userData['id'], 'UserTest.test_id' => $id)));

		if($availableTest)
		{

			$test = $this->Test->find('first', array('recursive' => 2, 'conditions' => array('Test.id' => $id)));
			$this->set('test', $test);
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));			
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

			foreach($this->request->data['Test']['id'] as $key => $value)
			{
				//key: test id
				//value: 1 = delete / 0 = dont delete

				$test = $this->Test->find('first',array('conditions' => array('Test.id' => $key)));
				if($test['Test']['user_id'] != $this->userData['id'])
				{
					$this->Session->setFlash(__("Ocurrio un error!",true));
					$this->redirect(array('controller' => 'Tests','action' => 'index'));
				}

				if($value)
				{
					$this->Test->delete($key);
					$this->Question->deleteAll(array('Question.test_id' => $key), true);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
		}
		else
		{
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
		}
	}

	public function deleteScores()
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

			foreach($this->request->data['UserTestAccomplished']['id'] as $key => $value)
			{
				if($value)
				{
					$this->UserTestAccomplished->delete($key);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'Tests','action' => 'studentScores', $this->request->data['User']['id']));
		}
		else
		{
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
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

			$test = $this->Test->find('first',array('conditions' => array('Test.id' => $this->request->data('test'))));

			if($test['Test']['user_id'] != $this->userData['id'])
			{
				return __('No tiene los permisos suficientes', true);
			}

			if($test['Test']['active'])
			{
				$test['Test']['active'] = 0;
			}
			else
			{
				$test['Test']['active'] = 1;
			}

			if($this->Test->save($test))
			{
				echo "Ok";
			}
			else
			{
				echo "Fail";
			}
			
		}
	}

	public function activateTest(){
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

			$test = $this->Test->find('first',array('conditions' => array('Test.id' => $this->request->data('test'))));

			if($test['Test']['active'])
			{
				$test['Test']['active'] = 0;
			}
			else
			{
				$test['Test']['active'] = 1;
			}

			if($this->Test->save($test))
			{
				echo "Ok";
			}
			else
			{
				echo "Fail";
			}
			
		}
	}

	public function editTest()
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


			$test = $this->Test->find('first',array('conditions' => array('Test.id' => $this->request->data('test'))));

			if($test['Test']['user_id'] != $this->userData['id'])
			{
				return __('No tiene los permisos suficientes', true);
			}

			$testCategories = $this->TestCategory->find("all",array('order' => 'TestCategory.name ASC', 'conditions' => array('TestCategory.active' => 1)));

			$test['Test']['start_date'] = "";
			$test['Test']['start_time'] = "";
			$test['Test']['end_date'] = "";
			$test['Test']['end_time'] = "";

			if($test['Test']['start_datetime'])
			{
				$start_datetime = explode(" ",$test['Test']['start_datetime']);
				$test['Test']['start_date'] = $start_datetime[0];
				$test['Test']['start_time'] = substr($start_datetime[1],0,-3);
			}

			if($test['Test']['end_datetime'])
			{
				$end_datetime = explode(" ",$test['Test']['end_datetime']);
				$test['Test']['end_date'] = $end_datetime[0];
				$test['Test']['end_time'] = substr($end_datetime[1],0,-3);
			}

			$this->set('test',$test);
			$this->set("testCategories",$testCategories);
			$this->render('/Elements/edit_test'); 
		}		
	}

}

?>