<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote $quote
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
        <h3 class="page-header"><i class="far fa-copy"></i>Quote</h3>

    </div>
</div>
<aside class="row">

</aside>
<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="far fa-copy"></i><a <?php echo $this->Html->link('Quote', array('controller' => 'Quotes', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="fa fa-eye"></i>View Quote</li>
        <li><i class="fa fa-id-card-o"></i><?= h($quote->QuoteName." (Q".$quote->id.")") ?></li>
    </ol>
    <div class="table table-hover">
        <div class="side-nav left">
            <?= $this->Html->link(__('Edit Quote'), ['action' => 'edit', $quote->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Quote'), ['action' => 'delete', $quote->id], ['confirm' => __('Would you like to delete the quote for {0}?', $quote->customer->type_name." (".$quote->date->i18nFormat('dd/MM/yyyy').")"), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div>
        <div class="customers view content">
            <br>
            <h2><?= h($quote->QuoteName) ?></h2>
            <table style="width: 85%">
                <tr>
                    <th><?= __('Quote ID') ?></th>
                    <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h("Q".$quote->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td class = ddd><?= $quote->has('customer') ? $this->Html->link($quote->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $quote->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Heading') ?></th>
                    <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($quote->heading) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quote Date') ?></th>
                    <td><?= h($quote->date->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Expiry') ?></th>
                    <td><?= h($quote->expiry->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estimated Date of Completion') ?></th>
                    <td><?= h($quote->estimated_completion->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estimated Cost') ?></th>
                    <td>$<?= h($quote->estimated_cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('GST') ?></th>
                    <td>$<?= h($quote->gst) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estimated Total Cost') ?></th>
                    <td>$<?= h($quote->estimated_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($quote->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Items Required') ?></th>
                    <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($quote->items_required) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?php if ($quote->status == '1') { ?>
                            <a class="btn btn-block btn-warning btn-sm" disabled style="width:15%">
                                No job
                            </a>
                        <?php } else if ($quote->status == '2'){ ?>
                            <a class="btn btn-block btn-success btn-sm" disabled style="width:15%">
                                Has job
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-block btn-primary btn-sm" disabled style="width:15%">
                                No Status
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            </table>

        </div>

    </div>
    <?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
</div>
