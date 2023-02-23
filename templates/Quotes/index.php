<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote[]|\Cake\Collection\CollectionInterface $quotes
 */

use Cake\I18n\Time;
?>

<style>
    .ddd {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100px;
    }
    .float-right {
        float: left !important;
    }

    .ddd2 {
        text-decoration: underline;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100px;
    }


    /* margin-right: auto;

margin-left: auto; */

</style>


<div class="quotes index content">
    <h3><?= __('Quotes') ?></h3>

    <?= $this->Html->link(__('New Quote'), ['action' => 'add'], ['class' => "btn btn-info pull-right btn btn-lg"]) ?>
    <?= $this->Form->create() ?>
    <div class="form-inline">
        <?php echo $this->Form->control('Status', ['required' => true,'options' => ['0'=>'All Status','1'=>'No Job','2'=>'Has Job'],'label'=>false,'class'=>'form-control','style'=>'width:100%']); ?>
        <?= $this->Form->submit('Search',['class'=>'btn btn-primary','style'=>'margin-left:8px','name'=>'btn']) ?>
    </div>
    <?= $this->Form->end() ?>

    <div class="table table-striped table-advance table-hover">
        <table data-toggle="table"
               data-search="true"
               data-header-style="headerStyle"
               data-custom-sort="customSort"
               class="table table-hover table-sm">
            <thead>

            <tr>
                <th data-sortable="true" data-field="Id">ID</th>
                <th data-sortable="true" data-field="Customer">Customer</th>
                <th data-sortable="true" data-field="Heading">Heading</th>
                <th data-sortable="true" data-field="QuoteDate">Quote Date</th>
                <th data-sortable="true" data-field="EstCost">Est. Total (Inc GST)</th>
                <!-- <th data-sortable="true" data-field="GST">GST</th> -->
                <th data-sortable="false" data-filter-control="select" data-field="Status">Status</th>
                <th class="actions" data-field="Actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($quotes as $quote) : ?>
                <tr>
                    <td class="ddd"><?= h("Q".$quote->id) ?></td>
                    <td class="ddd2"><?= $quote->has('customer') ? $this->Html->link($quote->customer->type_name, ['controller' => 'Customers', 'action' => 'view', $quote->customer->id]) : '' ?></td>
                    <td class="ddd"><?= h($quote->heading) ?></td>
                    <td><?= h($quote->date->i18nFormat('dd/MM/yyyy')) ?></td>
                    <td style="text-align:center">$<?= h($quote->estimated_total) ?></td>
                    <!-- <td class="ddd">$<?= h($quote->gst) ?></td> -->
                    <td style="text-align:center">
                        <?php if ($quote->status == '1') { ?>
                            <?= $this->Html->link(__('No Job'), ['controller' => 'ServiceJobs','action' => 'add2', $quote->id],['confirm' => __('Would you like to attach the quote for {0} to a job?', $quote->pop_message),'class'=>'btn btn-warning','escape' => false]) ?>
                            <!--                                <button type="button" class="btn btn-warning" disabled> No Job</button>-->

                        <?php } else if ($quote->status == '2') { ?>
                            <button type="button" class="btn btn-success" disabled> Has Job</button>

                        <?php } ?>
                    </td>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $quote->id],['class'=>'btn btn-primary','title' => "View this quote's details", 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $quote->id],['class'=>'btn btn-success','title' => "Edit this quote", 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $quote->id], ['confirm' => __('Would you like to delete the quote for {0}?', $quote->customer->type_name." (".$quote->date->i18nFormat('dd/MM/yyyy').")"),'class'=>'btn btn-danger','title' => "Delete this quote", 'escape' => false]) ?>
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
        <p><?= $this->Paginator->counter(__('There are a total {{count}} quote records in the system')) ?></p>
    </div>
</div>
<script>
    function customSort(sortName, sortOrder, data) {
        var order = sortOrder === 'desc' ? -1 : 1;
        if (sortName == "QuoteDate" ||sortName=="Expiry"||sortName=="EstFinish") {
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
        else if(sortName=="Customer"){
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
        else if(sortName=="EstCost" ||sortName=="GST" ||sortName=="Id"){
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
            EstCost: {
                css: {
                    width: '12%'
                }
            },

             Status: {
                css: {
                    width: '9%'
                }
            },

            Heading: {
                css: {
                    width: '27%'
                }
            },
            QuoteDate: {
                css: {
                    width: '11%'
                }
            },
            }[column.field]
        }

</script>
