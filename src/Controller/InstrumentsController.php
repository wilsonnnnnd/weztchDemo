<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Instruments Controller
 *
 * @property \App\Model\Table\InstrumentsTable $Instruments
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstrumentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers'],
        ];
        $instruments = $this->paginate($this->Instruments);
        $instruments = $this->Instruments->find('all',['contain' =>['Customers']])->toList();

        $this->set(compact('instruments'));
    }

    /**
     * View method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $instrument = $this->Instruments->get($id, [
            'contain' => ['Customers'],
        ]);

        $this->set(compact('instrument'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $instrument = $this->Instruments->newEmptyEntity();
        if ($this->request->is('post')) {
            $instrument = $this->Instruments->patchEntity($instrument, $this->request->getData());
//            $instrument->last_serviced=$this->request->getData()['last_serviced'];
          //  debug($this->request->getData());
          //  debug($instrument);
           // debug($this->Instruments->save($instrument));
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('{0} has been saved.', $instrument->year.' '.$instrument->brand.' '.$instrument->model));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
        }
        $customers = $this ->Instruments ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u){
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }

        $customers = $this->Instruments->Customers->find('list', ['limit' => 200]);
        $this->set(compact('instrument', 'arr_customers'));
    }

    /**
     * JobRedirectAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function jobredirectadd()
    {
        $instrument = $this->Instruments->newEmptyEntity();
        if ($this->request->is('post')) {
            $instrument = $this->Instruments->patchEntity($instrument, $this->request->getData());
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('{0} has been saved.', $instrument->year.' '.$instrument->brand.' '.$instrument->model));

                return $this->redirect(['controller' => 'ServiceJobs','action' => 'add']);
            }
            $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
        }
        $customers = $this ->Instruments ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u){
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }

        $customers = $this->Instruments->Customers->find('list', ['limit' => 200]);
        $this->set(compact('instrument', 'arr_customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $instrument = $this->Instruments->get($id, [
            'contain' => ['Customers'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $instrument = $this->Instruments->patchEntity($instrument, $this->request->getData());
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('{0} has been saved.', $instrument->year.' '.$instrument->brand.' '.$instrument->model));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
        }
        $customers = $this ->Instruments ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u){
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }

        $customers = $this->Instruments->Customers->find('list', ['limit' => 200]);
        $this->set(compact('instrument', 'arr_customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instrument = $this->Instruments->get($id);
        try {
            if ($this->Instruments->delete($instrument)) {
                $this->Flash->delete(__('{0} has been deleted.', $instrument->year.' '.$instrument->brand.' '.$instrument->model));
            } else {
                $this->Flash->error(__('{0} cannot be deleted while it has related jobs in the system', $instrument->year.' '.$instrument->brand.' '.$instrument->model));
            }
        }catch (\Exception $e) {
            $this->Flash->error(__('{0} cannot be deleted while it has related jobs in the system', $instrument->year.' '.$instrument->brand.' '.$instrument->model));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export()
    {

        //Qoute content
        $this->loadModel('Instruments');
        $instruments = $this->Instruments->find('all',array('fields' => array('Instruments.id', 'Instruments.cust_id', 'Instruments.type', 'Instruments.model', 'Instruments.brand', 'Instruments.serial_number', 'Instruments.country', 'Instruments.year', 'Instruments.last_serviced', 'Instruments.description')))->toArray();

        //set null value to N/A
        $enclosure = 'N/A ';
        //Get customer content
        $this->loadModel('Customers');
        $customers = $this->Customers->find()->toList();
        $customersArr = [];
        $customersidArr = [];
        foreach ($customers as $c) {
            array_push($customersArr, trim($c->type_name));
            array_push($customersidArr, trim($c->full_id));
        }
        $cust_Arr = array_combine($customersidArr,$customersArr);

        $array = json_decode(json_encode($instruments), true);

        foreach($array as &$item){
            settype($item['cust_id'], "string");

            //array_search($item['cust_id'],array_column($cust_Arr, $item['cust_id']))
            if((array_key_exists(intval($item['cust_id']), $cust_Arr))){
                $item['cust_id'] = strval( $cust_Arr[$item['cust_id']]);
            }else{
                $item['cust_id'] ='';
            }

        }

        $serialize = ['array'];

        $hearder= ['ID','CUSTOMER','TYPE','MODEL','BRAND','SERIAL_NUMBER','COUNTRY','YEAR','LAST SERVICED','DESCRIPTION'];
        $this->setResponse($this->getResponse()->withDownload('weztech_instruments.csv'));
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
