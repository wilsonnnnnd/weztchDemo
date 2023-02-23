<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Quotes Controller
 *
 * @property \App\Model\Table\QuotesTable $Quotes
 * @method \App\Model\Entity\Quote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuotesController extends AppController
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
        $quotes = $this->paginate($this->Quotes);

        $quotes = $this->Quotes->find('all', ['contain' => ['Customers']])->toList();

        if ($this->request->is('post')) {
            if ($this->request->getData()['btn'] == 'Search') {
                $status = $this->request->getData()['Status'];
                if ($status == '1') {
                    $quotes = $this->Quotes->find('all', ['contain' => ['Customers'], 'conditions' => ['Quotes.status' => '1']])->toList();
                }
                else if ($status == '2') {
                    $quotes = $this->Quotes->find('all', ['contain' => ['Customers'], 'conditions' => ['Quotes.status' => '2']])->toList();
                }
                else if ($status == '0') {
                    $quotes = $this->Quotes->find('all', ['contain' => ['Customers']])->toList();
                }
            }
        }
        $this->set(compact('quotes'));
    }

    /**
     * View method
     *
     * @param string|null $id Quote id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $quote = $this->Quotes->get($id, [
            'contain' => ['Customers'],
        ]);

        $this->set(compact('quote'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quote = $this->Quotes->newEmptyEntity();
        if ($this->request->is('post')) {
            $date_start = $this->request->getData("date");
            $date_expiry = $this->request->getData("expiry");
            $date_end = $this->request->getData("estimated_completion");

            if ($date_start > $date_end || $date_start > $date_expiry) {
                $this->Flash->error(__('Quote Date cannot occur after Estimated Date of Completion or Expiry.'));}
            else{
            $quote = $this->Quotes->patchEntity($quote, $this->request->getData());
            if ($this->Quotes->save($quote)) {
                $this->Flash->success(__('{0} has been saved.', "Q".$quote->id." | Date: ".$quote->date->i18nFormat('dd/MM/yyyy')));

                return $this->redirect(['action' => 'index']);
            }}
            $this->Flash->error(__('The quote could not be saved. Please, try again.'));
        }
        $customers = $this ->Quotes ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u){
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }

        //find the estimatedcosts in quotes and display them



        $customers = $this->Quotes->Customers->find('list', ['limit' => 200]);
        $this->set(compact('quote', 'arr_customers'));
    }

    /**
     * JobRedirectAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function jobredirectadd()
    {
        $quote = $this->Quotes->newEmptyEntity();
        if ($this->request->is('post')) {
            $date_start = $this->request->getData("date");
            $date_expiry = $this->request->getData("expiry");
            $date_end = $this->request->getData("estimated_completion");

            if ($date_start > $date_end || $date_start > $date_expiry) {
                $this->Flash->error(__('Quote Date cannot occur after Estimated Date of Completion or Expiry.'));}
            else{
                $quote = $this->Quotes->patchEntity($quote, $this->request->getData());
                if ($this->Quotes->save($quote)) {
                    $this->Flash->success(__('{0} has been saved.', "Q".$quote->id." | Date: ".$quote->date->i18nFormat('dd/MM/yyyy')));

                    return $this->redirect(['controller' => 'ServiceJobs','action' => 'add']);
                }}
            $this->Flash->error(__('The quote could not be saved. Please, try again.'));
        }
        $customers = $this ->Quotes ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u){
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }

        //find the estimatedcosts in quotes and display them



        $customers = $this->Quotes->Customers->find('list', ['limit' => 200]);
        $this->set(compact('quote', 'arr_customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Quote id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quote = $this->Quotes->get($id, [
            'contain' => ['Customers'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $date_start = $this->request->getData("date");
            $date_expiry = $this->request->getData("expiry");
            $date_end = $this->request->getData("estimated_completion");

            if ($date_start > $date_end || $date_start > $date_expiry) {
                $this->Flash->error(__('Quote Date cannot occur after Estimated Date of Completion or Expiry.'));}
            else{
            $quote = $this->Quotes->patchEntity($quote, $this->request->getData());
            if ($this->Quotes->save($quote)) {
                $this->Flash->success(__('{0} has been saved.', "Q".$quote->id." | Date: ".$quote->date->i18nFormat('dd/MM/yyyy')));

                return $this->redirect(['action' => 'index']);
            }}
            $this->Flash->error(__('The quote could not be saved. Please, try again.'));
        }
        $customers = $this ->Quotes ->Customers ->find() ->all();
        $arr_customers =[];
        //$arr_combine_name=[]
        foreach($customers as $u){
            //$arr_serviceClients[$u->client_id] = $u->combine(first_name, last_name);
            $arr_customers[$u->id] = $u->type_name;
        }

        $customers = $this->Quotes->Customers->find('list', ['limit' => 200]);
        $this->set(compact('quote', 'arr_customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Quote id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quote = $this->Quotes->get($id);
        try {
            if ($this->Quotes->delete($quote)) {
                $this->Flash->delete(__('{0} has been deleted.', "Q".$quote->id." | Date: ".$quote->date->i18nFormat('dd/MM/yyyy')));
            } else {
                $this->Flash->error(__('{0} cannot be deleted while it has related jobs in the system', "Q".$quote->id." | Date: ".$quote->date->i18nFormat('dd/MM/yyyy')));
            }
        }catch (\Exception $e) {
            $this->Flash->error(__('{0} cannot be deleted while it has related jobs in the system', "Q".$quote->id." | Date: ".$quote->date->i18nFormat('dd/MM/yyyy')));

        }

        return $this->redirect(['action' => 'index']);
    }


    public function export()
    {

        //Qoute content
        $this->loadModel('Quotes');
        $quotes = $this->Quotes->find('all',array('fields' => array('Quotes.id', 'Quotes.cust_id', 'Quotes.heading', 'Quotes.date', 'Quotes.expiry', 'Quotes.estimated_completion', 'Quotes.estimated_total', 'Quotes.estimated_cost', 'Quotes.gst', 'Quotes.description', 'Quotes.items_required')))->toArray();

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

        $array = json_decode(json_encode($quotes), true);

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

        $hearder= ['ID','CUSTOMER','HEADING','DATE','EXPIRY','EST COMPLETION','EST TOTAL','EST COST','GST','DESCRIPTION','ITEMS REQUIRED'];
        $this->setResponse($this->getResponse()->withDownload('weztech_quotes.csv'));
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
