<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Part[]|\Cake\Collection\CollectionInterface $parts
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
</style>
<style>
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
<h3><?= __('Used Inventory Items Archive') ?></h3>


    <?= $this->Form->create(null,['url'=>['action'=>'deleteAll'],'onkeypress'=>"return event.keyCode != 13;"]) ?>

    <?= $this->Form->button('Delete All',['id'=>'del','confirm'=>'Are you sure you want to delete the selected item/s','style'=>'display: none;','class'=>'btn btn-danger'])?>

    <div class="table table-striped table-advance table-hover">
        <table data-toggle="table"
               data-search="true"
               data-header-style="headerStyle"
               data-custom-sort="customSort"
               class="table table-hover table-sm" style="table-layout: fixed">
            <thead>

            <tr>
                <th data-sortable="false" data-field="select"> #</th>
                <th data-sortable="true" data-field="ItemNo">Item ID</th>
                <th data-sortable="true" data-field="ServiceJob">Job used in</th>
                <th data-sortable="true" data-field="Category">Category</th>
                <th data-sortable="true" data-field="Receipt">Receipt</th>
                <th data-sortable="true" data-field="Price">Price</th>
                <th data-sortable="false" data-field="Status">Undo Archive</th>
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($parts as $part): ?>
                <tr>
                    <td ><?= $this ->Form ->checkbox('ids[]',['value'=>$part->id,'onclick'=>'if(this.checked){Checkbox()}else{Uncheckbox()}'])?></td>
                    <td><?= h("P".$part->id) ?></td>
                    <td class="ddd2"><?= $part->has('service_job') ? $this->Html->link("J".$part->service_job->id." (".$part->service_job->date_started->i18nFormat('dd/MM/yy').")", ['controller' => 'Service_Jobs', 'action' => 'view', $part->service_job->id]) : '' ?></td>
                    <td class="ddd2"><?= $part->has('inventory') ? $this->Html->link($part->inventory->brand." ".$part->inventory->name." ".$part->inventory->type, ['controller' => 'Inventories', 'action' => 'view', $part->inventory->id]) : '' ?></td>
                    <td class="ddd2"><?= $part->has('receipt') ? $this->Html->link("R".$part->receipt->id." (".$part->receipt->date->i18nFormat('dd/MM/yy').")", ['controller' => 'Receipts', 'action' => 'view', $part->receipt->id]) : '' ?></td>
                    <td style="text-align:center">$<?= $this->Number->format($part->individual_price) ?></td>
                    <td style="text-align:center">
                        <?php if ($part->status == '2') { ?>
                             <?= $this->Html->link(__('Undo'), ['controller' => 'Parts','action' => 'edit3', $part->id],['class'=>'btn btn-warning','escape' => false]) ?>

                        <?php } else if ($part->status == '1'){ ?>
                            <button type="button" class="btn btn-success" disabled> New</button>
                        <?php } ?> </td>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $part->id],['class'=>'btn btn-primary','title' => "View this item's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $part->id],['class'=>'btn btn-success','title' => "Edit this item's details", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $part->id], ['confirm' => __('Are you sure you want to delete the Inventory Item: {0}?', "P".$part->id),'class'=>'btn btn-danger','title' => "Delete this item", 'escape' => false]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

         <?= $this->Form->end() ?>
    </div>
    <div class="paginator">
        <ul class="pagination">
        </ul>
        <p><?= $this->Paginator->counter(__('There are a total {{count}} inventory items in the system')) ?></p>
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
        else if(sortName=="Price"||sortName=="ItemNo"){
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
            select: {
                css: {

                    width: '3%'
                }
            },
            ItemNo: {
                css: {

                    width: '9%'
                }
            },
            ServiceJob: {
                css: {

                    width: '12%'
                }
            },
            Category: {
                css: {

                    width: '31%'
                }
            },

            Receipt: {
                css: {

                    width: '15%'
                }
            },
            Status: {
                css: {

                    width: '11%'
                }
            },
            Price: {
                css: {

                    width: '9%'
                }
            },
            Actions: {
                css: {
                    width: '13%'
                }
            },

        } [column.field]
    }


    var checkvalue = 0;
    function Checkbox() {
        checkvalue ++;
        if (checkvalue != 0) {
            document.getElementById("del").style.display = "";
        }
    };

    function Uncheckbox() {
        checkvalue --;
        if (checkvalue == 0) {
            document.getElementById("del").style.display = "none";
        }
    };
</script>



