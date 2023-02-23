<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice $invoice
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $serviceJobs
 */
?>
<?= $this->Html->css('choices.min.css'); ?>

<style>
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
        <ol class="breadcrumb">
            <li><i class="fas fa-print"></i><a <?php echo $this->Html->link('Invoice', array('controller' => 'Invoices', 'action' => 'index'), array('escape' => false)); ?></a></li>
            <li><i class="far fa-edit"></i>Update Payment</li>
            <li><i class="fa fa-id-card-o"></i><?= h($invoice->InvoiceName." (i".$invoice->id.")") ?></li>
        </ol>
    </div>
</div>



<div class="row">
    <div class="card" style="width: 85rem;">
        <div class="card-body">
            <h2 class="card-title">Update Payment</h2><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div><br>
            <div class="card-text">
                <?= $this->Form->create($invoice) ?>
                <div class="form-group">
                <?php echo $this->Form->control('invoice_date', ['required' => true, 'type'=>'hidden', 'label' => false, 'class' => 'form-control']); ?>
                </div>
                <div class="row gy-2 gx-3 align-items-center">
                    <div class="col-auto">
                        <label for="amount_due">Amount Due <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('amount_due', ['required' => true, 'type'=>'hidden','min'=>0, 'max'=>999999999.99, 'id'=>'GSTid1','label' => false,'class' => 'form-control']); ?>
                            <?php echo $this->Form->control('amount_due', ['required' => true, 'disabled'=>'disabled','min'=>0, 'max'=>999999999.99, 'id'=>'GSTid2','label' => false,'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="gst">GST <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('gst', ['required' => true, 'type'=>'hidden','min'=>0, 'max'=>999999999.99,'id'=>'GSTid1','label' => false,'class' => 'form-control']); ?>
                            <?php echo $this->Form->control('gst', ['required' => true, 'disabled'=>'disabled','min'=>0, 'max'=>999999999.99,'id'=>'GSTid2','label' => false,'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="total_due">Total Amount Due <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('total_due', ['required' => true, 'type'=>'hidden','min'=>0, 'max'=>999999999.99,'id'=>'GSTid1','label' => false,'class' => 'form-control']); ?>
                            <?php echo $this->Form->control('total_due', ['required' => true, 'disabled'=>'disabled','min'=>0, 'max'=>999999999.99,'id'=>'GSTid2','label' => false,'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="status">Status <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <?php $options = array('2' => 'Paid');
                            echo $this->Form->control('status', ['required' => true, 'options' => $options,'value' => 2, 'label' => false, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div><br><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="invoice_date">Invoice Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('invoice_date', ['required' => true, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="payment_date">Payment Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('payment_date', ['required' => true, 'value'=>date("m/d/Y"), 'label' => false, 'class' => 'form-control']); ?>
                    </div>
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

<!--//set the submit only can submit once-->
<script type="text/javascript">
    $('form').submit(function() {
        $(document).find("button[type='Submit']").prop('disabled', true);
    });
</script>

<?= $this->Html->script('choices.min.js'); ?>
<?= $this->Html->script('bootstrap.bundle.min.js'); ?>
<script>
    const sorting = document.querySelector('.selectpicker');
    const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices = new Choices(sorting, {
        placeholder: false,
        itemSelectText: ''
    });


    // Trick to apply your custom classes to generated dropdown menu
    let sortingClass = sorting.getAttribute('class');
    window.onload = function() {
        sorting.parentElement.setAttribute('class', sortingClass);
    }
</script>
