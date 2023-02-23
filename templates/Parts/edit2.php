<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Part $part
 * @var string[]|\Cake\Collection\CollectionInterface $inventories
 * @var string[]|\Cake\Collection\CollectionInterface $serviceJobs
 * @var string[]|\Cake\Collection\CollectionInterface $receipts
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
        <li><i class="far fa-edit"></i>Connect Inventory Item to Job</li>
        <li><i class="fa fa-id-card-o"></i>P<?= h($part->id) ?></li>
    </ol>
    <div class="card" style="width: 70rem;">
        <div class="card-body">
            <h2 class="card-title">Connect Inventory Item to Job</h2>
            <div class="card-text">
                <p><br></p>
                <?= $this->Form->create($part) ?>
                <div class="form-group">
                    <label for="job_id">Service Job Item Used in</label>
                    <?php echo $this->Form->control('job_id', ['required' => true, 'options' => $arr_serviceJobs, 'label' => false, 'class' => 'form-control selectpicker-inventory border']); ?>
                </div><br>
                <div class="col-auto">
                    <div class="input-group-prepend">
                        <?php $options = array('2' => 'Used');
                        echo $this->Form->control('status', ['required' => true, 'options' => $options,'value' => 2,'type'=>'hidden', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
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

<script>
    const sorting_inventory = document.querySelector('.selectpicker-inventory');
    const sorting_job = document.querySelector('.selectpicker-job');
    // const commentSorting = document.querySelector('.selectpicker');
    // const commentSorting = document.querySelector('.selectpicker');
    const sortingchoices_inventory = new Choices(sorting_inventory, {
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


