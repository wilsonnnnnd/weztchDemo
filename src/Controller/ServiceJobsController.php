<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ServiceJobs Controller
 *
 * @property \App\Model\Table\ServiceJobsTable $ServiceJobs
 * @method \App\Model\Entity\ServiceJob[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServiceJobsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Instruments','Instruments.Customers', 'Quotes','Quotes.Customers'],
        ];
        $serviceJobs = $this->paginate($this->ServiceJobs);

        $serviceJobs=$this->ServiceJobs->find('all',['contain' =>['Instruments','Instruments.Customers', 'Quotes','Quotes.Customers']])->toList();

        if ($this->request->is('post')) {
            if($this->request->getData()['btn']=='Search'){
                $status=$this->request->getData()['Status'];
                if($status=='1'){
                    $serviceJobs=$this->ServiceJobs->find('all',['contain' =>['Instruments','Instruments.Customers', 'Quotes','Quotes.Customers'],'conditions'=>['ServiceJobs.status'=>'1']])->toList();
                }
                else if($status=='2'){
                    $serviceJobs=$this->ServiceJobs->find('all',['contain' =>['Instruments','Instruments.Customers', 'Quotes','Quotes.Customers'],'conditions'=>['ServiceJobs.status'=>'2']])->toList();
                }
                else if($status=='3'){
                    $serviceJobs=$this->ServiceJobs->find('all',['contain' =>['Instruments','Instruments.Customers', 'Quotes','Quotes.Customers'],'conditions'=>['ServiceJobs.status'=>'3']])->toList();
                }
                else if($status=='0'){
                    $serviceJobs=$this->ServiceJobs->find('all',['contain' =>['Instruments','Instruments.Customers', 'Quotes','Quotes.Customers']])->toList();
                }
            }
        }

            $this->set(compact('serviceJobs'));
    }

    /**
     * View method
     *
     * @param string|null $id Service Job id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $serviceJob = $this->ServiceJobs->get($id, [
            'contain' => ['Instruments', 'Quotes'],
        ]);

        $this->set(compact('serviceJob'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $serviceJob = $this->ServiceJobs->newEmptyEntity();
        if ($this->request->is('post')) {
            $date_start = $this->request->getData("date_started");
            $date_end = $this->request->getData("date_completed");

            if ($date_end != null && $date_start > $date_end) {
                $this->Flash->error(__('Date completed cannot occur before date started.'));}
            else{
//                var_dump($this->request->getData('quo_id'));die;
                $serviceJob = $this->ServiceJobs->patchEntity($serviceJob, $this->request->getData());
                $this->loadModel('Quotes');
                $quotes=$this->Quotes->get($this->request->getData('quo_id'));

                $quotes = $this->Quotes->patchEntity($quotes, ['status' => 2]);
                $this->Quotes->save($quotes);

                if ($this->ServiceJobs->save($serviceJob)) {
                    $this->Flash->success(__('{0} has been saved.', "J".$serviceJob->id." | Date: ".$serviceJob->date_started->i18nFormat('dd/MM/yyyy')));

                    return $this->redirect(['action' => 'index']);
                }}
            $this->Flash->error(__('The service job could not be saved. Please, try again.'));
        }
        $instruments = $this->ServiceJobs->Instruments->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->customer->type_name."'s ".$row->year." ".$row->brand." ".$row->model." ".$row->type;}])->contain(['Customers']);
        $quotes = $this->ServiceJobs->Quotes->find('list',['keyField' => 'id', 'valueField' => function ($row) {return "ID: Q".$row->id." | Name: ".$row->customer->type_name." | Date: ".$row->date->i18nFormat('dd/MM/yyyy');}])->contain(['Customers']);
        $this->set(compact('serviceJob', 'instruments','quotes'));
    }

    /**
     * Add2 method
     * @param string|null $id Quote id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add2($id)
    {
        $this->loadModel('Quotes');
        $quotes=$this->Quotes->get($id);
        $this->set('quotes',$quotes);

        $this->loadModel('Instruments');
        $instruments=$this->Quotes->get($id);
        $this->set('instruments',$instruments);

        $serviceJob = $this->ServiceJobs->newEmptyEntity();
        if ($this->request->is('post')) {
            $date_start = $this->request->getData("date_started");
            $date_end = $this->request->getData("date_completed");

            if ($date_end != null && $date_start > $date_end) {
                $this->Flash->error(__('Date completed cannot occur before date started.'));}
            else{

                $serviceJob = $this->ServiceJobs->patchEntity($serviceJob, $this->request->getData());
                $quotes=$this->Quotes->get($this->request->getData('quo_id'));
                $quotes = $this->Quotes->patchEntity($quotes, ['status' => 2]);
                $this->Quotes->save($quotes);
                if ($this->ServiceJobs->save($serviceJob)) {
                    $this->Flash->success(__('{0} has been saved.', "J".$serviceJob->id." | Date: ".$serviceJob->date_started->i18nFormat('dd/MM/yyyy')));

                    return $this->redirect(['action' => 'index']);
                }}
            $this->Flash->error(__('The service job could not be saved. Please, try again.'));
        }
        $instruments = $this->ServiceJobs->Instruments->find('list', ["conditions" => ["Instruments.cust_id" => $quotes->cust_id],'keyField' => 'id', 'valueField' => function ($row) {return $row->customer->type_name."'s ".$row->year." ".$row->brand." ".$row->model." ".$row->type;}])->contain(['Customers']);
        $quotes = $this->ServiceJobs->Quotes->find('list',['conditions' => array('Quotes.id' => $id),'keyField' => 'id','valueField' => function ($row) {return "ID: Q".$row->id." | Name: ".$row->customer->type_name." | Date: ".$row->date->i18nFormat('dd/MM/yyyy');}])->contain(['Customers']);
        $this->set(compact('serviceJob', 'instruments','quotes'));
    }

    /**
     * InvoiceRedirectAdd method
     * @param string|null $id Quote id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function invoiceredirectadd()
    {
        $serviceJob = $this->ServiceJobs->newEmptyEntity();
        if ($this->request->is('post')) {
            $date_start = $this->request->getData("date_started");
            $date_end = $this->request->getData("date_completed");

            if ($date_end != null && $date_start > $date_end) {
                $this->Flash->error(__('Date completed cannot occur before date started.'));}
            else{
//                var_dump($this->request->getData('quo_id'));die;
                $serviceJob = $this->ServiceJobs->patchEntity($serviceJob, $this->request->getData());
                $this->loadModel('Quotes');
                $quotes=$this->Quotes->get($this->request->getData('quo_id'));

                $quotes = $this->Quotes->patchEntity($quotes, ['status' => 2]);
                $this->Quotes->save($quotes);

                if ($this->ServiceJobs->save($serviceJob)) {
                    $this->Flash->success(__('{0} has been saved.', "J".$serviceJob->id." | Date: ".$serviceJob->date_started->i18nFormat('dd/MM/yyyy')));

                    return $this->redirect(['controller' => 'Invoices','action' => 'add']);
                }}
            $this->Flash->error(__('The service job could not be saved. Please, try again.'));
        }
        $instruments = $this->ServiceJobs->Instruments->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->customer->type_name."'s ".$row->year." ".$row->brand." ".$row->model." ".$row->type;}])->contain(['Customers']);
        $quotes = $this->ServiceJobs->Quotes->find('list',['keyField' => 'id', 'valueField' => function ($row) {return "ID: Q".$row->id." | Name: ".$row->customer->type_name." | Date: ".$row->date->i18nFormat('dd/MM/yyyy');}])->contain(['Customers']);
        $this->set(compact('serviceJob', 'instruments','quotes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Service Job id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $serviceJob = $this->ServiceJobs->get($id, [
            'contain' => ['Instruments', 'Quotes'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $date_start = $this->request->getData("date_started");
            $date_end = $this->request->getData("date_completed");

            if ($date_end != null && $date_start > $date_end) {
                $this->Flash->error(__('Date completed cannot occur before date started.'));}
            else{

                $serviceJob = $this->ServiceJobs->patchEntity($serviceJob, $this->request->getData());
                $this->loadModel('Quotes');
                $quotes=$this->Quotes->get($this->request->getData('quo_id'));

                $quotes = $this->Quotes->patchEntity($quotes, ['status' => 2]);
                $this->Quotes->save($quotes);

                if ($this->ServiceJobs->save($serviceJob)) {
                    $this->Flash->success(__('{0} has been saved.', "J".$serviceJob->id." | Date: ".$serviceJob->date_started->i18nFormat('dd/MM/yyyy')));

                    return $this->redirect(['action' => 'index']);
                }}
            $this->Flash->error(__('The service job could not be saved. Please, try again.'));
        }
        $instruments = $this->ServiceJobs->Instruments->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->customer->type_name."'s ".$row->year." ".$row->brand." ".$row->model." ".$row->type;}])->contain(['Customers']);
        $quotes = $this->ServiceJobs->Quotes->find('list',['keyField' => 'id', 'valueField' => function ($row) {return "ID: Q".$row->id." | Name: ".$row->customer->type_name." | Date: ".$row->date->i18nFormat('dd/MM/yyyy');}])->contain(['Customers']);
        $this->set(compact('serviceJob', 'instruments','quotes'));

    }

    /**
     * Edit2 method
     *
     * @param string|null $id Service Job id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit2($id = null)
    {
        $serviceJob = $this->ServiceJobs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $date_start = $this->request->getData("date_started");
            $date_end = $this->request->getData("date_completed");

            if ($date_end != null && $date_start > $date_end) {
                $this->Flash->error(__('Date completed cannot occur before date started.'));}
            else{

                $serviceJob = $this->ServiceJobs->patchEntity($serviceJob, $this->request->getData());
                $this->loadModel('Quotes');
                $quotes=$this->Quotes->get($this->request->getData('quo_id'));

                $quotes = $this->Quotes->patchEntity($quotes, ['status' => 2]);
                $this->Quotes->save($quotes);

                if ($this->ServiceJobs->save($serviceJob)) {
                    $this->Flash->success(__('{0} has been saved.', "J".$serviceJob->id." | Date: ".$serviceJob->date_started->i18nFormat('dd/MM/yyyy')));

                    return $this->redirect(['action' => 'index']);
                }}
            $this->Flash->error(__('The service job could not be saved. Please, try again.'));
        }
        $instruments = $this->ServiceJobs->Instruments->find('list', ['keyField' => 'id', 'valueField' => function ($row) {return $row->customer->type_name."'s ".$row->year." ".$row->brand." ".$row->model." ".$row->type;}])->contain(['Customers']);
        $quotes = $this->ServiceJobs->Quotes->find('list',['keyField' => 'id', 'valueField' => function ($row) {return "ID: Q".$row->id." | Name: ".$row->customer->type_name." | Date: ".$row->date->i18nFormat('dd/MM/yyyy');}])->contain(['Customers']);
        $this->set(compact('serviceJob', 'instruments','quotes'));

    }

    /**
     * Delete method
     *
     * @param string|null $id Service Job id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicejob = $this->ServiceJobs->get($id);
        $quoteid=$servicejob["quo_id"];

        try {
            if ($this->ServiceJobs->delete($servicejob)) {
                $servicejob2=$this->ServiceJobs->find('all',['conditions'=>['quo_id'=>$quoteid]])->toList();

                if(sizeof($servicejob2)==0){
                    $this->loadModel('Quotes');
                $quote=$this->Quotes->get($quoteid);
                $quote->status=1;
                $this->Quotes->save($quote);
                }
                $this->Flash->delete(__('Service job has been deleted.'));
            } else {
                $this->Flash->error(__('Service Job cannot be deleted while it has related invoices in the system'));
            }
        }catch (\Exception $e) {
            $this->Flash->error(__('Service Job cannot be deleted while it has related invoices in the system'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export()
    {

        //ServiceJobs content
        $this->loadModel('ServiceJobs');
        $serviceJobs = $this->ServiceJobs->find('all',array('fields' => array('ServiceJobs.id','ServiceJobs.inst_id', 'ServiceJobs.quo_id', 'ServiceJobs.estimated_time', 'ServiceJobs.date_started','ServiceJobs.date_completed','ServiceJobs.time_taken','ServiceJobs.jobs_performed','ServiceJobs.description',)))->toArray();
        $array = json_decode(json_encode($serviceJobs), true);

        //Get Instruments content
        $this->loadModel('Instruments');
        $instruments = $this->Instruments->find()->toList();
        $instrumentsArr = [];
        $instrumentsnameArr =[];
        $instrumentscustomersidArr = [];
        foreach ($instruments as $i) {

            array_push($instrumentsnameArr, trim($i->instrument_name));
            array_push($instrumentscustomersidArr, trim(strval($i->cust_id)));
        }

        $instrumentscustomersidArr = array_combine(range(1, count($instrumentscustomersidArr)), array_values($instrumentscustomersidArr));
        $instrumentsnameArr = array_combine(range(1, count($instrumentsnameArr)), array_values($instrumentsnameArr));


        //Get customer content
        $this->loadModel('Customers');
        $customers = $this->Customers->find()->toList();
        $customersArr = [];
        $customersidArr = [];
        foreach ($customers as $c) {
            array_push($customersArr, trim($c->full_name));
            array_push($customersidArr, trim($c->full_id));
        }

        $cust_Arr = array_combine($customersidArr,$customersArr);

        //Target array
        foreach ($instrumentscustomersidArr as $in=>&$insvalue) {
            settype($insvalue, "integer");
            //Search the array (replace the value in the target number with the value in this array)
            //The value of the target array (int) = the key of the replacement array (int) = the value of the replacement array (string)
            $insvalue = $cust_Arr[strval($insvalue)];
        }

        foreach ($instrumentscustomersidArr as $ids=>&$idsvalue){
            $idsvalue .=  '`s ' .$instrumentsnameArr[$ids];
        }

        foreach($serviceJobs as &$item){
            settype($item['inst_id'], "string");

            //array_search($item['cust_id'],array_column($cust_Arr, $item['cust_id']))
            if((array_key_exists(intval($item['inst_id']), $instrumentscustomersidArr))){
                $item['inst_id'] = strval( $instrumentscustomersidArr[$item['inst_id']]);
            }else{
                $item['inst_id'] ='';
            }
        }


        $serialize = ['serviceJobs'];
        $header= ['ID','INSTRUMENT', 'QUOTE ID', 'EST TIME', 'DATE STARTED','DATE COMPLETED', 'TIME TAKEN', 'JOBS PERFORMED', 'DESCRIPTION'];
        $this->setResponse($this->getResponse()->withDownload('weztech_service_job.csv'));
        $this->set(compact('serviceJobs'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => 'serviceJobs',
                $serialize,
                'header' => $header,
                'enclosure ',
            ]);
    }
}
