<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * JobTasks Controller
 *
 * @property \App\Model\Table\JobTasksTable $JobTasks
 * @method \App\Model\Entity\JobTask[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobTasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $jobTasks = $this->paginate($this->JobTasks);

        $this->set(compact('jobTasks'));
    }

    /**
     * View method
     *
     * @param string|null $id Job Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jobTask = $this->JobTasks->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('jobTask'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jobTask = $this->JobTasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $jobTask = $this->JobTasks->patchEntity($jobTask, $this->request->getData());
            if ($this->JobTasks->save($jobTask)) {
                $this->Flash->success(__('The job task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job task could not be saved. Please, try again.'));
        }
        $this->set(compact('jobTask'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jobTask = $this->JobTasks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jobTask = $this->JobTasks->patchEntity($jobTask, $this->request->getData());
            if ($this->JobTasks->save($jobTask)) {
                $this->Flash->success(__('The job task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job task could not be saved. Please, try again.'));
        }
        $this->set(compact('jobTask'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job Task id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jobTask = $this->JobTasks->get($id);
        if ($this->JobTasks->delete($jobTask)) {
            $this->Flash->success(__('The job task has been deleted.'));
        } else {
            $this->Flash->error(__('The job task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
