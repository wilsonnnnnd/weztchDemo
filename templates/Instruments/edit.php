<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument $instrument
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<?= $this->Html->css('choices.min.css'); ?>
<style>
    a {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
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

    .legend {
        font-style: normal;
        font-size: 100%;
        display: inline-block;
        white-space: nowrap;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-guitar"></i>Instruments</h3>
        <ol class="breadcrumb">
            <li><i class="fas fa-guitar"></i><a <?php echo $this->Html->link('Instruments', array('controller' => 'Instruments', 'action' => 'index'), array('escape' => false)); ?></a></li>
            <li><i class="far fa-edit"></i>Edit Instrument</li>
            <li><i class="fa fa-id-card-o"></i><?= h($instrument->cust_name) ?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="card" style="width: 85rem;">
        <div class="card-body">
            <h2 class="card-title">Edit Instrument</h2>
            <div class="card-text">
                <?= $this->Form->postLink(
                    __('Delete Instrument'),
                    ['action' => 'delete', $instrument->id],
                    ['confirm' => __('Are you sure you want to delete {0}?', $instrument->cust_name), 'class' => 'btn btn-danger']
                ) ?>
                <p></p><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div><br>
                <?= $this->Form->create($instrument) ?>
                <div class="form-group">
                    <label for="cust_id">Customer</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'Customers','action'=>'add'), array('escape'=>false, 'title' => "Click to add a new Customer")); ?>
                    <?php echo $this->Form->control('cust_id', ['required' => true, 'options' => $arr_customers, 'label' => false, 'class' => 'form-control selectpicker-customer border']); ?>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="type">Type <div class = red>*</div></label>
                        <?php $options = array('Electric Guitar' => 'Electric Guitar', 'Acoustic Guitar' => 'Acoustic Guitar', 'Electric Bass' => 'Electric Bass', 'Acoustic Bass' => 'Acoustic Bass',
                            'Banjo' => 'Banjo', 'Mandolin' => 'Mandolin', 'Amplifier' => 'Amplifier', 'Stringed Instrument (Other)' => 'Stringed Instrument (Other)', 'Electronic Equipment (Other)' => 'Electronic Equipment (Other)');
                        echo $this->Form->control('type', ['required' => true, 'options' => $options, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="brand">Brand <div class = red>*</div></label>
                        <?php echo $this->Form->control('brand', ['required' => true, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="model">Model <div class = red>*</div></label>
                        <?php echo $this->Form->control('model', ['required' => true, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="country">Country</label>
                        <?php echo $this->Form->control('country', ['required' => false, 'pattern' => '[a-zA-Z0-9 ]*', 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="year">Year</label>
                        <?php echo $this->Form->control('year', ['required' => false, 'maxlength' => 4, 'placeholder' => 'Maximum length: 4', 'type' => 'number', 'min' => 1901, 'Max' => 2155, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="serial_number">Serial Number</label>
                        <?php echo $this->Form->control('serial_number', ['required' => false, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="last_serviced">Date of Last Service</label>
                        <?php echo $this->Form->control('last_serviced', ['required' => false, 'type' => 'date', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <!-- <div class="form-group">
                    <label for="image">Image</label><small> (Optional)</small>
                    <?php echo $this->Form->control('image', ['required' => false,'label' => false,'type' => 'file','label'=>false]); ?>
                </div> -->
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
