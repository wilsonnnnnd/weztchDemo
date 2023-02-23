<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceJob[]|\Cake\Collection\CollectionInterface $serviceJobs
 */
use Cake\I18n\Time;
use Cake\Routing\Router;
?>

<style>
    .ddd{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 60px;
    }
    .float-right { float: left!important;}

    .ddd2 {
        text-decoration: underline;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px;
    }
    .float-right {
        float: left !important;
    }

</style>

<div class="ServiceJob index content">
    <h3><?= __('Service Jobs') ?></h3>
    <?= $this->Html->link(__('New Service Job'), ['action' => 'add'], ['class' => 'btn btn-info pull-right btn btn-lg']) ?>
    <?= $this->Form->create() ?>
    <div class="form-inline">
        <?php echo $this->Form->control('Status', ['required' => true,'options' => ['0'=>'All Status','1'=>'Current','2'=>'Completed','3'=>'Cancelled'],'label'=>false,'class'=>'form-control','style'=>'width:100%']); ?>
        <?= $this->Form->submit('Search',['class'=>'btn btn-primary','style'=>'margin-left:8px','name'=>'btn']) ?>
    </div>
    <?= $this->Form->end() ?>
    <div class="table table-striped table-advance table-hover" >
        <table data-toggle="table"
               data-search="true"
               data-page-list="[6]"
               data-header-style="headerStyle"
               data-custom-sort="customSort"
               class="table table-hover table-sm" >
            <thead>
                <tr>
                    <th data-sortable="true" data-field="id">ID</th>
                    <th data-sortable="true" data-field="Instrument" >Customer & Instrument</th>
                    <th data-sortable="true" data-field="Quote">Quote/Date</th>
                    <th data-sortable="true" data-field="StartDate" >Start Date</th>
                    <th data-sortable="true" data-field="Enddate" >End Date</th>
                    <!-- <th data-sortable="true" data-field="EstHours" >Est. Hours</th> -->

                    <th data-sortable="false" data-filter-control="select" data-field="Status">Status</th>
                    <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($serviceJobs as $serviceJob): ?>
                <tr>
                    <td class="ddd"><?= h("J".$serviceJob->id) ?></td>
                    <td class="ddd2"><?= $serviceJob->has('instrument') ? $this->Html->link($serviceJob->instrument->cust_name, ['controller' => 'Instruments', 'action' => 'view', $serviceJob->instrument->id]) : '' ?></td>
                    <td class="ddd2"><?= $serviceJob->has('quote') ? $this->Html->link("Q".$serviceJob->quote->id." (".$serviceJob->quote->date->i18nFormat('dd/MM/yy').")", ['controller' => 'Quotes', 'action' => 'view', $serviceJob->quote->id]) : '' ?></td>
                    <td class="ddd"><?= h($serviceJob->date_started->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td class="ddd"><?= h($serviceJob->date_name) ?></td>
                    <td style="text-align:center">
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
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $serviceJob->id],['class'=>'btn btn-primary','title' => "View this job's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $serviceJob->id],['class'=>'btn btn-success','title' => "Edit this job", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $serviceJob->id], ['confirm' => __('Are you sure you want to delete the job for {0}?', $serviceJob->instrument->cust_name." (".$serviceJob->date_started.")"),'class'=>'btn btn-danger','title' => "Delete this job", 'escape' => false]);
                            ?>

                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
            </ul>
            <p><?= $this->Paginator->counter(__('There are a total {{count}} customer records in the system')) ?></p>
        </div>
    </div>
</div>
<script>
    var url = new URL(window.location.href);
    var c = url.searchParams.get("param");

    if(c=='changeStatus'){
        var result=confirm("Do you want to add an Invoice?");
        if(result==true){
            location.replace('./Invoices/add');
        }
    }
    //service-jobs?param=changeStatus:197 changeStatus
    function customSort(sortName, sortOrder, data) {
        var order = sortOrder === 'desc' ? -1 : 1;
        if (sortName == "StartDate" ||sortName=="Enddate") {
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
        else if(sortName=="id"){
            data.sort(function (a, b) {
                var aa=parseFloat( a[sortName].substring(1));
                var bb=parseFloat(b[sortName].substring(1));
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else if(sortName=="Quote"){
            data.sort(function (a, b) {
                var aa=parseInt(a[sortName].substring(a[sortName].indexOf('>Q')+2,a[sortName].indexOf('(')));
                var bb=parseInt(b[sortName].substring(b[sortName].indexOf('>Q')+2,b[sortName].indexOf('(')));
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else if(sortName=="Instrument"){
            data.sort(function (a, b) {
                var aa=(a[sortName].substring(a[sortName].indexOf('">')+2,a[sortName].indexOf('</a>')).toLowerCase());
                var bb=(b[sortName].substring(b[sortName].indexOf('">')+2,b[sortName].indexOf('</a>')).toLowerCase());
                if (aa < bb) {
                    return order * -1;
                }
                if (aa > bb) {
                    return order;
                }
                return 0;
            })
        }
        else if(sortName=="EstHours"){
            data.sort(function (a, b) {
                //console.log(a[sortName]);
                var aa=parseFloat(a[sortName]==''?0:a[sortName]);
                var bb=parseFloat(b[sortName]==''?0:b[sortName]);
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
        else if(sortName=="ActHours"){
            data.sort(function (a, b) {
                var aa=parseFloat(a[sortName]);
                var bb=parseFloat(b[sortName]);;
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

            id : {
                css: {
                    width: '8%'
                }
            },

              Instrument : {
                css: {
                    width: '40%'
                }
            },
            StartDate: {
                css: {
                    width: '9%'
                }
            },
            EstHours: {
                css: {
                    width: '9%'
                }
            },
            Enddate: {
                css: {
                    width: '9%'
                }
            },
            Actions: {
                css: {
                    width: '12%'
                }
            },
            Status: {
                css: {
                    width: '10%'
                }
            },
        }[column.field]
    }
</script>
