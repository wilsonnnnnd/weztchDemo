<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\JobTask[]|\Cake\Collection\CollectionInterface $jobTasks
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
    <h3><?= __('Job Tasks') ?></h3>

<div class="jobTasks index content">
    <?= $this->Html->link(__('New Job Task'), ['action' => 'add'], ['class' => "btn btn-info pull-right btn btn-lg"]) ?>
    <div class="table table-striped table-advance table-hover">
    <table data-toggle="table"
               data-search="true"
            data-header-style="headerStyle" data-custom-sort="customSort"
               class="table table-hover table-sm" style="table-layout: fixed">
               <thead>
                <tr>
                    <th data-sortable="true" data-field="Name">Name</th>
                    <th data-sortable="true" data-field="TaskTime">Task Time</th>
                    <th data-sortable="true" data-field="TaskCost">Task Cost</th>

                     <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobTasks as $jobTask): ?>
                <tr>
                <td class="ddd"><?= h($jobTask->name) ?></td>
                <td class="ddd"><?= h($jobTask->task_time) ?></td>
                <td class="ddd"><?= h($jobTask->task_cost) ?></td>

                <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $jobTask->id],['class'=>'btn btn-primary','title' => "View this job task's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $jobTask->id],['class'=>'btn btn-success','title' => "Edit this job task", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $jobTask->id], ['confirm' => __('Are you sure you want to delete {0}?', $jobTask->name),'class'=>'btn btn-danger','title' => "Delete this job task from the list?", 'escape' => false]) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>


<script>
    function customSort(sortName, sortOrder, data) {
        var order = sortOrder === 'desc' ? -1 : 1;
        if(sortName=="Customer"){
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
        else{
            data.sort(function (a, b) {
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


