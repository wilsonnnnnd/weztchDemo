<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice $invoice
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 * @var \Cake\Collection\CollectionInterface|string[] $serviceJobs
 */
?>

<?= $this->Html->css('choices.min.css'); ?>
<style>

    a {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
    }

    .ddd {
        max-width: 500px;
        text-overflow: clip ;
        overflow: hidden;
    }
    error-message{
        color:red !important;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .red {
        color: red;
        font-style: normal;
        font-size: 120%;
        display: inline-block;
        white-space: nowrap;
    }
    .white {
        color: white;
        font-style: normal;
        font-size: 120%;
        display: inline-block;
        white-space: nowrap;
    }

    .legend {
        font-style: normal;
        font-size: 100%;
        display: inline-block;
        white-space: nowrap;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-print"></i>Invoices</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-print"></i><a <?php echo $this->Html->link('Invoices', array('controller' => 'Invoices', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Add Invoice</li>
    </ol>
    <div class="card" style="width: 70rem;">
        <div class="card-body"><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div>
            <h5 class="card-title">Add Invoice</h5>
            <div class="card-text">
                <?= $this->Form->create($invoice) ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cust_id">Customer</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'Customers','action'=>'invoiceredirectadd'), array('escape'=>false, 'title' => "Click to add a new Customer")); ?>
                        <?php echo $this->Form->control('cust_id', ['onchange'=>'changeJobList(this.value)','required' => true, 'options' => $arr_customers, 'label' => false, 'class' => 'form-control selectpicker-customer border ddd']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="job_id">Service Job</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'ServiceJobs','action'=>'add'), array('escape'=>false, 'title' => "Click to add a new Job")); ?>
                        <?php echo $this->Form->control('job_id', ['id'=>'job_id','required' => true, 'options' => $arr_serviceJobs, 'label' => false, 'class' => 'form-control selectpicker-job border ddd']); ?>
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="heading">Heading <div class = white>*</div></label>
                        <?php echo $this->Form->control('heading', ['required' => false, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="invoice_date">Invoice Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('invoice_date', ['required' => true,'value'=>date("m/d/Y"), 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="row gy-2 gx-3 align-items-center">
                <div class="col-auto">
                    <label for="amount_due">Amount Due <div class = red>*</div></label>
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                        <?php echo $this->Form->control('amount_due', ['required' => true, 'onkeyup'=>'changeEstimate(this.value)', 'label' => false,'placeholder' => 'Enter value in dollars', 'type' => 'number','min' => 0,'max'=>999999999.99,'id'=>'ESTid', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-auto">
                    <label for="gst">GST <div class = red>*</div></label>
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                        <?php echo $this->Form->control('gst', ['required' => true, 'type'=>'hidden','min'=>0, 'max'=>999999999.99, 'id'=>'GSTid1','label' => false,'class' => 'form-control']); ?>
                        <?php echo $this->Form->control('gst', ['required' => true, 'disabled'=>'disabled','min'=>0, 'max'=>999999999.99, 'id'=>'GSTid2','label' => false,'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-auto">
                    <label for="total_due">Total Amount Due <div class = red>*</div></label>
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                        <?php echo $this->Form->control('total_due', ['required' => true, 'onkeyup'=>'changeTotal(this.value)', 'min'=>0, 'max'=>999999999.99, 'id'=>'Totalid','label' => false, 'placeholder' => 'Enter value in dollars','class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-auto">
                    <label for="status">Status <div class = red>*</div></label>
                    <div class="input-group-prepend">
                        <?php $options = array('1' => 'Unpaid', '2' => 'Paid');
                        echo $this->Form->control('status', ['required' => true, 'options' => $options, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div>
            </div><br>
                <div class="form-group">
                    <label for="payment_date">Payment Date</label>
                    <?php echo $this->Form->control('payment_date', ['required' => false, 'label' => false, 'class' => 'form-control']); ?>
                </div><br>
                <div class="form-group">
                    <label for="description">Description</label>
                    <?php echo $this->Form->control('description', ['required' => false, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'label' => false, 'class' => 'form-control']); ?>
                </div>
            </div>
            <?= $this->Form->button('Submit', ['class' => 'btn btn-primary', 'id' => 'submit', 'style' => 'float:right']) ?>
            <?= $this->Form->end() ?>
            <?= $this->Form->button ('Cancel', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
        </div>
    </div>
</div>



<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>

<?= $this->Html->script('choices.min.js'); ?>
<?= $this->Html->script('bootstrap.bundle.min.js'); ?>

<!--//set the submit only can submit once-->
<script type="text/javascript">
    $('form').submit(function() {
        $(document).find("button[type='Submit']").prop('disabled', true);
    });
</script>



<script>
    const sorting_customer = document.querySelector('.selectpicker-customer');
    const sorting_job = document.querySelector('.selectpicker-job');
    // const commentSorting = document.querySelector('.selectpicker');
    // const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices_customer = new Choices(sorting_customer, {
        placeholder: false,
        itemSelectText: ''
    });
    const sortingchoices_jobs = new Choices(sorting_job, {
        placeholder: false,
        itemSelectText: ''
    });

    // // Trick to apply your custom classes to generated dropdown menu
    // let sortingClass = sorting.getAttribute('class');
    // window.onload = function() {
    //     sorting.parentElement.setAttribute('class', sortingClass);
    // }

</script>


<script>
    function changeEstimate(value){
        let temp = Number(value)*0.1;
        let result = Math.round((Number(temp) + Number.EPSILON) * 100) / 100;
        document.getElementById('GSTid1').value=Number(result);
        document.getElementById('GSTid2').value=Number(result);

        let temp2 = Number(value) + Number(result);
        let result2 = Math.round((Number(temp2) + Number.EPSILON) * 100) / 100;
        document.getElementById('Totalid').value=Number(result2);
    }
</script>

<script>
    function changeTotal(value){
        let temp = Number(value)/11;
        let result = Math.round((Number(temp) + Number.EPSILON) * 100) / 100;
        document.getElementById('GSTid1').value=Number(result);
        document.getElementById('GSTid2').value=Number(result);

        let temp2 = Number(value) - Number(result);
        let result2 = Math.round((Number(temp2) + Number.EPSILON) * 100) / 100;
        document.getElementById('ESTid').value=Number(result2);
    }
</script>

<script>
    function changeJobList(custid){
        console.log(custid);
        console.log(window.location.href.lastIndexOf('/')+1);
        $.ajax({
            type: 'get',
            url: window.location.href.substring(0,window.location.href.lastIndexOf('/'))+ '/servicejob/'+custid,
            datatype: 'json',
          headers:{'X-CSRF-Token':<?= json_encode($this->request->getParam('_csrfToken')) ?>},
            success: function (result) {
                console.log(JSON.parse(result));
                var serviceJobs=JSON.parse(result)["serviceJobs"];
                var job_id=document.getElementById("job_id");
                console.log(job_id);
                while(job_id.firstChild){
                    job_id.removeChild(job_id.firstChild);
                }
                for(let i=0;i<serviceJobs.length;i++){
                    var o = document.createElement("option");
                    o.value = serviceJobs[i]["id"];
                    o.text = serviceJobs[i]["instrument"]["year"]+' '+serviceJobs[i]["instrument"]["brand"]+' '+serviceJobs[i]["instrument"]["model"]+' | Job Finish Date:'+serviceJobs[i]["job_completed"];
                    job_id.appendChild(o);
                }
               console.log(job_id);

            },
            error: function (result) {
              //  console.log(result);
            }
        });

    }
</script>
