<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Part $part
 * @var \Cake\Collection\CollectionInterface|string[] $inventories
 * @var \Cake\Collection\CollectionInterface|string[] $serviceJobs
 * @var \Cake\Collection\CollectionInterface|string[] $receipts
 */
?>

<?= $this->Html->css('choices.min.css'); ?>
<style>
    .error-message{
        color:red !important;
    }

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
        <h3 class="page-header"><i class="fas fa-cubes"></i>Inventory Item</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-cubes"></i><a <?php echo $this->Html->link('Inventory', array('controller' => 'Parts', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Add Inventory Item (From Receipt)</li>
    </ol>
    <div class="card" style="width: 70rem;">
        <div class="card-body">
            <h5 class="card-title">Add Inventory Item (From Receipt)</h5><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div><br>
            <div class="card-text">
                <?= $this->Form->create($part) ?>
                <div class="form-group">
                    <label for="inv_id">Inventory Category</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'Inventories','action'=>'partsredirectadd'), array('escape'=>false, 'title' => "Click to add a new Inventory Category")); ?>
                    <?php echo $this->Form->control('inv_id', ['required' => true, 'options' => $arr_inventories, 'label' => false, 'class' => 'form-control selectpicker-inventory border']); ?>
                </div><br>
                <div class="form-group">
                    <label for="rec_id">Receipt <div class = red>*</div></label>
                    <?php echo $this->Form->control('rec_id', ['required' => true, 'options' => $arr_receipts, 'label' => false, 'class' => 'form-control selectpicker-receipt border']); ?>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="serial_no">Serial Number <div class = white>*</div></label>
                        <?php echo $this->Form->control('serial_no', ['required' => false, 'maxlength' => 50, 'placeholder' => 'Maximum length: 50', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-auto">
                        <label for="individual_price">Purchase Price <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('individual_price', ['required' => true, 'placeholder' => 'Enter value in dollars','onkeyup'=>'changePrice(this.value)', 'min'=>0, 'max'=>999999999.99,'id'=>'PURCHASEid','label' => false, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="markup">Markup <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <?php echo $this->Form->control('markup', ['required' => true,'onkeyup' =>'saveMARKUP(this.value)', 'value'=>15, 'min'=>0, 'max'=>999,'label' => false, 'class' => 'form-control']); ?>
                            <div class="input-group-text">%</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="price_markup">Price after markup <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('price_markup', ['required' => true, 'placeholder' => 'Enter value in dollars','min'=>0, 'max'=>999999999.99,'id'=>'FINALid','label' => false, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="quantity">Quantity <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <?php echo $this->Form->control('quantity', ['required' => true,'value'=>1, 'min'=>1, 'max'=>99,'label' => false, 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group-prepend">
                            <?php $options = array('1' => 'New', '2' => 'Used');
                            echo $this->Form->control('status', ['required' => true, 'options' => $options, 'value' => 1,'type'=>'hidden', 'label' => false, 'class' => 'form-control', 'empty' => false]); ?>
                        </div>
                    </div>
                </div><br>
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
    function limit(event, value, maxLength) {
        if (value != undefined && value.toString().length >= maxLength) {
            event.preventDefault();
        }
    }
</script>

<script>
    const sorting_inventory = document.querySelector('.selectpicker-inventory');
    const sorting_receipt = document.querySelector('.selectpicker-receipt');
    // const commentSorting = document.querySelector('.selectpicker');
    // const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices_inventory = new Choices(sorting_inventory, {
        placeholder: false,
        itemSelectText: ''
    });
    const sortingchoices_receipts = new Choices(sorting_receipt, {
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
    let newMarkup = 15.00;
    let price = 0.00;
    let percent = 0.00;
    let final = 0.00;
    let rounded = 0.00;
    function saveMARKUP(value){
        newMarkup = value;
        price = document.getElementById('PURCHASEid').value
        percent = ((price/100) * newMarkup);
        final = (Number(price) + Number(percent));
        rounded = Math.round((Number(final) + Number.EPSILON) * 100) / 100;
        document.getElementById('FINALid').value= rounded;
    }
    function changePrice(){
        price = document.getElementById('PURCHASEid').value
        percent = ((price/100) * newMarkup);
        final = (Number(price) + Number(percent));
        rounded = Math.round((Number(final) + Number.EPSILON) * 100) / 100;
        document.getElementById('FINALid').value= rounded;
    }
</script>
<script>
    function limit(event, value, maxLength) {
        if (value != undefined && value.toString().length >= maxLength) {
            event.preventDefault();
        }
    }
</script>
