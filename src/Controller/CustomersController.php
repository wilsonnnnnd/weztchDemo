<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $customers = $this->paginate($this->Customers);
        $customers=$this->Customers->find()->toList();
        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);


        // $src=[];
        // if($this->type == "Individual" ){
        //     if($this->gender == "Male"){
        //     $src = 'male.jpeg';
        //     }
        //         elseif($this->gender == "Female" ) {
        //             $src = 'female.png';
        //         }
        //         else {
        //             $src = 'business.png';
        //         }
        // }
        // else {
        //     $src = 'others.jpeg';
         
        // }
        $this->set(compact('customer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('{0} has been saved.',$customer->type_name." (".$customer->contact_name.")"));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * InstrumentRedirectAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function instrumentredirectadd()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('{0} has been saved.',$customer->type_name." (".$customer->contact_name.")"));

                return $this->redirect(['controller' => 'Instruments','action' => 'add']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * QuoteRedirectAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function quoteredirectadd()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('{0} has been saved.',$customer->type_name." (".$customer->contact_name.")"));

                return $this->redirect(['controller' => 'Quotes','action' => 'add']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * InvoiceRedirectAdd method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function invoiceredirectadd()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('{0} has been saved.',$customer->type_name." (".$customer->contact_name.")"));

                return $this->redirect(['controller' => 'Invoices','action' => 'add']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('{0} has been saved.',$customer->type_name." (".$customer->contact_name.")"));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);

        try {
            if ($this->Customers->delete($customer)) {
                $this->Flash->delete(__('{0} has been deleted.',$customer->type_name." (".$customer->contact_name.")"));
            } else {
                $this->Flash->error(__('{0} cannot be deleted while they have related quotes, instruments or invoices in the system',$customer->type_name." (".$customer->contact_name.")"));
            }
        }catch (\Exception $e) {
            $this->Flash->error(__('{0} cannot be deleted while they have related quotes, instruments or invoices in the system',$customer->type_name." (".$customer->contact_name.")"));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function dashboard(){


    }


    public function export()
    {
        $this->setResponse($this->getResponse()->withDownload('weztech_customers.csv'));
       // $_header = array('id', 'Type', 'First Name','Last Name', 'Gender', 'Business','ABN', 'Phone Number', 'Email','Street', 'City', 'State','Postcode', 'Intro Method', 'Pref Contact','Description', 'Created', 'Modified');
        $data = $this ->Customers ->find('all');
        $serialize = ['data'];

        //$extract = array('id', 'title', 'created');


        $header = ['ID','TYPE','FIRST NAME','LAST NAME','GENDER','BUSINESS','ABN','PHONE','EMAIL','STREET','CITY','STATE','POSTCODE','INTRO METHOD','CONTACT','DESCRIPTION','CREATED','MODIFIED'];
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




