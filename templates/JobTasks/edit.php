<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\JobTask $jobTask
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
</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-cubes"></i>Job Tasks List</h3>
    </div>
</div>

<div class="row">
<ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-tasks"></i><a <?php echo $this->Html->link('JobTask', array('controller' => 'JobTasks', 'action' => 'edit'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Edit Job Task</li>
    </ol>
    <div class="card" style="width: 70rem;">
    <div class="card-body">
    <h2 class="card-title">Edit Job Task</h2>
            <div class="card-text">
                <?= $this->Form->postLink(
                    __('Delete Job Task'),
                    ['action' => 'delete', $jobTask->id],
                    ['confirm' => __('Are you sure you want to delete the Job Task: {0}?', $jobTask->name), 'class' => 'btn btn-danger']
                ) ?>
                <p><br></p>

            <?= $this->Form->create($jobTask) ?>
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
