<?php

App::uses('AppController', 'Controller');

class QuestionsController extends AppController {

	public $name = 'Questions';
	public $uses = array('Question', 'Test', 'TestCategory', 'QuestionType', 'QuestionImage', 'Answer');
	public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Question.name' => 'asc'
        )
    );

	public function index($id) 
	{		
		$id = (int) $id;

		$test = $this->Test->find("first", array('conditions' => array('Test.id' => $id)));

		if($test['Test']['user_id'] != $this->userData['id'])
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
		}

		if($test)
		{
			$this->Paginator->settings = $this->paginate;
			$this->Paginator->settings['conditions'] = array('Question.test_id' => $id);
			$questions = $this->Paginator->paginate('Question');

			$testCategories = $this->TestCategory->find("all", array('order' => 'TestCategory.name ASC'));
			$questionTypes = $this->QuestionType->find("all", array('order' => 'QuestionType.name ASC'));
	  	
	  		$this->set('questionTypes', $questionTypes);
			$this->set('testCategories', $testCategories);
	    	$this->set("questions",$questions);
	    	$this->set("test",$test);
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
		} 
	}

	public function viewQuestions($id) 
	{		
		$id = (int) $id;

		$test = $this->Test->find("first", array('conditions' => array('Test.id' => $id)));

		if($test)
		{
			$this->Paginator->settings = $this->paginate;
			$this->Paginator->settings['conditions'] = array('Question.test_id' => $id);
			$questions = $this->Paginator->paginate('Question');

			$testCategories = $this->TestCategory->find("all", array('order' => 'TestCategory.name ASC'));
			$questionTypes = $this->QuestionType->find("all", array('order' => 'QuestionType.name ASC'));
	  	
	  		$this->set('questionTypes', $questionTypes);
			$this->set('testCategories', $testCategories);
	    	$this->set("questions",$questions);
	    	$this->set("test",$test);
		}
		else
		{
			$this->Session->setFlash(__("Ocurrio un error!",true));
			$this->redirect(array('controller' => 'Tests','action' => 'index'));
		} 
	}

	public function all($id = null)
	{
		//TestCategory id
		$id = (int) $id;

		$this->Paginator->settings = $this->paginate;
		
		$this->Paginator->settings['order'] = array('Question.test_category_id' => 'asc');
		$this->Paginator->settings['recursive'] = 1;

		if($id)
		{
			$this->Paginator->settings['conditions'] = array('Question.user_id' => $this->userData['id'], 'Question.origin' => 1, 'Question.test_category_id' => $id);
		}
		else
		{
			$this->Paginator->settings['conditions'] = array('Question.user_id' => $this->userData['id'], 'Question.origin' => 1);
		}

		

		$testCategories = $this->TestCategory->find("all", array('order' => 'TestCategory.name ASC'));
		$questionTypes = $this->QuestionType->find("all", array('order' => 'QuestionType.name ASC'));
		$tests = $this->Test->find('all',array('recursive' => -1 ,'order' => array('Test.name' => 'ASC'), 'conditions' => array('Test.user_id' => $this->userData['id'])));
		$questions = $this->Paginator->paginate('Question');
		
		$this->set("tests",$tests);
		$this->set("questions",$questions);
	  	$this->set('questionTypes', $questionTypes);
		$this->set('testCategories', $testCategories);


	}

	public function allQuestions($id = null)
	{
		//TestCategory id
		$id = (int) $id;

		$this->Paginator->settings = $this->paginate;
		
		$this->Paginator->settings['order'] = array('Question.test_category_id' => 'asc');
		$this->Paginator->settings['recursive'] = 1;

		if($id)
		{
			$this->Paginator->settings['conditions'] = array('Question.origin' => 1, 'Question.test_category_id' => $id);
			$TestCategory = $this->TestCategory->find('first',array('conditions' => array('TestCategory.id' => $id)));
			$categoryName = $TestCategory['TestCategory']['name'];
		}
		else
		{
			$this->Paginator->settings['conditions'] = array('Question.origin' => 1);
			$categoryName = __('Todas las preguntas',true);
		}

		

		$testCategories = $this->TestCategory->find("all", array('order' => 'TestCategory.name ASC'));
		$questionTypes = $this->QuestionType->find("all", array('order' => 'QuestionType.name ASC'));
		$questions = $this->Paginator->paginate('Question');
		
		$this->set("categoryName",$categoryName);
		$this->set("questions",$questions);
	  	$this->set('questionTypes', $questionTypes);
		$this->set('testCategories', $testCategories);


	}

	public function create()
	{
		if($this->request->data)
		{
			$description = $this->request->data['Question']['description']; //Already sanitized by TinyMCE

			$this->request->data = Sanitize::clean($this->request->data,
							  array('odd_spaces' => true,
									'encode' => true,
									'dollar' => true,
									'carriage' => true,
									'unicode' => true,
									'escape' => true,
									'backslash' => true));

			/* Object field manipulation */
			$this->request->data['Question']['description'] = $description;
			$this->request->data['Question']['course_id'] = 1; //Course system not implemented yet, but we set the variable so the object can be saved into the db
			$this->request->data['Question']['active'] = 1;
			$this->request->data['Question']['user_id'] = $this->userData['id'];
			/* End Object field manipulation */

			if(isset($this->request->data['Question']['id']))
			{
				//Request: Edit an Object
				
				$question = $this->Question->find('first',array('conditions' => array('Question.id' => $this->request->data['Question']['id'])));
				if($question['Question']['user_id'] != $this->userData['id'])
				{
					$this->Session->setFlash(__("Ocurrio un error!",true));
					$this->redirect(array('controller' => 'Tests','action' => 'index'));
				}

			}
			else
			{
				$this->request->data['Question']['origin'] = 1;
				$this->Question->create();
			}

			
			if($this->Question->save($this->request->data))
			{

				if($this->request->data['Question']['question_type_id'] == 1)
				{

				}
				else
				{
					
					if(isset($this->request->data['Question']['id']))
					{
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
						// User is editing a question, check if the user has delete answers (in the GUI) of this question and proceed to delete from database//
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

						$lastId = $this->request->data['Question']['id'];

						//Get the current Answers linked to this question
						$this->Answer->recursive = -1; 
						$currentAnswers = $this->Answer->find('all', array('conditions' => array('Answer.question_id' => $lastId)));

						$currentAnswersIds = array();
						$storedAnswersIds = array();

						foreach($this->request->data['Answer'] as $currentAnswer)
						{
							$currentAnswersIds[] = $currentAnswer['id'];
						}

						foreach($currentAnswers as $storedAnswer)
						{
							$storedAnswersIds[] = $storedAnswer['Answer']['id'];
						}	

						$mustDeleteAnswers = array_diff($storedAnswersIds, $currentAnswersIds);

						//Deleting answers
						for($i = 0; $i < count($mustDeleteAnswers); $i++)
						{
							$this->Answer->delete($mustDeleteAnswers[$i]);
						}

						////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						// End: User is editing a question, check if the user has delete answers (in the GUI) of this question and proceed to delete from database//
						////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					}
					else
					{
						$lastId = $this->Question->getLastInsertID();
					}
					
					foreach($this->request->data['Answer'] as $answer)
					{
						$answer['question_id'] = $lastId;

						if(isset($answer['id']))
						{
							//Request: Edit an Object
							$question = $this->Question->find('first',array('conditions' => array('Question.id' => $answer['question_id'])));
							if($question['Question']['user_id'] != $this->userData['id'])
							{
								$this->Session->setFlash(__("Ocurrio un error!",true));
								$this->redirect(array('controller' => 'Tests','action' => 'index'));
							}
						}
						else
						{
							$this->Answer->create();
						}

						$this->Answer->save($answer);
					}
				} 

				$this->Session->setFlash(__("Acción completada con exito",true));
				if($this->request->data['Question']['test_id'])
				{
					$this->redirect(array('controller' => 'Questions','action' => 'index', $this->request->data['Question']['test_id']));
				}
				else
				{
					$this->redirect(array('controller' => 'Questions','action' => 'all'));
				}
				
			}
			else
			{
				$this->Session->setFlash(__("Ocurrio un error!",true));
				if($this->request->data['Question']['test_id'])
				{
					$this->redirect(array('controller' => 'Questions','action' => 'index', $this->request->data['Question']['test_id']));
				}
				else
				{
					$this->redirect(array('controller' => 'Questions','action' => 'all'));
				}
			}
		}
		else
		{
			$this->redirect(array('controller' => 'Questions','action' => 'index', $this->request->data['Question']['test_id']));
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

			foreach($this->request->data['Question']['id'] as $key => $value)
			{
				//key: question id
				//value: 1 = delete / 0 = dont delete

				$question = $this->Question->find('first',array('conditions' => array('Question.id' => $key)));
				if($question['Question']['user_id'] != $this->userData['id'])
				{
					$this->Session->setFlash(__("Ocurrio un error!",true));
					$this->redirect(array('controller' => 'Tests','action' => 'index'));
				}

				if($value)
				{
					$this->Question->delete($key);
					//Delete answers and images of this question
					$this->Answer->deleteAll(array('Answer.question_id' => $key), false);
					$this->QuestionImage->deleteAll(array('QuestionImage.question_id' => $key), false);
				}
			}

			$this->Session->setFlash(__("Acción completada con exito",true));
			$this->redirect(array('controller' => 'Questions','action' => 'index', $this->request->data['Test']['id']));
		}
		else
		{
			$this->redirect(array('controller' => 'Questions','action' => 'index', $this->request->data['Test']['id']));
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

			$question = $this->Question->find('first',array('conditions' => array('Question.id' => $this->request->data('question'))));

			if($question['Question']['user_id'] != $this->userData['id'])
			{
				return __('No tiene los permisos suficientes', true);
			}

			if($question['Question']['active'])
			{
				$question['Question']['active'] = 0;
			}
			else
			{
				$question['Question']['active'] = 1;
			}

			if($this->Question->save($question))
			{
				echo "Ok";
			}
			else
			{
				echo "Fail";
			}
			
		}
	}

	public function activateQuestion()
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

			$question = $this->Question->find('first',array('conditions' => array('Question.id' => $this->request->data('question'))));

			if($question['Question']['active'])
			{
				$question['Question']['active'] = 0;
			}
			else
			{
				$question['Question']['active'] = 1;
			}

			if($this->Question->save($question))
			{
				echo "Ok";
			}
			else
			{
				echo "Fail";
			}
			
		}
	}

	public function getQuestion()
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

			$question = $this->Question->find('first',array('conditions' => array('Question.id' => $this->request->data('question'))));
			$this->set('question',$question);
			$this->render('/Elements/view_question'); 
		}
	}

	public function editQuestion()
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

			$question = $this->Question->find('first',array('conditions' => array('Question.id' => $this->request->data('question'))));

			if($question['Question']['user_id'] != $this->userData['id'])
			{
				return __('No tiene los permisos suficientes', true);
			}

			$testCategories = $this->TestCategory->find("all",array('order' => 'TestCategory.name ASC', 'conditions' => array('TestCategory.active' => 1)));
			$questionTypes = $this->QuestionType->find("all", array('order' => 'QuestionType.name ASC'));

			$this->set('questionTypes', $questionTypes);
			$this->set('question',$question);
			$this->set("testCategories",$testCategories);
			$this->render('/Elements/edit_question'); 
		}		
	}
}

?>