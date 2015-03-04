<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('Sanitize', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Paginator','Cookie','Session','RequestHandler','Ctrl','Paginator');
	public $helpers = array('Html','Session','Form','Time','Paginator');

	private $acl = true; //Access Control List
	public $userData = "";

	public $allowPaths = array(
				'users' => array('login'),
		);

	public $studentPaths = array(
				'users' => array('logout','settings'),
				'tests' => array('home','display','process','resumen','scores'),
				'questions' => array(),
				'resources' => array('view','getresource'),
				'default' => array('controller' => 'tests', 'action' => 'home'),
		);

	public $professorPaths = array(
				'pages' => array(),
				'users' => array('logout','settings'),
				'tests' => array('index','create','delete','activate','edittest','add'),
				'questions' => array('index','create','delete','activate','getquestion','editquestion','all'),
				'resources' => array('test','add','getresource','deleteresources'),
				'default' => array('controller' => 'tests', 'action' => 'index'),
		);

	public $administratorPaths = array(
				'pages' => array(),
				'users' => array('logout','index','create','delete','activate','edituser','settings','loadstudents'),
				'tests' => array('all','activatetest','assign','unassign','testresumen','studentscores','deletescores'),
				'testcategories' => array('index','create','delete','activate','edittestcategory'),
				'questions' => array('viewquestions','getquestion','activatequestion','allquestions'),
				'resources' => array('index','create','delete','activate','getresource','editresource'),
				'default' => array('controller' => 'users', 'action' => 'index'),
			);

	public function beforeFilter()
	{
		$localParams['controller'] = str_replace("_", "", strtolower($this->request->params['controller']));
		$localParams['action'] = str_replace("_", "", strtolower($this->request->params['action']));

		$aControllers = $this->Ctrl->get();

		$breadcrumbs = $this->request->params;
		$this->set('breadcrumbs',$breadcrumbs);

		if($this->acl)
		{
			if($this->Session->check('User'))
			{
				//have active session

				$this->userData = $this->Session->read('User'); 

				switch($this->Session->read('User.group_id'))
				{
					case 1:
						//Administrator
						if(!array_key_exists($localParams['controller'], $this->administratorPaths))
						{
							$this->redirect($this->administratorPaths['default']);
						}
						else
						{
							if(!in_array($localParams['action'], $this->administratorPaths[$localParams['controller']]))
							{
								$this->redirect($this->administratorPaths['default']);
							}
						}
						$this->userData['default'] = $this->administratorPaths['default'];
					break;

					case 2:
						//Professor
						if(!array_key_exists($localParams['controller'], $this->professorPaths))
						{
							$this->redirect($this->professorPaths['default']);
						}
						else
						{
							if(!in_array($localParams['action'], $this->professorPaths[$localParams['controller']]))
							{
								$this->redirect($this->professorPaths['default']);
							}
						}
						$this->userData['default'] = $this->professorPaths['default'];
					break;

					case 3:
						//Student
						if(!array_key_exists($localParams['controller'], $this->studentPaths))
						{
							$this->redirect($this->studentPaths['default']);
						}
						else
						{
							if(!in_array($localParams['action'], $this->studentPaths[$localParams['controller']]))
							{
								$this->redirect($this->studentPaths['default']);
							}
						}
						$this->userData['default'] = $this->studentPaths['default'];
					break;

					default:
						//default behaviour
						$this->redirect(array('controller' => 'Users','action' => 'logout'));
				}
			}
			else
			{
				//Dont have an active session
				if(!array_key_exists($localParams['controller'], $this->allowPaths))
				{
					$this->redirect(array('controller' => 'Users','action' => 'login'));
				}
				else
				{
					if(!in_array($localParams['action'], $this->allowPaths[$localParams['controller']]))
					{
						$this->redirect(array('controller' => 'Users','action' => 'login'));
					}
				}
			}			
		}
	}	
}