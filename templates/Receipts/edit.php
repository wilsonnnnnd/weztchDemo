<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $receipt
 */
?>

<style>
    .error-message{
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
        <h3 class="page-header"><i class="fas fa-receipt"></i>Receipt</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-receipt"></i><a <?php echo $this->Html->link('Receipts', array('controller' => 'Receipts', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Edit Receipt</li>
    </ol>
    <div class="card" style="width: 70rem;">
        <div class="card-body">
            <h2 class="card-title">Edit Receipt</h2><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div>
            <div class="card-text">
                <?= $this->Form->postLink(
                    __('Delete Receipt'),
                    ['action' => 'delete', $receipt->id],
                    ['confirm' => __('Are you sure you want to delete the receipt from {0}?', $receipt->receipt_name), 'class' => 'btn btn-danger']
                ) ?>
                <p></p>
                <?= $this->Form->create($receipt ,['type' => 'file']) ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="receipt_no">Receipt Number <div class = white>*</div></label>
                        <?php echo $this->Form->control('receipt_no', ['required' => false, 'maxlength' => 50, 'placeholder' => 'Maximum length: 50', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('date', ['required' => true, 'type' => 'date','value'=>date("m/d/Y"), 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="row gy-2 gx-3 align-items-center">
                    <div class="col-auto">
                        <label for="total_price">Total Price <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('total_price', ['required' => true, 'placeholder' => 'Enter value in dollars', 'onkeyup'=>'changeGST(this.value)', 'id'=>'TOTALid', 'label' => false, 'class' => 'form-control','min'=>0, 'max'=>999999999.99]); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="gst">GST <div class = white>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('gst', ['required' => false, 'placeholder' => 'Enter value in dollars','min'=>0, 'max'=>999999999.99, 'id'=>'GSTid','label' => false, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="shipping">Shipping Price <div class = white>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('shipping', ['required' => false, 'placeholder' => 'Enter value in dollars', 'label' => false, 'class' => 'form-control','min'=>0, 'max'=>999999999.99]); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="discount">Discount <div class = white>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">-$</div>
                            <?php echo $this->Form->control('discount', ['required' => false, 'placeholder' => 'Enter value in dollars', 'onkeyup' =>'saveTOTAL(this.value)', 'label' => false, 'class' => 'form-control','min'=>0, 'max'=>999999999.99]); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="Apply Discount">(Optional)</label>
                        <div class="input-group-prepend">
                            <?= $this->Form->button ('Apply Discount', ['onclick' =>'changeTOTAL()', 'type' =>'button','class'=>'btn btn-secondary'])?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group-prepend">
                            <?php $options = array('1' => 'No Job', '2' => 'Has Job');
                            echo $this->Form->control('status', ['required' => true, 'options' => $options, 'value' => 1,'type'=>'hidden', 'label' => false, 'class' => 'form-control', 'empty' => false]); ?>
                        </div>
                    </div>
                </div><br><br>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="purchase_source">Purchase Source <div class = white>*</div></label>
                        <?php echo $this->Form->control('purchase_source', ['required' => false, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100','label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="purchase_method">Purchase Method <div class = white>*</div></label>
                        <?php $options2 = array('Cash' => 'Cash', 'Card' => 'Card', 'PayPal' => 'PayPal', 'Gift' => 'Gift', 'Trade' => 'Trade', 'Other' => 'Other');
                        echo $this->Form->control('purchase_method', ['required' => false, 'options' => $options2, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="job_type">Job Type <div class = red>*</div></label>
                        <?php $options3 = array('Weztech' => 'Weztech', 'Performance' => 'Performance', 'Contract' => 'Contract', 'Construction' => 'Construction', 'Gardening' => 'Gardening', 'Other' => 'Other');
                        echo $this->Form->control('job_type', ['required' => true, 'options' => $options3, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100','label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="receipt_type">Receipt Type <div class = red>*</div></label>
                        <?php $options4 = array('Capital' => 'Capital', 'Equipment' => 'Equipment', 'Food' => 'Food', 'Maintenance' => 'Maintenance', 'Out source' => 'Outsource', 'Parts' => 'Parts', 'PPE & Clothing' => 'PPE & Clothing', 'Project' => 'Project', 'Promotion' => 'Promotion', 'Shipping' => 'Shipping', 'Stationary' => 'Stationary', 'Stock' => 'Stock', 'Tools' => 'Tools', 'Training' => 'Training', 'Utilities' => 'Utilities', 'Vehicle' => 'Vehicle', 'Other' => 'Other');
                        echo $this->Form->control('receipt_type', ['required' => true, 'options' => $options4, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="form-group">
                    <?php echo $this->Form->control('image_file', ['type' => 'file', 'id'=>'file','onchange'=>'return fileValidation()']); ?>
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
    let discount = 0.00;
    function changeGST(value){
        let temp = Number(value)*0.1;
        let result = Math.round((Number(temp) + Number.EPSILON) * 100) / 100;
        document.getElementById('GSTid').value=Number(result);
    }
    function saveTOTAL(value){
        discount = value;
    }
    function changeTOTAL(){
        document.getElementById('TOTALid').value= document.getElementById('TOTALid').value - Number(discount);
    }
</script>
<script>
    function limit(event, value, maxLength) {
        if (value != undefined && value.toString().length >= maxLength) {
            event.preventDefault();
        }
    }
</script>


<script>
        function fileValidation() {
            var fileInput = document.getElementById('file');

            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;


           // var fi = document.getElementById('file');


            if (fileInput.files.length > 0) {
            for (var i = 0; i <= fileInput.files.length - 1; i++) {

                var fsize = fileInput.files.item(i).size;
                var file = Math.round((fsize / 1024));


            if (!allowedExtensions.exec(filePath) || file >= 2048  ) {
                    alert(
                      "Please check your FILE SIZE (less than 2 MB) & FILE TYPE (Accepts JPG, JPEG , PNG & GIF only) ");
                      fileInput.value = '';
                      return false;


                }

                else{
                    return true;
                }


        }
    }
}

    </script>
