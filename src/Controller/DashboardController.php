<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Inventories Controller
 *
 * @property \App\Model\Table\InventoriesTable $Inventories
 * @method \App\Model\Entity\Inventory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InventoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $inventories = $this->paginate($this->Inventories);

        $this->set(compact('inventories'));
    }

    /**
     * View method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inventory = $this->Inventories->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('inventory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inventory = $this->Inventories->newEmptyEntity();
        if ($this->request->is('post')) {
            $inventory = $this->Inventories->patchEntity($inventory, $this->request->getData());
            if ($this->Inventories->save($inventory)) {
                $this->Flash->success(__('The inventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory could not be saved. Please, try again.'));
        }
        $this->set(compact('inventory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inventory = $this->Inventories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inventory = $this->Inventories->patchEntity($inventory, $this->request->getData());
            if ($this->Inventories->save($inventory)) {
                $this->Flash->success(__('The inventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory could not be saved. Please, try again.'));
        }
        $this->set(compact('inventory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inventory id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inventory = $this->Inventories->get($id);
        if ($this->Inventories->delete($inventory)) {
            $this->Flash->success(__('The inventory has been deleted.'));
        } else {
            $this->Flash->error(__('The inventory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
