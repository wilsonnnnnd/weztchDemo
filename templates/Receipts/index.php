<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceJob[]|\Cake\Collection\CollectionInterface $receipts
 */
use Cake\I18n\Time;
?>

<style>
    .ddd{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 50px;
    }
    .float-right { float: left!important;}
</style>
<div class="ServiceJob index content">
    <h3><?= __('Receipts') ?></h3>
    <?= $this->Html->link(__('New Receipt'), ['action' => 'add'], ['class' => 'btn btn-info pull-right btn btn-lg']) ?>
    <div class="table table-striped table-advance table-hover" >
        <table data-toggle="table"
               data-search="true"
               data-page-list="[6]"
               data-header-style="headerStyle"
               data-custom-sort="customSort"
               class="table table-hover table-sm">
            <thead>
            <tr>
                <th data-sortable="true" data-field="ReceiptNo">ID</th>
                <th data-sortable="true" data-field="Date">Date</th>
                <th data-sortable="true" data-field="TotalPrice">Total Price (inc. GST)</th>
                <!-- <th data-sortable="true" data-field="GST">GST</th> -->
                <th data-sortable="true" data-field="Source">Source</th>
                <th data-sortable="true" data-field="JobType">Job Type</th>
                <th data-sortable="true" data-field="RecType">Record Type</th>
                <!-- <th data-sortable="true" data-field="Image">Image</th> -->
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($receipts as $receipt): ?>
                <tr>
                    <td ><?= h("R".$receipt->id) ?></td>
                    <td class="ddd"><?= h($receipt->date_name)?></td>
                    <td style="text-align:center">$<?= $this->Number->format($receipt->total_price) ?></td>
                    <!-- <td class="ddd">$<?= $this->Number->format($receipt->gst)?></td> -->
                    <td class="ddd"><?= h($receipt->purchase_source) ?></td>
                    <td class="ddd"><?= h($receipt->job_type) ?></td>
                    <td class="ddd"><?= h($receipt->receipt_type) ?></td>
                    <!-- <td class="ddd"><?= h($receipt->image) ?></td> -->
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $receipt->id],['class'=>'btn btn-primary','title' => "View this receipt's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $receipt->id],['class'=>'btn btn-success','title' => "Edit this receipt", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $receipt->id], ['confirm' => __('Are you sure you want to delete the receipt from {0}?', $receipt->receipt_name),'class'=>'btn btn-danger','title' => "Delete this receipt", 'escape' => false]) ?>
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
        <p><?= $this->Paginator->counter(__('There are a total {{count}} receipt records in the system')) ?></p>
    </div>
</div>
<script>
    function customSort(sortName, sortOrder, data) {
        var order = sortOrder === 'desc' ? -1 : 1;
        if (sortName == "Date") {
            data.sort(function (a, b) {
                var month1 = a[sortName].substring(3, 5);
                var day1 = a[sortName].substring(0, 2);
                var year1 = a[sortName].substring(6);
                var month2 = b[sortName].substring(3, 5);
                var day2 = b[sortName].substring(0, 2);
                var year2 = b[sortName].substring(6);
                var aa = new Date(year1, month1 - 1, day1);
                var bb = new Date(year2, month2 - 1, day2);
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else if(sortName=="GST"||sortName=="TotalPrice"||sortName=="ReceiptNo"){
            data.sort(function (a, b) {
                var aa=parseFloat( a[sortName].replaceAll(',','').substring(1));
                var bb=parseFloat(b[sortName].replaceAll(',','').substring(1));
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
                var aa=a[sortName].toLowerCase();
                var bb=b[sortName].toLowerCase();
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
            Actions: {
                css: {
                    width: '12%'
                }
            },

             id: {
                css: {
                    width: '12%'
                }
            },

             TotalPrice: {
                css: {
                    width: '12%'
                }
            },
        }[column.field]
    }
</script>
