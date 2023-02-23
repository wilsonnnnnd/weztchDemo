<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice $invoice
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
        <h3 class="page-header"><i class="fas fa-print"></i>Invoice</h3>

    </div>
</div>

<aside class="row">
</aside>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-print"></i><a <?php echo $this->Html->link('Invoice', array('controller' => 'Invoices', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="fa fa-eye"></i>View Invoice</li>
        <li><i class="fa fa-id-card-o"></i><?= h($invoice->InvoiceName." (i".$invoice->id.")") ?></li>
    </ol>
<div class="table table-hover">
    <div class="side-nav left">
        <?= $this->Html->link(__('Edit Invoice'), ['action' => 'edit', $invoice->id], ['class'=>'btn btn-success']) ?>
        <?= $this->Form->postLink(__('Delete Invoice'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete the invoice for {0}?', $invoice->customer->type_name. " (Invoice Date: ".$invoice->invoice_date.")"), 'class' => 'w3-btn w3-round-large w3-red']) ?>
    </div>
    <br>
    <div class="customers view content">
        <h2><?= h($invoice->InvoiceName) ?></h2>
        <table style="width: 85%">
            <tr>
                <th><?= __('Invoice ID') ?></th>
                <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h("i".$invoice->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Customer') ?></th>
                <td class = ddd><?= $invoice->has('customer') ? $this->Html->link($invoice->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $invoice->customer->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Service Job') ?></th>
                <td class = ddd><?= $invoice->has('service_job', 'instrument') ? $this->Html->link("Job ID: J".$invoice->service_job->id." | Job Start Date: ".$invoice->service_job->date_started->i18nFormat('dd/MM/yy'), ['controller' => 'Service_Jobs', 'action' => 'view', $invoice->service_job->id]) : '' ?></td>
            </tr>

            <tr>
                <th><?= __('Heading') ?></th>
                <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($invoice->heading) ?></td>
            </tr>
            <tr>
                <th><?= __('Invoice Date') ?></th>
                <td><?= h($invoice->invoice_date->i18nFormat('dd/MM/yyyy')) ?></td>
            </tr>
            <tr>
                <th><?= __('Payment Date') ?></th>
                <td><?= h($invoice->date_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Amount Due') ?></th>
                <td>$<?= h($invoice->amount_due) ?></td>
            </tr>
            <tr>
                <th><?= __('GST') ?></th>
                <td>$<?= h($invoice->gst) ?></td>
            </tr>
            <tr>
                <th><?= __('Total Cost') ?></th>
                <td>$<?= h($invoice->total_due) ?></td>
            </tr>
            <tr>
                <th><?= __('Description') ?></th>
                <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($invoice->description) ?></td>
            </tr>
            <th><?= __('Status') ?></th>
            <td><?php if ($invoice->status == '1') { ?>
                    <a class="btn btn-block btn-warning btn-sm" disabled>
                        Unpaid
                    </a>
                <?php } else if ($invoice->status == '2'){ ?>
                    <a class="btn btn-block btn-success btn-sm" disabled>
                        Paid
                    </a>
                <?php } else { ?>
                    <a class="btn btn-block btn-primary btn-sm" disabled>
                        No Status
                    </a>
                <?php } ?>
            </td>
        </table>

    </div>

</div>
<?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
</div>
