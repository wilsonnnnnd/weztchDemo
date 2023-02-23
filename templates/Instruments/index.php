<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument[]|\Cake\Collection\CollectionInterface $instruments
 */


echo $this->Html->css('/backend/css/elegant-icons-stye.css');
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
    <h3><?= __('Instruments') ?></h3>
<div class="instruments index content">
    <?= $this->Html->link(__('New Instrument'), ['action' => 'add'], ['class' => "btn btn-info pull-right btn btn-lg"]) ?>
    <div class="table table-striped table-advance table-hover">
    <table data-toggle="table"
               data-search="true"
            data-header-style="headerStyle" data-custom-sort="customSort"
               class="table table-hover table-sm" style="table-layout: fixed">
               <thead>
            <tr>


                    <th data-sortable="true" data-field="Customer">Customer</th>
                    <th data-sortable="true" data-field="Type">Type</th>
                    <th data-sortable="true" data-field="Brand">Brand</th>
                    <th data-sortable="true" data-field="Model">Model</th>
                    <th data-sortable="true" data-field="Country">Country</th>
                    <th data-sortable="true" data-field="Year">Year</th>
                    <th data-sortable="false" data-field="SerialNo">Serial No.</th>
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($instruments as $instrument): ?>
                <tr>
                    <td class="ddd2"><?= $instrument->has('customer') ? $this->Html->link($instrument->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $instrument->customer->id]) : '' ?></td>
                    <td class="ddd"><?= h($instrument->type) ?></td>
                    <td class="ddd"><?= h($instrument->brand) ?></td>
                    <td class="ddd"><?= h($instrument->model) ?></td>
                    <td class="ddd"><?= h($instrument->country) ?></td>
                    <td><?= h($instrument->year) ?></td>
                    <td class="ddd"><?= h($instrument->serial_number) ?></td>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $instrument->id],['class'=>'btn btn-primary','title' => "View this instrument's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $instrument->id],['class'=>'btn btn-success','title' => "Edit this instrument", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $instrument->id], ['confirm' => __('Are you sure you want to delete {0}?', $instrument->cust_name),'class'=>'btn btn-danger','title' => "Delete this instrument", 'escape' => false]) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">

            </ul>
            <p><?= $this->Paginator->counter(__('There are a total {{count}} instrument records in the system')) ?></p>
        </div>
    </div>
</div>
<script>
    function customSort(sortName, sortOrder, data) {
        var order = sortOrder === 'desc' ? -1 : 1;
        if(sortName=="Customer"){
            data.sort(function (a, b) {
                var aa=(a[sortName].substring(a[sortName].indexOf('">')+2,a[sortName].indexOf('</a>')));
                var bb=(b[sortName].substring(b[sortName].indexOf('">')+2,b[sortName].indexOf('</a>')));
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
            Country: {
                css: {
                    width: '10%'
                }
            },
            Year: {
                css: {
                    width: '7%'
                }
            },
            Actions: {
                css: {
                    width: '12%'
                }
            },
            Brand: {
                css: {
                    width: '11%'
                }
            }
        }[column.field]
    }
</script>

