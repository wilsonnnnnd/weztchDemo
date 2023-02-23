<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventory[]|\Cake\Collection\CollectionInterface $inventories
 * @var \App\Controller\InventoriesController $new
 *
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

    .ddd2{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 50px;
    }
    .float-right { float: left!important;}
</style>
<div class="ServiceJob index content">
    <h3><?= __('Inventory Categories') ?></h3>
    <?= $this->Html->link(__('New Inventory Category'), ['action' => 'add'], ['class' => 'btn btn-info pull-right btn btn-lg']) ?>
    <div class="table table-striped table-advance table-hover" >
        <table data-toggle="table"
               data-search="true"
               data-page-list="[6]"
               data-header-style="headerStyle"
               data-custom-sort="customSort"
               class="table table-hover table-sm" >
            <thead>
            <tr>
                <th data-sortable="true" data-field="Name">Name</th>
                <th data-sortable="true" data-field="Type">Type</th>
                <th data-sortable="true" data-field="Brand">Brand</th>
                <th data-sortable="true" data-field="PartNo">Part No.</th>
                <th data-sortable="true" data-field="RetailPrice">Retail Price</th>
                <th data-sortable="false" data-field="Amount">Qty</th>
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($inventories as $inventory): ?>
                <tr>
                    <td class="ddd"><?= h($inventory->name) ?></td>
                    <td class="ddd"><?= h($inventory->type) ?></td>
                    <td class="ddd"><?= h($inventory->brand) ?></td>
                    <td class="ddd"><?= h($inventory->part_no) ?></td>
                    <td style="text-align:center">$<?= $this->Number->format($inventory->retail_price) ?></td>
                    <td class="ddd"><?= h($new[$inventory->id]) ?></td>

                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $inventory->id],['class'=>'btn btn-primary','title' => "View this item's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $inventory->id],['class'=>'btn btn-success','title' => "Edit this item", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $inventory->id], ['confirm' => __('Are you sure you want to delete the Inventory Category: {0}?', $inventory->brand." ".$inventory->name." ".$inventory->type),'class'=>'btn btn-danger','title' => "Delete this item", 'escape' => false]) ?>
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
        <p><?= $this->Paginator->counter(__('There are a total {{count}} inventory categories in the system')) ?></p>
    </div>
</div>
<script>
    function cateqty(results){
        return results == null ? 0 : (results[1] || 0);
    }

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
        else if(sortName=="Amount"||sortName=="RetailPrice"){
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

            Amount: {
                css: {
                    width: '7%'
                }
            },

            Brand: {
                css: {

                    width: '13%'
                }
            },

             Actions: {
                css: {

                    width: '12%'
                }
            },

            RetailPrice: {
                css: {

                    width: '5%'
                }
            },
        }[column.field]
    }
</script>
