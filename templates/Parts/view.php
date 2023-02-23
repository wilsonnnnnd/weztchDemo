<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Part $part
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

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-cubes"></i>Inventory Item</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-cubes"></i><a <?php echo $this->Html->link('Inventory', array('controller' => 'Parts', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-eye"></i>View Inventory Item</li>
        <li><i class="fa fa-id-card-o"></i><?= h("P".$part->id) ?></li>
    </ol>
    <div class="table table-hover">
        <div class="side-nav left" >
            <?= $this->Html->link(__('Edit Inventory Item'), ['action' => 'edit', $part->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Inventory Item'), ['action' => 'delete', $part->id], ['confirm' => __('Are you sure you want to delete the Inventory Item: {0}?', "P".$part->id), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div><br>
        <tr class="customers view content">
            <table>

                <tr>
                    <th><?= __('Inventory Item ID') ?></th>
                    <td>P<?= h($part->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Inventory Category') ?></th>
                    <td class = ddd><?= $part->has('inventory') ? $this->Html->link($part->inventory->brand." ".$part->inventory->name." ".$part->inventory->type, ['controller' => 'Inventories', 'action' => 'view', $part->inventory->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?php if ($part->status == '1') { ?>
                                New (no Job)
                        <?php } else if ($part->status == '2'){ ?>
                                Used (archived)
                        <?php } else { ?>
                                No Status
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Related Receipt') ?></th>
                    <td class = ddd><?= $part->has('receipt') ? $this->Html->link("Rec ID: R".$part->receipt->id." | Date: ".$part->receipt->date->i18nFormat('dd/MM/yyyy')." | Source: ".$part->receipt->purchase_source." | Total Price: $".$part->receipt->total_price, ['controller' => 'Receipts', 'action' => 'view', $part->receipt->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Service Job Used In') ?></th>
                    <td class = ddd><?= $part->has('service_job', 'instrument') ? $this->Html->link("Job ID: J".$part->service_job->id." | Job Start Date: ".$part->service_job->date_started->i18nFormat('dd/MM/yy'), ['controller' => 'Service_Jobs', 'action' => 'view', $part->service_job->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Serial Number') ?></th>
                    <td><?= h($part->serial_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price of Item at Purchase') ?></th>
                    <td>$<?= $this->Number->format($part->individual_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price after markup') ?></th>
                    <td>$<?= $this->Number->format($part->price_markup) ?></td>
                </tr>
            </table>

    </div>

</div>
<?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>

</div>
