<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * @var \Cake\Datasource\RepositoryInterface|null
     */


    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        $this->loadModel('Quotes');
        $findQuotes = $this->Quotes->find('all', ['conditions' => ['date(expiry) <= DATE_ADD(CURDATE(),interval 7 day) and date(expiry) >= CURDATE() and status = 1']])->contain(['Customers'])->order('expiry')->toList();
        $this->set('findQuotes', $findQuotes);
        $this->loadModel('ServiceJobs');
        $findJobs = $this->ServiceJobs->find('all', ['conditions' => ['date(estimated_completion) <= DATE_ADD(CURDATE(),interval 28 day) and date(estimated_completion) >= DATE_SUB(CURDATE(),interval 28 day) and ServiceJobs.status=1']])->contain(['Quotes', 'Quotes.Customers', 'Instruments', 'Instruments.Customers'])->order('estimated_completion')->toList();
        $this->set('findJobs', $findJobs);
        $this->loadModel('Invoices');
        $findInvoices = $this->Invoices->find('all', ['conditions' => ['Invoices.Status' => '1']])->contain(['Customers', 'ServiceJobs'])->order('date_started')->toList();
        $this->set('findInvoices', $findInvoices);

        $this->loadModel('Receipts');
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if ($page == "stats") {
            // View the average of service jobs
            $avgJobs = round($this->ServiceJobs->find()->avg("time_taken"), 2);

            //Average income per job
            $avgjobincome = round($this->Invoices->find()->avg("total_due"), 2);
            //Average deviation
            $avgdeviation = round($this->Quotes->find()->sumOf("estimated_total"), 2) - round($this->Invoices->find()->sumOf("total_due"), 2);
            //Total paid invoices
            $totalpaidinvoice = round($this->Invoices->find()->where(['status=2 and Year(invoice_date) = YEAR(current_timestamp) and  month(invoice_date)=MONTH(current_timestamp)'])->sumOf("total_due"), 2);
            //Total paid invoices
            $totalReceipts = round($this->Receipts->find()->where(['Year(date) = YEAR(current_timestamp) and  month(date)=MONTH(current_timestamp)'])->sumOf("total_price"), 2);
            // actHours - EstHours
            $actHours = $this->ServiceJobs->find()->avg("time_taken");
            $estHours = $this->ServiceJobs->find()->avg("estimated_time");
            $tempValue = round($actHours - $estHours, 2);
            $dValue = "No Jobs Added";
            if($tempValue < 0){$dValue = "On average, job length is overestimated by ".abs($tempValue)." Hours";}
            else if($tempValue > 0){$dValue = "On average, job length is underestimated by ".abs($tempValue)." Hours";}
            else if($tempValue == 0){$dValue = "On average, Job length is estimated perfectly";};

            $totalJobsMonth = $this->ServiceJobs->find('all',["conditions"=>"date(date_started) <= DATE_ADD(CURDATE(),interval 30 day) and date(date_started) >= DATE_SUB(CURDATE(),interval 30 day)"])->count("id");
            $totalJobsYear = $this->ServiceJobs->find('all',["conditions"=>"date(date_started) <= DATE_ADD(CURDATE(),interval 365 day) and date(date_started) >= DATE_SUB(CURDATE(),interval 365 day)"])->count("id");

            //Customer introduction methods in the last month
            $this->loadModel('Customers');
            $customers = $this->Customers->find('all',["conditions"=>"date(created) <= DATE_ADD(CURDATE(),interval 30 day) and date(created) >= DATE_SUB(CURDATE(),interval 30 day)"])->toList();
            //$customersBytime = $this->Customers->find('all',["conditions"=>"date(created) <= DATE_ADD(CURDATE(),interval 365 day) and date(created) >= DATE_SUB(CURDATE(),interval 365 day)"])->toList();
            $customersIntroMethodArr = [];
            foreach ($customers as $c) {
                settype($c['cust_id'], "string");
                array_push($customersIntroMethodArr, trim($c->intro_method));
            }
            $arr = array_count_values($customersIntroMethodArr); // Count the number of occurrences of all values in the array.
            arsort($arr); // Sort the array in descending order by key value
            $intro_str_by_month="";
            $intro_value_by_month = "";
            foreach ($arr as $key=>$value) {
                if($key){
                    $intro_str_by_month .= $key . ',';
                    $intro_value_by_month .= $value .',' ;
                }
                $intro_str_by_month = trim($intro_str_by_month);
                $intro_value_by_month = trim($intro_value_by_month);
            }




            //Customer introduction methods in the last year
            $customersBytime = $this->Customers->find('all',["conditions"=>"date(created) <= DATE_ADD(CURDATE(),interval 365 day) and date(created) >= DATE_SUB(CURDATE(),interval 365 day)"])->toList();
            $customersIntroMethodArr_By_year = [];
            foreach ($customersBytime as $cb) {
                array_push($customersIntroMethodArr_By_year, trim($cb->intro_method));
            }
            $arr_by_year = array_count_values($customersIntroMethodArr_By_year); // Count the number of occurrences of all values in the array.
            arsort($arr_by_year); // Sort the array in descending order by key value
            $intro_str_by_year="";
            $intro_value_by_year = "";
            foreach ($arr_by_year as $key=>$value) {
                if($key){
                    $intro_str_by_year .= $key . ',';
                    $intro_value_by_year .= $value .',' ;
                }
                $intro_str_by_year = trim($intro_str_by_year);
                $intro_value_by_year = trim($intro_value_by_year);
            }


            //customer type
            $customer_type = $this->Customers->find()->toList();
            $cust_type = [];
            foreach ($customer_type as $ct) {
                array_push($cust_type, trim($ct->type));
            }
            $arr_cust_type = array_count_values($cust_type);
            arsort($arr_cust_type); // Sort the array in descending order by key value
            $cust_type_str="";
            $cust_type_no="";
            foreach ($arr_cust_type as $key=>$value) {
                if($key){
                    $cust_type_str .= $key . ',';
                    $cust_type_no .= $value .',' ;
                }
                $cust_type_str = trim($cust_type_str);
                $cust_type_no = trim($cust_type_no);
            }

            //count the customer with job.
            $jobs= $this->ServiceJobs->find('all', ["conditions"=>"ServiceJobs.status = 1 or ServiceJobs.status = 2"])->contain([ 'Instruments', 'Instruments.Customers'])->toList();
            $job_customer =[];
            foreach ($jobs as $j){
                array_push($job_customer,$j->customer_name);
            }
            $arr_of_job_cust = array_count_values($job_customer);
            arsort($arr_of_job_cust);

            $new_Arr_cust_job = [];
            $new_Arr_cust_job =array_slice($arr_of_job_cust, 0, 19,true);

            $job_customer_name = "";
            $job_customer_no = "";
            foreach ($new_Arr_cust_job as $item => $value) {
                if($item) {
                    $job_customer_name .= $item . ',';
                    $job_customer_no .= $value . ',';
                }
            }
            $job_customer_name = trim($job_customer_name);
            $job_customer_no = trim($job_customer_no);


            // Count the customer state
            $customerstate = $this->Customers->find()->toList();
            $customerstateArr = [];
            $customernameArr = [];
            foreach ($customerstate as $ca){
                array_push($customerstateArr, trim($ca->city));
            }
            $arr_of_cust_state = array_count_values($customerstateArr);
            arsort($arr_of_cust_state);
            $new_Arr_cust_state = [];
            $new_Arr_cust_state =array_slice($arr_of_cust_state, 0, 19);
            $cust_add="";
            $cust_no = "";
            foreach ($new_Arr_cust_state as $state => $number) {
                if($state){
                    $cust_add .= $state . ',';
                    $cust_no .= $number . ',';
                }
                $cust_add = trim($cust_add);
                $cust_no = trim($cust_no);

            }

            //count instrument type:
            $this->loadModel('Instruments');
            $instrmentType = $this->Instruments->find()->toList();
            $instrmentTypeArr = [];
            foreach ($instrmentType as $ca){
                array_push($instrmentTypeArr, trim($ca->type));
            }
            $arr_of_inst_type = array_count_values($instrmentTypeArr);
            arsort($arr_of_inst_type);
            $new_Arr_inst_type =array_slice($arr_of_inst_type, 0, 10);
            $inst_type="";
            $num_inst_type = "";
            foreach ($new_Arr_inst_type as $state => $number) {
                if($state){
                    $inst_type .= $state . ',';
                    $num_inst_type .= $number . ',';
                }
                $inst_type = trim($inst_type);
                $num_inst_type = trim($num_inst_type);
            }
            $this->set('inst_type',$inst_type);
            $this->set('num_inst_type',$num_inst_type);

            //count instrument brand:
            $instrmentBrand = $this->Instruments->find()->toList();
            $instrmentBrandArr = [];
            foreach ($instrmentBrand as $ca){
                array_push($instrmentBrandArr, trim($ca->brand));
            }
            $arr_of_inst_brand = array_count_values($instrmentBrandArr);
            arsort($arr_of_inst_brand);

            $new_Arr_inst_brand =array_slice($arr_of_inst_brand, 0, 10);
            $inst_brand="";
            $num_inst_brand = "";
            foreach ($new_Arr_inst_brand as $state => $number) {
                if($state){
                    $inst_brand .= $state . ',';
                    $num_inst_brand .= $number . ',';
                }
                $inst_brand = trim($inst_brand);
                $num_inst_brand = trim($num_inst_brand);
            }
            $this->set('inst_brand',$inst_brand);
            $this->set('num_inst_brand',$num_inst_brand);


            //count instrument Model:
            $instrmentModel = $this->Instruments->find()->toList();
            $instrmentModelArr = [];
            foreach ($instrmentModel as $ca){
                array_push($instrmentModelArr, trim($ca->model));
            }
            $arr_of_inst_model = array_count_values($instrmentModelArr);
            arsort($arr_of_inst_model);
            $new_Arr_inst_model =array_slice($arr_of_inst_model, 0, 10);
            $inst_model="";
            $num_inst_model = "";
            foreach ($new_Arr_inst_model as $state => $number) {
                if($state){
                    $inst_model .= $state . ',';
                    $num_inst_model .= $number . ',';
                }
                $inst_model = trim($inst_model);
                $num_inst_model = trim($num_inst_model);
            }
            $this->set('inst_model',$inst_model);
            $this->set('num_inst_model',$num_inst_model);


            //count the Receipt with type.
            $this->loadModel('Receipts');
            $receipt= $this->Receipts->find()->toList();
            $receipt_job_type=[];
            $receipt_type = [];
            foreach ($receipt as $r){
                array_push($receipt_type,$r->receipt_type);
                array_push($receipt_job_type,$r->job_type);

            }

            $arr_of_receipt_job_type = array_count_values($receipt_job_type);
            $arr_of_receipt_job = array_count_values($receipt_type);
            arsort($arr_of_receipt_job_type);
            arsort($arr_of_receipt_job);


            $receipt_job_name = "";
            $receipt_job_no = "";
            foreach ($arr_of_receipt_job as $item => $value) {
                if($item) {
                    $receipt_job_name .= $item . ',';
                    $receipt_job_no .= $value . ',';
                }
            }

            $receipt_job_name = trim($receipt_job_name);
            $receipt_job_no = trim($receipt_job_no);

            $receipt_type_name = "";
            $receipt_type_no = "";
            foreach ($arr_of_receipt_job_type as $item => $value) {
                if($item) {
                    $receipt_type_name .= $item . ',';
                    $receipt_type_no .= $value . ',';
                }
            }
            $receipt_type_name = trim($receipt_type_name);
            $receipt_type_no = trim($receipt_type_no);

            $this->set(compact('avgJobs', 'dValue', 'totalJobsMonth', 'totalJobsYear', "cust_type_str", "cust_type_no", "intro_str_by_month","intro_value_by_month","intro_str_by_year","intro_value_by_year"
                ,"cust_add","cust_no","job_customer_name","job_customer_no","receipt_job_name","receipt_job_no","receipt_type_name","receipt_type_no","avgjobincome","avgdeviation","totalpaidinvoice"
            ,"totalReceipts"));
        }
        $this->set(compact('page', 'subpage'));


//        debug();
//        exit();

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    /**
     * View method
     *
     * @param string|null $id Service Job id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function graph($time = null)
    {
        $time = $this->Pages->get($time, [
            'contain' => [],
        ]);

        $this->set(compact('time'));
    }
    /**
     * View method
     *
     * @param string|null $time time.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(int $time = null)
    {
        echo $time;
//        $test = $this->request->getQueryParams();
//
//        $this->set(compact('test'));
    }



}
