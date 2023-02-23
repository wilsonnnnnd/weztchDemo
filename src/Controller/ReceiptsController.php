<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Receipts Controller
 *
 * @property \App\Model\Table\ReceiptsTable $Receipts
 * @method \App\Model\Entity\Receipt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReceiptsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $receipts = $this->paginate($this->Receipts);
        //display as NA when an image is not found
        // if(file_exists($file) && $image){
        //     enter your code if file exists
        //     }else{
        //     file not exists
        //    }
        $receipts=$this->Receipts->find()->toList();
        $this->set(compact('receipts'));
    }

    /**
     * View method
     *
     * @param string|null $id Receipt id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receipt = $this->Receipts->get($id, [
            'contain' => [],
        ]);



        $this->set(compact('receipt'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $receipt = $this->Receipts->newEmptyEntity();


        if ($this->request->is('post')) {

            $receipt = $this->Receipts->patchEntity($receipt, $this->request->getData());

            if (!$receipt->getErrors){
                $image = $this -> request -> getData('image_file');
                $name = $image->getClientFilename();
                if($name != ''){
                    $receipt_rand = rand(1000,9999);
                    $receipt_hash_number = hash('md5', strval($receipt_rand),false);
                    $receipt_job_name = $this -> request -> getData('job_type');
                    $receipt_type_name = $this -> request -> getData('receipt_type');
                    $img_extension  = pathinfo( $_FILES["image_file"]["name"], PATHINFO_EXTENSION ); // jpg
                    $new_name = $receipt_job_name . $receipt_type_name . "(" . $receipt_hash_number . ")." . $img_extension;
                    $img_new = WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image'.DS. $new_name;
                    $img_old = WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image'. DS . $name;

                    if( !is_dir(WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image')){
                        mkdir(WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image',0755);
                    }
                    if ($name){
                        $image->moveTo($img_old);
                    }
                    rename($img_old,$img_new);
                    $receipt->image= 'receipts/image/'.$new_name;


                }
            }


            if ($this->Receipts->save($receipt)) {
                $this->Flash->success(__('{0} has been saved.', "R".$receipt->id." | Date: ".$receipt->date->i18nFormat('dd/MM/yyyy')));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
        }
        $this->set(compact('receipt'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Receipt id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $receipt = $this->Receipts->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $receipt = $this->Receipts->patchEntity($receipt, $this->request->getData());
            if (!$receipt->getErrors) {
                $image = $this -> request -> getData('image_file');
                $name = $image->getClientFilename();
                if($name != ''){
                    $receipt_rand = rand(1000,9999);
                    $receipt_hash_number = hash('md5', strval($receipt_rand),false);

                    $receipt_job_name = $this -> request -> getData('job_type');
                    $receipt_type_name = $this -> request -> getData('receipt_type');

                    $name_header   = pathinfo( $_FILES["image_file"]["name"], PATHINFO_FILENAME  ); // 5dab1961e93a7-1571494241
                    $img_extension  = pathinfo( $_FILES["image_file"]["name"], PATHINFO_EXTENSION ); // jpg
                    $new_name = $receipt_job_name . $receipt_type_name . "(" . $receipt_hash_number . ")." . $img_extension;
                    $img_new = WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image'.DS. $new_name;
                    $img_old = WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image'. DS . $name;

                    if( !is_dir(WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image')){
                        mkdir(WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image',0755);
                    }

                    $img_file=WWW_ROOT. 'img' . DS . $receipt->image;

                    if(file_exists($img_file)){
                        unlink($img_file);
                    }

                    $targetPath = WWW_ROOT. 'img' . DS . 'receipts' . DS . 'image'. DS . $name;
                    if ($new_name){
                        $image->moveTo($targetPath);
                    }




                    rename($img_old,$img_new);
                    $receipt->image= 'receipts/image/'.$new_name;

                }


            }

            if ($this->Receipts->save($receipt)) {

                $this->Flash->success(__('{0} has been saved.', "R".$receipt->id." | Date: ".$receipt->date->i18nFormat('dd/MM/yyyy')));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
        }
        $this->set(compact('receipt'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Receipt id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $receipt = $this->Receipts->get($id);
        $receipt = $this->Receipts->patchEntity($receipt, $this->request->getData());

        $img_file=WWW_ROOT. 'img' . DS . $receipt->image;
        if($receipt->image !=null){
            unlink($img_file);
        }
        // debug($receipt->image);
        // exit();
        // if(file_exists($img_file)){
        //    unlink($img_file);
        // }
        // }else{
        //   $this->Flash->set('The file could be deleted.', [
        //     'element' => 'success'
        // ]);






        try {
        if ($this->Receipts ->delete($receipt)){

            $this->Flash->delete(__('{0} has been deleted.', "R".$receipt->id." | Date: ".$receipt->date->i18nFormat('dd/MM/yyyy')));
        } else {
            $this->Flash->error(__('{0} could not be deleted. Please, try again.', "R".$receipt->id." | Date: ".$receipt->date->i18nFormat('dd/MM/yyyy')));
        }}
        catch (\Exception $e) {
            $this->Flash->error(__('{0} cannot be deleted while it has related inventory items in the system', "R".$receipt->id." | Date: ".$receipt->date->i18nFormat('dd/MM/yyyy')));
        }


        return $this->redirect(['action' => 'index']);
    }


    public function export()
    {
        $this->setResponse($this->getResponse()->withDownload('weztech_receipts.csv'));

        $data = $this ->Receipts ->find()->select([
            'Receipts.id', 'Receipts.receipt_no', 'Receipts.total_price', 'Receipts.shipping','Receipts.gst','Receipts.discount'
            ,'Receipts.date','Receipts.purchase_method','Receipts.purchase_source','Receipts.job_type','Receipts.receipt_type'
            ,'Receipts.description'
        ]);
        $serialize = ['data'];

        $extract = array('Receipts.receipt_no', 'Receipts.total_price', 'Receipts.shipping','Receipts.gst','Receipts.purchase_method',
            'Receipts.purchase_source','Receipts.job_type','Receipts.receipt_type');
        $header= ['ID','RECEIPT NO.','TOTAL PRICE','SHIPPING','GST','DISCOUNT','DATE','PURCHASE METHOD','PURCHASE SOURCE','JOB TYPE','RECEIPT TYPE','DESCRIPTION'];

        $this->set(compact('data'));

        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => 'data',
                $serialize,
                'header' => $header,
                'enclosure ',
            ]);
    }


}
