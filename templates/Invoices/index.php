<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice[]|\Cake\Collection\CollectionInterface $invoices
 */
?>

<style>
    .ddd{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100px;
    }
    .float-right { float: left!important;}

    .ddd2 {
        text-decoration: underline;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100px;
    }
    .float-right {
        float: left !important;
    }
</style>
<h3><?= __('Invoices') ?></h3>

<div class="invoices index content">
    <?= $this->Html->link(__('New Invoice'), ['action' => 'add'], ['class' => "btn btn-info pull-right btn btn-lg"]) ?>
    <?= $this->Form->create() ?>
    <div class="form-inline">
        <?php echo $this->Form->control('Status', ['required' => true,'options' => ['0'=>'All Status','1'=>'Unpaid','2'=>'Paid'],'label'=>false,'class'=>'form-control','style'=>'width:100%']); ?>
        <?= $this->Form->submit('Search',['class'=>'btn btn-primary','style'=>'margin-left:8px','name'=>'btn']) ?>
    </div>
    <?= $this->Form->end() ?>
    <div class="table table-striped table-advance table-hover">
        <table data-toggle="table"
               data-search="true"
               data-header-style="headerStyle"
               data-custom-sort="customSort"
               class="table table-hover table-sm" >
            <thead>

            <tr>
                <th data-sortable="true" data-field="id">ID</th>
                <th data-sortable="true" data-field="Customer">Customer</th>
                <th data-sortable="true" data-field="Job">Job ID/Date</th>
                <th data-sortable="true" data-field="InvDate">Inv Date</th>
                <th data-sortable="true" data-field="PayDate">Pay Date</th>
                <th data-sortable="true" data-field="TotalCost">Total Cost (inc. GST)</th>
                <!-- <th data-sortable="true" data-field="GST">GST</th> -->
                <th data-sortable="false" data-field="Status">Status</th>

                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($invoices as $invoice): ?>
                <tr>
                    <td><?= h("i".$invoice->id) ?></td>
                    <td class="ddd2"><?= $invoice->has('customer') ? $this->Html->link($invoice->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $invoice->customer->id]) : '' ?></td>
                    <td class="ddd2"><?= $invoice->has('service_job') ? $this->Html->link("J".$invoice->service_job->id." (".$invoice->service_job->date_started->i18nFormat('dd/MM/yy').")", ['controller' => 'Service_Jobs', 'action' => 'view', $invoice->service_job->id]) : '' ?></td>
                    <td><?= h($invoice->invoice_date->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td><?= h($invoice->date_name) ?></td>
                    <td style="text-align:center">$<?= $this->Number->format($invoice->total_due) ?></td>
                    <!-- <td>$<?= $this->Number->format($invoice->gst) ?></td> -->
                    <td style="text-align:center">
                        <?php if ($invoice->status == '1') { ?>
                            <?= $this->Html->link(__('Unpaid'), ['controller' => 'Invoices','action' => 'edit2', $invoice->id],['confirm' => __("Would you like to change this invoice from 'Unpaid' to 'Paid'?"),'class'=>'btn btn-warning','escape' => false]) ?>


                        <?php } else if ($invoice->status == '2'){ ?>
                            <button type="button" class="btn btn-success" disabled> Paid</button>
                        <?php } ?> </td>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $invoice->id],['class'=>'btn btn-primary','title' => "View this invoice's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $invoice->id],['class'=>'btn btn-success','title' => "Edit this invoice", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete the invoice for {0}?', $invoice->customer->type_name. " (Invoice Date: ".$invoice->invoice_date.")"),'class'=>'btn btn-danger','title' => "Delete this invoice", 'escape' => false]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
        </ul>
        <p><?= $this->Paginator->counter(__('There are a total {{count}} invoice records in the system')) ?></p>
    </div>
</div>
<script>
    var url = new URL(window.location.href);
    var c = url.searchParams.get("param");
    var id= url.searchParams.get("id");
    console.log(c);
    if(c=='changeStatus'){
        location.replace('./Invoices/edit/'+id);
    }
    //service-jobs?param=changeStatus:197 changeStatus
    function customSort(sortName, sortOrder, data){
        var order = sortOrder === 'desc' ? -1 : 1;
        if(sortName=="InvDate" || sortName=="PayDate") {
            data.sort(function (a, b) {
                console.log(a[sortName]);
                var month1=a[sortName].substring(3,5);
                var day1=a[sortName].substring(0,2);
                var year1=a[sortName].substring(6);
                var month2=b[sortName].substring(3,5);
                var day2=b[sortName].substring(0,2);
                var year2=b[sortName].substring(6);
                var aa = new Date(year1,month1-1,day1);
                var bb = new Date(year2,month2-1,day2);
                console.log(aa);
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else if(sortName=="id" || sortName=="TotalCost" || sortName=="GST"){
            data.sort(function (a, b) {
                var aa=parseFloat( a[sortName].replaceAll(',','').substring(1));
                var bb=parseFloat(b[sortName].replaceAll(',','').substring(1));
                console.log(aa);
                console.log(bb);
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else if(sortName=="Customer"){
            data.sort(function (a, b) {
                console.log(a[sortName]);
                var aa=(a[sortName].substring(a[sortName].indexOf('">')+2,a[sortName].indexOf('</a>')));
                var bb=(b[sortName].substring(b[sortName].indexOf('">')+2,b[sortName].indexOf('</a>')));
                console.log(aa);
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else if(sortName=="Job"){
            data.sort(function (a, b) {
                console.log(a[sortName]);
                var aa=parseInt(a[sortName].substring(a[sortName].indexOf('>J')+2,a[sortName].indexOf('(')));
                var bb=parseInt(b[sortName].substring(b[sortName].indexOf('>J')+2,b[sortName].indexOf('(')));
                console.log(aa);
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else{
            data.sort(function (a, b) {
                console.log(a[sortName]);
                var aa=a[sortName].toLowerCase();
                var bb=b[sortName].toLowerCase();
                console.log(aa);
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
    }
    function headerStyle(column) {
        return {


           id: {
                css: {

                    width: '8%'
                }
            },
            Status: {
                css: {

                    width: '9%'
                }
            },

              Customer: {
                css: {

                    width: '20%'
                }
            },

            TotalCost: {
                css: {

                    width: '10%'
                }
            },






        } [column.field]
    }

</script>



