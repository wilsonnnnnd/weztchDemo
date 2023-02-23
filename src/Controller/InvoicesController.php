<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 * @method \App\Model\Entity\Invoice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvoicesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'ServiceJobs'],
        ];
        $invoices = $this->paginate($this->Invoices);

        $invoices=$this->Invoices->find('all',['contain' =>['Customers', 'ServiceJobs']])->toList();

        if ($this->request->is('post')) {
            if($this->request->getData()['btn']=='Search'){
                $status=$this->request->getData()['Status'];
                if($status=='1'){
                    $invoices=$this->Invoices->find('all',['contain' =>['Customers', 'ServiceJobs'],'conditions'=>['Invoices.status'=>'1']])->toList();
                }
                else if($status=='2'){
                    $invoices=$this->Invoices->find('all',['contain' =>['Customers', 'ServiceJobs'],'conditions'=>['Invoices.status'=>'2']])->toList();
                }
                else if($status=='0'){
                    $invoices=$this->Invoices->find('all',['contain' =>['Customers', 'ServiceJobs']])->toList();
                }
            }

        }
        $this->set(compact('invoices'));
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Customers', 'ServiceJobs'],
        ]);

        $this->set(compact('invoice'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoice = $this->Invoices->newEmptyEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('{0} has been saved.', "i".$invoice->id. " (Invoice Date: ".$invoice->invoice_date.")"));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $customers = $this->Invoices->Customers->find()->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u){
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }
        $arr_serviceJobs = $this->Invoices->ServiceJobs->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return "ID: J".$row->id." | Instrument: ".$row->instrument->instrument_name." | Start Date: ".$row->date_started->i18nFormat('dd/MM/yy');}])->contain(['Instruments']);
        $customers = $this->Invoices->Customers->find('list', ['limit' => 200]);
        $this->set(compact('invoice',  'arr_serviceJobs','arr_customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Customers'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('{0} has been saved.', "i".$invoice->id. " (Invoice Date: ".$invoice->invoice_date.")"));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $customers = $this ->Invoices ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u) {
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }
        $arr_serviceJobs = $this->Invoices->ServiceJobs->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return "ID: J".$row->id." | Instrument: ".$row->instrument->instrument_name." | Start Date: ".$row->date_started->i18nFormat('dd/MM/yy');}])->contain(['Instruments']);
        $this->set(compact('invoice', 'customers', 'arr_serviceJobs','arr_customers'));
    }

    /**
     * Edit2 method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit2($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Customers'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('{0} has been saved.', "i".$invoice->id. " (Invoice Date: ".$invoice->invoice_date.")"));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $customers = $this ->Invoices ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u) {
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }
        $arr_serviceJobs = $this->Invoices->ServiceJobs->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return "ID: J".$row->id." | Instrument: ".$row->instrument->instrument_name." | Start Date: ".$row->date_started->i18nFormat('dd/MM/yy');}])->contain(['Instruments']);
        $this->set(compact('invoice', 'customers', 'arr_serviceJobs','arr_customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($id);
        try{
        if ($this->Invoices->delete($invoice)) {
            $this->Flash->delete(__('{0} has been deleted.', "i".$invoice->id. " (Invoice Date: ".$invoice->invoice_date.")"));
        } else {
            $this->Flash->error(__('{0} could not be deleted. Please, try again.', "i".$invoice->id. " (Invoice Date: ".$invoice->invoice_date.")"));
        }
        }catch (\Exception $e) {
            $this->Flash->error(__('{0} could not be deleted. Please, try again.', "i".$invoice->id. " (Invoice Date: ".$invoice->invoice_date.")"));

        }

        return $this->redirect(['action' => 'index']);
    }
//    public function beforeFilter(Event $event) {
//        if (in_array($this->request->action, ['servicejob'])) {
//            $this->eventManager()->off($this->Csrf);
//        }
//    }

    public function servicejob($custid = null){
        $this->loadModel('ServiceJobs');
        $this->loadModel('Quotes');
        $this->loadModel('Instruments');
        $serviceJobs = $this->Invoices->ServiceJobs->find('all',['conditions'=>['Quotes.cust_id'=>$custid]])->contain(['Quotes','Instruments']);
        $this->set(compact('serviceJobs'));
    }


    public function export()
    {

        //Invoice content
        $this->loadModel('Invoices');
        $invoices = $this->Invoices->find('all',array('fields' => array('Invoices.id', 'Invoices.cust_id', 'Invoices.job_id', 'Invoices.heading', 'Invoices.invoice_date', 'Invoices.payment_date', 'Invoices.total_due', 'Invoices.amount_due', 'Invoices.gst', 'Invoices.description')))->toArray();

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

        $array = json_decode(json_encode($invoices), true);

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

        $hearder= ['ID','CUSTOMER','JOB ID','HEADING','INVOICE DATE','PAYMENT DATE','TOTAL DUE','AMOUNT DUE','GST','DESCRIPTION'];
        $this->setResponse($this->getResponse()->withDownload('weztech_invoices.csv'));
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
