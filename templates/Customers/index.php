<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */


echo $this->Html->css('/backend/css/elegant-icons-style.css');
?>
<style>
    .ddd{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100px;
    }
    .float-right { float: left!important;}
    .message success{
        color: red;
    }

</style>
    <h3><?= __('Customer') ?></h3>
    <div class="customers index content">
        <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => "btn btn-info pull-right btn btn-lg"]) ?>

        <div class="table table-striped table-advance table-hover">
            <table data-toggle="table" id="customerTable"
                    data-search="true"
                   data-header-style="headerStyle"
                   data-show-export="true"
                   data-toolbar="toolbar"
                   class="table table-hover table-sm" style="table-layout: fixed">
                <thead>
                <tr>
                    <!-- <th><?= h('First Name') ?><i class="icon_profile"></i> </th> -->
                    <th data-sortable="true" data-field="Type">Type</th>
                    <th data-sortable="true" data-field="Name">Name</th>
                    <th data-sortable="true" data-field="Business">Business</th>
                    <th data-sortable="false" data-field="ABN">ABN</th>
                    <th data-sortable="false" data-field="PrefContact">Pref. Contact</th>
                    <th data-sortable="false" data-field="Address">Address</th>
                    <th class="actions" data-field="Actions"><?= __('Actions') ?></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= h($customer->type) ?></td>
                        <td class="ddd"><?= h($customer->full_name) ?></td>
                        <td class="ddd"><?= h($customer->business) ?></td>
                        <td class="ddd"><?= h($customer->abn) ?></td>
                        <td class="ddd"><?= h($customer->contact_name) ?></td>
                        <td class="ddd"><?= h($customer->address_name) ?></td>
                        <td class="actions">
                            <div class="btn-group">
                                <?= $this->Html->link(__('<i class="fa fa-search-plus">'. '</i>'), ['action' => 'view', $customer->id],['class'=>'btn btn-primary','title' => "View this customer's details", 'escape' => false]) ?>
                                <?= $this->Html->link(__('<i class="fa fa-pencil-square">'. '</i>'), ['action' => 'edit', $customer->id],['class'=>'btn btn-success','title' => "Edit this customer", 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="fa fa-trash">'. '</i>'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete {0}?', $customer->type_name." (".$customer->contact_name.")"),'class'=>'btn btn-danger','title' => "Delete this customer",'escape' => false]) ?>
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
            <p><?= $this->Paginator->counter(__('There are a total {{count}} customer records in the system')) ?></p>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

<script>

    function headerStyle(column) {
        return {
            Type: {
                css: {
                    width: '9%'
                }
            },
            ABN: {
                css: {
                    width: '11%'
                }
            },
            Actions: {
                css: {
                    width: '12%'
                }
            }
        } [column.field]
    }



</script>
<!--<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>-->
