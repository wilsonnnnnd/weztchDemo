<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceJob $serviceJob
 * @var \Cake\Collection\CollectionInterface|string[] $instruments
 * @var \Cake\Collection\CollectionInterface|string[] $quotes
 */
?>
<?= $this->Html->css('choices.min.css'); ?>
<style>


    .choices__list--dropdown .choices__item--selectable {
        padding-bottom: 1rem !important;
    }

    .ddd {
        max-width: 500px;
        text-overflow: clip ;
        overflow: hidden;
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
        <h3 class="page-header"><i class="fas fa-tools"></i>Service Job</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-tools"></i><a <?php echo $this->Html->link('Service Jobs', array('controller' => 'ServiceJobs', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Add Job</li>
    </ol>
    <div class="card" style="width: 70rem;">
        <div class="card-body"><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div>
            <h5 class="card-title">Add New Service Job</h5>
            <div class="card-text">
                <?= $this->Form->create($serviceJob) ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inst_id">Instrument</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'Instruments','action'=>'jobredirectadd'), array('escape'=>false, 'title' => "Click to add a new Instrument")); ?>
                        <?php echo $this->Form->control('inst_id', ['required' => true, 'options' => $instruments, 'label' => false, 'class' => 'form-control selectpicker-instrument border ddd']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="quo_id">Quote</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'Quotes','action'=>'jobredirectadd'), array('escape'=>false, 'title' => "Click to add a new Quote")); ?>
                        <?php echo $this->Form->control('quo_id', ['required' => true, 'options' => $quotes, 'label' => false, 'class' => 'form-control selectpicker-quote border ddd']); ?>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_started">Job Start Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('date_started', ['required' => true, 'type' => 'date','value'=>date("m/d/Y"), 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estimated_time">Estimated Hours of Work Needed <div class = white>*</div></label>
                        <?php echo $this->Form->control('estimated_time', ['required' => false, 'label' => false,'placeholder' => 'Enter time in hours', 'min'=>0, 'max'=>999999,'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <?php echo $this->Form->control('description', ['required' => false, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'label' => false, 'class' => 'form-control']); ?>
                </div><br>
                <h5 class="card-title">For Completed Service Jobs:</h5>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_completed">Job End Date <div class = white>*</div></label>
                        <?php echo $this->Form->control('date_completed', ['required' => false, 'type' => 'date', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="time_taken">Actual Hours of Work Taken <div class = white>*</div></label>
                        <?php echo $this->Form->control('time_taken', ['required' => false, 'label' => false,'placeholder' => 'Enter time in hours', 'min'=>0, 'max'=>999999, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Status <div class = red>*</div></label>
                        <?php $options = array('1' => 'Current', '2' => 'Complete', '3' => 'Cancelled');
                        echo $this->Form->control('status', ['required' => true, 'options' => $options, 'label' => false, 'class' => 'form-control', 'empty' => false]); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jobs_performed">Jobs Performed</label>
                    <?php echo $this->Form->control('jobs_performed', ['required' => false, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'label' => false, 'class' => 'form-control']); ?>
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

<script>
    const sorting_instrument = document.querySelector('.selectpicker-instrument');
    const sorting_quote = document.querySelector('.selectpicker-quote');
    // const commentSorting = document.querySelector('.selectpicker');
    // const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices_instrument = new Choices(sorting_instrument, {
        placeholder: false,
        itemSelectText: ''
    });
    const sortingchoices_quote = new Choices(sorting_quote, {
        placeholder: false,
        itemSelectText: ''
    });

    // Trick to apply your custom classes to generated dropdown menu
    let sortingClass = sorting.getAttribute('class');
    window.onload = function() {
        sorting.parentElement.setAttribute('class', sortingClass);
    }
</script>
