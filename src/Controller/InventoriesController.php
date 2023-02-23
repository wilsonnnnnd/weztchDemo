<?php
declare(strict_types=1);

namespace App\Controller;

use phpDocumentor\Reflection\Types\String_;

/**
 * Inventories Controller
 *
 * @property \App\Model\Table\InventoriesTable $Inventories
 * @property \App\Model\Table\patsTable $Parts
 * @method \App\Model\Entity\Inventory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @method \App\Model\Entity\Part[]|\Cake\Datasource\ResultSetInterface paginatepart($object = null, array $settings = [])
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
        $inventories = $this->Inventories->find()->toList();
        //Count the Categories
        $this->loadModel('Parts');
        $parts_Category=$this->Parts->find('all',['conditions'=>'status = 1'])->toList();
        $parts_Category_Arr = [];
        foreach ($parts_Category as $pc) {
            array_push($parts_Category_Arr, trim(strval($pc->inv_id)));
        }

        //get max id in Inventories
        $last_id_no = $this->Inventories->find()->toList();
        $last_id_no_arr = [];
        foreach ($last_id_no as $ic) {
            array_push($last_id_no_arr, trim(strval($ic->id)));
        }
        $max_id = max($last_id_no_arr);

        //create a new array
        $arr_of_inventories_Category_old = array_fill(1, intval($max_id), 0);
        $arr_of_inventories_Category = array_count_values($parts_Category_Arr);
        arsort($arr_of_inventories_Category);
        $new = array_replace($arr_of_inventories_Category_old,$arr_of_inventories_Category);


        $this->set(compact('inventories','new'));
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
                $this->Flash->success(__('{0} has been saved.', $inventory->brand." ".$inventory->name." ".$inventory->type));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory category could not be saved. Please, try again.'));
        }
        $this->set(compact('inventory'));
    }

    /**
     * PartsRedirectAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function partsredirectadd()
    {
        $inventory = $this->Inventories->newEmptyEntity();
        if ($this->request->is('post')) {
            $inventory = $this->Inventories->patchEntity($inventory, $this->request->getData());
            if ($this->Inventories->save($inventory)) {
                $this->Flash->success(__('{0} has been saved.', $inventory->brand." ".$inventory->name." ".$inventory->type));

                return $this->redirect(['controller' => 'Parts','action' => 'add']);
            }
            $this->Flash->error(__('The inventory category could not be saved. Please, try again.'));
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
                $this->Flash->success(__('{0} has been saved.', $inventory->brand." ".$inventory->name." ".$inventory->type));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory category could not be saved. Please, try again.'));
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
        try {
            if ($this->Inventories->delete($inventory)) {
                $this->Flash->delete(__('{0} has been deleted.', $inventory->brand . " " . $inventory->name . " " . $inventory->type));
            } else {
                $this->Flash->error(__('{0} could not be deleted. Please, try again.', $inventory->brand . " " . $inventory->name . " " . $inventory->type));
            }
        }catch (\Exception $e) {
            $this->Flash->error(__('{0} cannot be deleted while it has related items in the system', $inventory->brand." ".$inventory->name." ".$inventory->type));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export()
    {
        $this->setResponse($this->getResponse()->withDownload('weztech_inventory_categories.csv'));
       // $_header = array('id', 'Type', 'First Name','Last Name', 'Gender', 'Business','ABN', 'Phone Number', 'Email','Street', 'City', 'State','Postcode', 'Intro Method', 'Pref Contact','Description', 'Created', 'Modified');
        $data = $this ->Inventories ->find()->select([
            'Inventories.name', 'Inventories.part_no', 'Inventories.retail_price','Inventories.type','Inventories.brand','Inventories.description'

        ]);
        $serialize = ['data'];

        $extract = array('Inventories.name', 'Inventories.part_no', 'Inventories.retail_price','Inventories.type','Inventories.brand','Inventories.description');


        $header = ['NAME','PART NO.','RETAIL PRICE','TYPE','BRAND','DESCRIPTION'];
        $this->set(compact('data'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => 'data',
                $serialize,
                'header' => $header,
                'extract',
            ]);
    }
}
