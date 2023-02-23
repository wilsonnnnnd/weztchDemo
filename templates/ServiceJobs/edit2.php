<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceJob $serviceJob
 * @var string[]|\Cake\Collection\CollectionInterface $instruments
 * @var string[]|\Cake\Collection\CollectionInterface $quotes
 */
?>
<?= $this->Html->css('choices.min.css'); ?>
<style>
    .choices__list--dropdown .choices__item--selectable {
        padding-bottom: 1rem !important;
    }

    .pt-4,
    .py-4 {
        padding-top: 7px !important;
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
        <ol class="breadcrumb">
            <li><i class="fas fa-tools"></i><a <?php echo $this->Html->link('Service Jobs', array('controller' => 'ServiceJobs', 'action' => 'index'), array('escape' => false)); ?></a></li>
            <li><i class="far fa-edit"></i>Update Job Status</li>
            <li><i class="fa fa-id-card-o"></i><?= h("Job Start Date: ".$serviceJob->date_started->i18nFormat('dd/MM/yyyy')." (J".$serviceJob->id.")") ?></li>
        </ol>
    </div>
</div>

<div class="card" style="width: 70rem;">
    <div class="card-body">
        <h2 class="card-title">Update Job Status</h2><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div><br>
        <div class="card-text">
            <p></p>
                <?= $this->Form->create($serviceJob) ?>
                <?php echo $this->Form->control('inst_id', ['required' => true, 'options' => $instruments, 'type' => 'hidden', 'label' => false, 'class' => 'selectpicker form-control border-0 mb-1 px-4 py-4 rounded shadow']); ?>
                <?php echo $this->Form->control('quo_id', ['required' => true, 'options' => $quotes, 'label' => false, 'type' => 'hidden', 'class' => 'selectpicker2 form-control border-0 mb-1 px-4 py-4 rounded shadow']); ?>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_started">Job Start Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('date_started', ['required' => true, 'type' => 'date', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="date_completed">Job End Date <div class = red>*</div></label>
                    <?php echo $this->Form->control('date_completed', ['required' => true, 'type' => 'date','value'=>date("m/d/Y"), 'label' => false, 'class' => 'form-control']); ?>
                </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="estimated_time">Estimated Hours of Work Needed <div class = white>*</div></label>
                        <?php echo $this->Form->control('estimated_time', ['required' => false,'placeholder' => 'Enter time in hours', 'label' => false, 'min'=>0, 'max'=>999999, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="time_taken">Actual Hours of Work Taken <div class = white>*</div></label>
                        <?php echo $this->Form->control('time_taken', ['required' => false, 'label' => false,'placeholder' => 'Enter time in hours' ,'min'=>0, 'max'=>999999, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Status <div class = red>*</div></label>
                        <?php $options = array('2' => 'Complete', '3' => 'Cancelled');
                        echo $this->Form->control('status', ['required' => true, 'options' => $options, 'value' => 2, 'label' => false, 'class' => 'form-control', 'empty' => false]); ?>
                    </div>
                </div><br>
                <div class="form-group">
                    <label for="jobs_performed">Jobs Performed <div class = red>*</div></label>
                    <?php echo $this->Form->control('jobs_performed', ['required' => true, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'label' => false, 'class' => 'form-control']); ?>
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
    const sorting2 = document.querySelector('.selectpicker2');
    const commentSorting2 = document.querySelector('.selectpicker2');
    const sortingchoices2 = new Choices(sorting2, {
        placeholder: false,
        itemSelectText: ''
    });


    // Trick to apply your custom classes to generated dropdown menu
    let sortingClass2 = sorting2.getAttribute('class');
    window.onload = function() {
        sorting2.parentElement.setAttribute('class', sortingClass2);
    }
</script>
