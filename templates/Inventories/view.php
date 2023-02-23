<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventory $inventory
 */
?>
<style>
    .img{width:400px !important;}
</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-cubes"></i>Inventory Category</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-cubes"></i><a <?php echo $this->Html->link('Inventory', array('controller' => 'Inventories', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-eye"></i>View Inventory Category</li>
        <li><i class="fa fa-id-card-o"></i><?= h($inventory->brand." ".$inventory->name." ".$inventory->type) ?></li>
    </ol>
    <div class="table table-hover">
        <div class="side-nav left" >
            <?= $this->Html->link(__('Edit Inventory Category'), ['action' => 'edit', $inventory->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Inventory Category'), ['action' => 'delete', $inventory->id], ['confirm' => __('Are you sure you want to delete the Inventory Category: {0}?', $inventory->brand." ".$inventory->name." ".$inventory->type), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div><br>
        <tr class="customers view content">
            <table style="width: 85%">

                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($inventory->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($inventory->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Brand') ?></th>
                    <td><?= h($inventory->brand) ?></td>
                </tr>
                <tr>
                    <th><?= __('Part Number') ?></th>
                    <td><?= h($inventory->part_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Retail Price') ?></th>
                    <td>$<?= $this->Number->format($inventory->retail_price) ?></td>
                </tr>
                <tr>
                    <div class="text">
                        <th> <strong><?= __('Description') ?></strong></th>
                        <td style="white-space:normal; word-break:break-all;overflow:hidden;">
                            <?= $this->Text->autoParagraph(h($inventory->description)); ?>
                        </td>
                    </div>

                </tr>
            </table>

    </div>

</div>
<?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>

</div>
