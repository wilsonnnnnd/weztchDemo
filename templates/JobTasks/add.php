<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\JobTask $jobTask
 */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--<link rel="stylesheet" href="/resources/demos/style.css">-->
<?= $this->Html->css('choices.min.css'); ?>

<style>
    .bg-light {
        background: #eef0f4;
    }

    .choices__list--dropdown .choices__item--selectable {
        padding-bottom: 1rem !important;
    }

    .pt-4,
    .py-4 {
        padding-top: 7px !important;
    }

    .choices__list--single {
        padding: 0;
    }

    /*.card {*/
    /*    transform: translateY(-50%);*/
    /*}*/

    .choices[data-type*=select-one]:after {
        right: 1.5rem;
    }

    .shadow {
        box-shadow: 0.3rem 0.3rem 1rem rgba(178, 200, 244, 0.23);
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

</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="row">
<ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-tasks"></i><a <?php echo $this->Html->link('JobTask', array('controller' => 'JobTasks', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Add Job Tasks</li>
    </ol>
    <div class="card" style="width: 70rem;">
    <div class="card-body">
            <h5 class="card-title">Add Job Task</h5>
            <div class="card-text">

            <!-- <?= $this->Form->create($jobTask) ?>
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cust_id">Customer</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'Customers','action'=>'invoiceredirectadd'), array('escape'=>false, 'title' => "Click to add a new Customer")); ?>
                        <?php echo $this->Form->control('cust_id', ['onchange'=>'changeJobList(this.value)','required' => true, 'options' => $arr_customers, 'label' => false, 'class' => 'form-control selectpicker-customer border ddd']); ?>
                    </div> -->
            <div class="form-group">
                    <label for="name">Name</label><small> * </small>
                    <?php echo $this->Form->control('name', ['required' => false, 'maxlength' => 500,  'label' => false, 'class' => 'form-control']); ?>
                </div>

            <div class="form-group">
                    <label for="task_time">Task Time</label>
                    <?php echo $this->Form->control('task_time', ['required' => false, 'maxlength' => 500,  'label' => false, 'class' => 'form-control']); ?>
                </div>

            <div class="form-group">
                    <label for="task_cost">Task Cost</label>
                    <?php echo $this->Form->control('task_cost', ['required' => false, 'maxlength' => 500,  'label' => false, 'class' => 'form-control']); ?>
                </div>

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
