<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote $quote
 * @var \Cake\Collection\CollectionInterface|string[] $findQuotes
 * @var \Cake\Collection\CollectionInterface|string[] $findInvoices
 * @var \Cake\Collection\CollectionInterface|string[] $findJobs
 */
?>

<!DOCTYPE html>
<html lang="en">


<!--sidebar end-->

<!--main content start-->

<?= $this->Html->css('style.css') ?>
<!--overview start-->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a <?php echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'home'), array('escape' => false)); ?></a></li>
            </li>
            <li><i class="fa fa-laptop"></i>Dashboard</li>
        </ol>
    </div>
</div>

<!--/.row-->
<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fas fa-print"></i> Unpaid Invoices</h3>
            </div>
        </div>
        <table
               class="table table-hover table-sm" >
            <thead>

            <tr>
                <th data-sortable="true" data-field="Customer">Customer</th>
                <th data-sortable="true" data-field="Contact">Pref. Contact</th>
                <th data-sortable="true" data-field="JobID">Job ID</th>
                <th data-sortable="true" data-field="Status">Status</th>
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($findInvoices as $invoice): ?>
                <tr>
                    <td class="ddd2"><?= $invoice->has('customer') ? $this->Html->link($invoice->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $invoice->customer->id]) : '' ?></td>
                    <td class="ddd2"><?= $invoice->has('customer') ? $this->Html->link($invoice->customer->contact_name, ['controller' => 'Customers', 'action' => 'view', $invoice->customer->id]) : '' ?></td>
                    <td class="ddd2"><?= $invoice->has('service_job') ? $this->Html->link("J".$invoice->service_job->id, ['controller' => 'Service_Jobs', 'action' => 'view', $invoice->service_job->id]) : '' ?></td>
                    <td class="ddd">
                        <?php if ($invoice->status == '1') { ?>
                            <?= $this->Html->link(__('Unpaid'), ['controller' => 'Invoices','action' => 'edit2', $invoice->id],['confirm' => __("Would you like to change this invoice from 'Unpaid' to 'Paid'?"),'class'=>'btn btn-warning','escape' => false]) ?>


                        <?php } else if ($invoice->status == '2'){ ?>
                            <button type="button" class="btn btn-success" disabled> Paid</button>
                        <?php } ?> </td>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['controller'=>'Invoices','action' => 'view', $invoice->id],['class'=>'btn btn-primary','title' => "View this invoice's details", 'escape' => false]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fas fa-tools"></i> Upcoming Services Jobs</h3>

            </div>
        </div>
        <table     class="table table-hover table-sm" >
            <thead>
            <tr>
                <th data-sortable="true" data-field="Instrument" >Customer & Instrument</th>
                <th data-sortable="true" data-field="EstimateDate" >Est. Finish</th>
                <th data-sortable="true" data-filter-control="select" data-field="Status">Status</th>
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($findJobs as $serviceJob): ?>
                <tr>
                    <td class="ddd2"><?= $serviceJob->has('instrument') ? $this->Html->link($serviceJob->instrument->cust_name, ['controller' => 'Instruments', 'action' => 'view', $serviceJob->instrument->id]) : '' ?></td>
                    <td class="ddd2"><?= $serviceJob->has('quote') ? $this->Html->link($serviceJob->quote->estimated_completion->i18nFormat('dd/MM/yyyy'), ['controller' => 'Quotes', 'action' => 'view', $serviceJob->quote->id]) : '' ?></td>
                    <td class="ddd">
                        <?php if ($serviceJob->status == '1') { ?>
                            <?= $this->Html->link(__('Current'), ['controller' => 'ServiceJobs','action' => 'edit2', $serviceJob->id],['confirm' => __("Would you like to change this Job from 'Current' to 'Complete'?"),'class'=>'btn btn-warning','escape' => false]) ?>

                        <?php } else if ($serviceJob->status == '2'){ ?>
                            <button type="button" class="btn btn-success" disabled> Complete</button>

                        <?php } else if ($serviceJob->status == '3'){ ?>
                            <button type="button" class="btn btn-danger" disabled> Cancelled</button>

                        <?php } ?>
                    </td>

                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['controller'=>'ServiceJobs','action' => 'view', $serviceJob->id],['class'=>'btn btn-primary','title' => "View this job's details", 'escape' => false]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="far fa-copy"></i> Quotes soon to expire</h3>
            </div>
        </div>
        <table  class="table table-hover table-sm" >
            <thead>

            <tr>
                <th data-sortable="true" data-field="Customer">Customer</th>
                <th data-sortable="true" data-field="Contact">Pref. Contact</th>
                <th data-sortable="true" data-field="Expiry">Expiry</th>
                <th data-sortable="true" data-filter-control="select" data-field="Status">Status</th>
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($findQuotes as $quote) : ?>
                <tr>
                    <td class="ddd2"><?= $quote->has('customer') ? $this->Html->link($quote->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $quote->customer->id]) : '' ?></td>
                    <td class="ddd2"><?= $quote->has('customer') ? $this->Html->link($quote->customer->contact_name, ['controller' => 'Customers', 'action' => 'view', $quote->customer->id]) : '' ?></td>
                    <td><?= h($quote->expiry->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td style="width:50px">
                        <?php if ($quote->status == '1') { ?>
                            <?= $this->Html->link(__('No Job'), ['controller' => 'ServiceJobs','action' => 'add2', $quote->id],['confirm' => __('Would you like to attach the quote for {0} to a job?', $quote->pop_message),'class'=>'btn btn-warning','escape' => false]) ?>
                            <!--                                <button type="button" class="btn btn-warning" disabled> No Job</button>-->

                        <?php } else if ($quote->status == '2') { ?>
                            <button type="button" class="btn btn-success" disabled> Has Job</button>

                        <?php } ?>
                    </td>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['controller'=>'Quotes','action' => 'view', $quote->id],['class'=>'btn btn-primary','title' => "View this quote's details", 'escape' => false]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

