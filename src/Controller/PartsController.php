<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Parts Controller
 *
 * @property \App\Model\Table\PartsTable $Parts
 * @method \App\Model\Entity\Parts[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartsController extends AppController
{



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Inventories', 'ServiceJobs', 'Receipts'],
        ];
        $parts = $this->paginate($this->Parts);
        $parts=$this->Parts->find('all',['contain' =>['ServiceJobs', 'Inventories', 'Receipts'],'conditions'=>['Parts.status'=>'1']])->toList();
        $this->set(compact('parts'));
    }

    /**
     * Archive method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function archive()
    {
        $this->paginate = [
            'contain' => ['Inventories', 'ServiceJobs', 'Receipts'],
        ];
        $parts = $this->paginate($this->Parts);
        $parts=$this->Parts->find('all',['contain' =>['ServiceJobs', 'Inventories', 'Receipts'],'conditions'=>['Parts.status'=>'2']])->toList();
        $this->set(compact('parts'));
    }

    /**
     * View method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => ['Inventories', 'ServiceJobs', 'Receipts'],
        ]);

        $this->set(compact('part'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quantity = $this->request->getData("quantity");

        $arr_inventories = $this->Parts->Inventories->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->brand." ".$row->name." ".$row->type;}]);
        $arr_receipts = $this->Parts->Receipts->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return "ID: R".$row->id." | Date: ".$row->date->i18nFormat('dd/MM/yyyy')." | Source: ".$row->purchase_source." | Total Price: $".$row->total_price;}]);
        $serviceJobs = $this->Parts->ServiceJobs->find('list', ['limit' => 200]);
        $part = $this->Parts->newEmptyEntity();
        $this->set(compact('part', 'arr_inventories', 'serviceJobs', 'arr_receipts'));
       for ($i = 1; $i <= $quantity; $i++) {
        $partnew = $this->Parts->newEmptyEntity();
            if ($this->request->is('post')) {
                $partnew = $this->Parts->patchEntity($partnew, $this->request->getData());
                if ($this->Parts->save($partnew)) {

                }
                else $this->Flash->error(__('The inventory item could not be saved. Please, try again.'));

                if ($quantity == $i) {
                    $this->Flash->success(__('The new inventory items have been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }

        }
    }

    /**
     * Add2 method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add2()
    {
        $quantity = $this->request->getData("quantity");

        $arr_inventories = $this->Parts->Inventories->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->brand." ".$row->name." ".$row->type;}]);
        $arr_receipts = $this->Parts->Receipts->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return "ID: R".$row->id." | Date: ".$row->date->i18nFormat('dd/MM/yyyy')." | Source: ".$row->purchase_source." | Total Price: $".$row->total_price;}]);
        $serviceJobs = $this->Parts->ServiceJobs->find('list', ['limit' => 200]);
        $part = $this->Parts->newEmptyEntity();
        $this->set(compact('part', 'arr_inventories', 'serviceJobs', 'arr_receipts'));
        for ($i = 1; $i <= $quantity; $i++) {
            $partnew = $this->Parts->newEmptyEntity();
            if ($this->request->is('post')) {
                $partnew = $this->Parts->patchEntity($partnew, $this->request->getData());
                if ($this->Parts->save($partnew)) {

                }
                else $this->Flash->error(__('The inventory item could not be saved. Please, try again.'));

                if ($quantity == $i) {
                    $this->Flash->success(__('The new inventory items have been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The inventory item {0} has been saved.', "P".$part->id));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory item {0} could not be saved.', "P".$part->id));
        }
        $arr_inventories = $this->Parts->Inventories->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->brand." ".$row->name." ".$row->type;}]);
        $serviceJobs = $this->Parts->ServiceJobs->find('list', ['limit' => 200]);
        $receipts = $this->Parts->Receipts->find('list', ['limit' => 200]);
        $this->set(compact('part', 'arr_inventories', 'serviceJobs', 'receipts'));
    }

    /**
     * Edit 2 method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit2($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The inventory item {0} has been added to the job and archived.', "P".$part->id));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory item {0} could not be saved.', "P".$part->id));
        }
        $arr_inventories = $this->Parts->Inventories->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->brand." ".$row->name." ".$row->type;}]);
        $arr_serviceJobs = $this->Parts->ServiceJobs->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return "ID: J".$row->id." | Instrument: ".$row->instrument->instrument_name." | Start Date: ".$row->date_started->i18nFormat('dd/MM/yy');}])->contain(['Instruments']);
        $receipts = $this->Parts->Receipts->find('list', ['limit' => 200]);
        $this->set(compact('part', 'arr_inventories', 'arr_serviceJobs', 'receipts'));
    }

    /**
     * Edit 3 method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit3($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $part = $this->Parts->patchEntity($part, $this->request->getData());
            $part->job_id = null;
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The inventory item {0} has been unarchived.', "P".$part->id));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inventory item {0} could not be saved.', "P".$part->id));
        }
        $arr_inventories = $this->Parts->Inventories->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->brand." ".$row->name." ".$row->type;}]);
        $arr_serviceJobs = $this->Parts->ServiceJobs->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return "ID: J".$row->id." | Instrument: ".$row->instrument->instrument_name." | Start Date: ".$row->date_started->i18nFormat('dd/MM/yy');}])->contain(['Instruments']);
        $receipts = $this->Parts->Receipts->find('list', ['limit' => 200]);
        $this->set(compact('part', 'arr_inventories', 'arr_serviceJobs', 'receipts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Part id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $part = $this->Parts->get($id);
        if ($this->Parts->delete($part)) {
            $this->Flash->success(__('The inventory item {0} has been deleted', "P".$part->id));
        } else {
            $this->Flash->error(__('The inventory item {0} could not be deleted, please try again.', "P".$part->id));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function deleteAll()
    {
        $this->request->allowMethod(['post', 'delete']);
        $ids = $this ->request ->getData('ids');

        if ($ids === null){
            $this->Flash->error(__('Please select again, do not use searching and deleting at the same time.'));
            return $this->redirect(['action' => 'index']);
        }

        if( $this-> Parts ->deleteAll(['Parts.id IN'=>$ids])){
            $this->Flash->success(__('The inventory items have been deleted.'));
        }
        else{
            $this->Flash->error(__('No items selected, please try again.'));
        }
        return $this->redirect(['action' => 'index']);

    }

    public function deleteAll1()
    {

        $this->request->allowMethod(['post', 'delete']);
        $ids = $this ->request->getData('ids');
        if ($ids === null){
            $this->Flash->error(__('Plz select again, do not use searching and deleting at the same time.'));
            return $this->redirect(['action' => 'index']);
        }

         if( $this-> Parts ->deleteAll(['Parts.id IN'=>$ids])){
            $this->Flash->success(__('The inventory items have been deleted'));
         }
         else {
            $this->Flash->error(__('No items selected , please try again.'));
        }
         return $this->redirect(['action' => 'archive']);
    }

    public function export()
    {
        //Part content
        $this->loadModel('Parts');
        $parts = $this->Parts->find('all',array('fields' => array('Parts.inv_id', 'Parts.job_id', 'Parts.rec_id', 'Parts.serial_no', 'Parts.individual_price', 'Parts.markup', 'Parts.price_markup')))->toArray();

        //set null value to N/A
        $enclosure = 'N/A ';
        //Get customer content
        $this->loadModel('Inventories');
        $inventories = $this->Inventories->find()->toList();
        $inventoriesArr = [];
        $inventoriesidArr = [];
        foreach ($inventories as $c) {
            array_push($inventoriesArr, trim($c->inv_cate));
            array_push($inventoriesidArr, trim($c->full_id));
        }
        $inv_Arr = array_combine($inventoriesidArr,$inventoriesArr);

        $array = json_decode(json_encode($parts), true);

        foreach($array as &$item){
            settype($item['inv_id'], "string");

            //array_search($item['cust_id'],array_column($cust_Arr, $item['cust_id']))
            if((array_key_exists(intval($item['inv_id']), $inv_Arr))){
                $item['inv_id'] = strval( $inv_Arr[$item['inv_id']]);
            }else{
                $item['inv_id'] ='';
            }

        }

        $serialize = ['array'];

        $hearder= ['CATEGORY','JOB ID','REC ID','SERIAL NO.','PRICE','MARKUP %','MARKED UP PRICE'];
        $this->setResponse($this->getResponse()->withDownload('weztech_inventory_items.csv'));
        $this->set(compact('array'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => 'array',
                $serialize,
                'header' => $hearder,
                'enclosure ',
            ]);

    }



}
