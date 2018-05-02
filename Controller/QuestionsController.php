<?php
App::uses('AppController', 'Controller');
/**
 * Questions Controller
 *
 * @property Question $Question
 * @property PaginatorComponent $Paginator
 */
class QuestionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Question->recursive = 0;
		$this->set('questions', $this->Paginator->paginate());
        $this->set('score', $this->Question->find('count', array('conditions' => (array('completed' => 1)))));
	}
	
    public function manage(){
        $this->Question->recursive = 0;
        $this->set('questions', $this->Paginator->paginate());
        $this->set('score', $this->Question->find('count', array('conditions' => (array('completed' => 1)))));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Question->exists($id)) {
			throw new NotFoundException(__('Invalid question'));
		}
		$options = array('conditions' => array('Question.' . $this->Question->primaryKey => $id));
		$this->set('question', $this->Question->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Question->create();
			if ($this->Question->save($this->request->data)) {
				$this->Flash->success(__('The question has been saved.'));
				return $this->redirect(array('controller' => 'answers', 'action' => 'add'));
			} else {
				$this->Flash->error(__('The question could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Question->exists($id)) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Question->save($this->request->data)) {
				$this->Flash->success(__('The question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Question.' . $this->Question->primaryKey => $id));
			$this->request->data = $this->Question->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Question->delete()) {
			$this->Flash->success(__('The question has been deleted.'));
		} else {
			$this->Flash->error(__('The question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function start(){
        $random_question = $this->Question->find('first', array(
                                                                'conditions' => array('completed' => 0),
                                                                'order' => 'rand()'
                                                                ));
        if (!$random_question){
            $this->Flash->success(__('Congratulations, you finished all of the quiz!'));
            $this->redirect(array('action' => 'index'));
        }
        else {
            $this->set('random_question',$random_question);
        }
        $this->set('score', $this->Question->find('count', array('conditions' => (array('completed' => 1)))));
        
	}
	
	public function answer($id){
		$answered = $this->request->data['Question']['Choose'];
		$answer = $this->Question->Answer->field('correct', array('question_id' => $id));
        if ($answer == $answered){
            if($this->Question->save(array('id' => $id, 'completed'=> 1))){
                $this->Flash->success(__('Great answer! Your score was increased by 1.'));
            }
            return $this->redirect(array('action' => 'start'));
        }
        else {
            $this->Flash->error(__('Unfortunately your answer was wrong. Please try again.'));
            return $this->redirect(array('action' => 'start'));
        }
    }
    
    public function plain(){
    }
 
    public function reset(){
        if($this->Question->updateAll(array('completed'=> 0))){
            $this->Flash->success(__('Your score has been reset to 0.'));
        }
        $this->redirect(array('action' => 'index'));
    }
}
