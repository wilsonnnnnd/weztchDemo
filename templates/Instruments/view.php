<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument $instrument
 */
?>
<style>
    .ddd {
        color: mediumblue;
        text-decoration: underline;
        word-break:break-all;
        overflow:hidden;
    }
</style>


<style>
    .instrument_img{width:400px !important;}
</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-guitar"></i>Instrument</h3>

    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-guitar"></i><a <?php echo $this->Html->link('Instrument', array('controller' => 'Quotes', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="fa fa-eye"></i>View Instrument</li>
        <li><i class="fa fa-id-card-o"></i><?= h($instrument->cust_name) ?></li>
    </ol>
    <div class="table table-hover">
        <div class="side-nav left">
            <?= $this->Html->link(__('Edit Instrument'), ['action' => 'edit', $instrument->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Instrument'), ['action' => 'delete', $instrument->id], ['confirm' => __('Are you sure you want to delete {0}?', $instrument->cust_name), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div>
        <div class="customers view content">
            <br>
            <h2><?= h($instrument->cust_name) ?></h2>
            <table style="width: 85%">

                <tr>
                    <th><?= __('Customer') ?></th>
                    <td class = ddd><?= $instrument->has('customer') ? $this->Html->link($instrument->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $instrument->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($instrument->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Brand') ?></th>
                    <td><?= h($instrument->brand) ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= h($instrument->model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Country of Manufacture') ?></th>
                    <td><?= h($instrument->country) ?></td>
                </tr>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= h($instrument->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Serial Number') ?></th>
                    <td><?= h($instrument->serial_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date of Last Service') ?></th>
                    <td><?= h($instrument->date_name) ?></td>
                </tr>

                <tr>
                    <th><?= __('Description') ?></th>
                    <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($instrument->description) ?></td>
                </tr>

                 <!-- <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= $this->Html->image($instrument->image, array('class'=>'instrument_img')) ?></td>
                </tr> -->
            </table>

        </div>

    </div>

    <?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
</div>
<!--//set the submit only can submit once-->
<script type="text/javascript">
    $('form').submit(function() {
        $(this).find("button[type='Submit']").prop('disabled',true);
    });
</script>
