<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote $quote
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<?= $this->Html->css('choices.min.css'); ?>
<style>
    .choices__list--dropdown .choices__item--selectable {
        padding-bottom: 1rem !important;
    }

    a {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
    }
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

    .legend {
        font-style: normal;
        font-size: 100%;
        display: inline-block;
        white-space: nowrap;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="far fa-copy"></i>Quotes</h3>
        <ol class="breadcrumb">
            <li><i class="far fa-copy"></i><a <?php echo $this->Html->link('Quotes', array('controller' => 'Quotes', 'action' => 'index'), array('escape' => false)); ?></a></li>
            <li><i class="far fa-edit"></i>Edit Quote</li>
            <li><i class="fa fa-id-card-o"></i><?= h($quote->QuoteName." (Q".$quote->id.")") ?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="card" style="width: 85rem;">
        <div class="card-body">
            <h2 class="card-title">Edit Quote</h2>
            <div class="card-text">
                <?= $this->Form->postLink(
                    __('Delete Quote'),
                    ['action' => 'delete', $quote->id],
                    ['confirm' => __('Are you sure you want to delete the quote for {0}?', $quote->customer->type_name . " (" . $quote->date->i18nFormat('dd/MM/yyyy') . ")"), 'class' => 'btn btn-danger']
                ) ?>
                <p></p><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div><br>
                <?= $this->Form->create($quote) ?>
                <div class="form-group">
                    <label for="cust_id">Customer <div class = red>*</div></label>
                    <?php echo $this->Form->control('cust_id', ['required' => true, 'options' => $arr_customers, 'label' => false, 'class' => 'form-control selectpicker-customer border']); ?>
                </div><br>
                <div class="form-group">
                    <label for="heading">Heading <div class = red>*</div></label>
                    <?php echo $this->Form->control('heading', ['required' => true, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date">Quote Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('date', ['required' => true, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="expiry">Expiry <div class = red>*</div></label>
                        <?php echo $this->Form->control('expiry', ['required' => true, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estimated_completion">Estimated Date of Completion <div class = red>*</div></label>
                        <?php echo $this->Form->control('estimated_completion', ['required' => true, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>

                <div class="row gy-2 gx-3 align-items-center">
                    <div class="col-auto">
                        <label for="estimated_cost">Estimated Cost <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('estimated_cost', ['required' => true, 'onkeyup' => 'changeEstimate(this.value)', 'label' => false, 'placeholder' => 'Enter value in dollars', 'type' => 'number', 'min' => 0, 'max'=>999999999.99, 'id' => 'ESTid', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="gst">GST <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('gst', ['required' => true, 'type' => 'hidden', 'min' => 0, 'max'=>999999999.99, 'id' => 'GSTid1', 'label' => false, 'class' => 'form-control']); ?>
                            <?php echo $this->Form->control('gst', ['required' => true, 'disabled' => 'disabled', 'min' => 0, 'max'=>999999999.99, 'id' => 'GSTid2', 'label' => false, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="estimated_total">Total Cost <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('estimated_total', ['required' => true, 'onkeyup' => 'changeTotal(this.value)', 'min' => 0, 'max'=>999999999.99, 'id' => 'Totalid', 'label' => false, 'placeholder' => 'Enter value in dollars', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div><br>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="items_required">Items Required</label>
                        <?php echo $this->Form->control('items_required', ['required' => false, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <?php echo $this->Form->control('description', ['required' => false, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary', 'disable' => true, 'id' => 'submit', 'style' => 'float:right']) ?>
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
    const sorting_customer = document.querySelector('.selectpicker-customer');
    // const commentSorting = document.querySelector('.selectpicker');
    // const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices_instrument = new Choices(sorting_customer, {
        placeholder: false,
        itemSelectText: ''
    });

    // Trick to apply your custom classes to generated dropdown menu
    let sortingClass = sorting.getAttribute('class');
    window.onload = function() {
        sorting.parentElement.setAttribute('class', sortingClass);
    }
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
