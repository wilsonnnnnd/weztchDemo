<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\JobTask $jobTask
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-cubes"></i>Job Task</h3>
    </div>
</div>


<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-tasks"></i><a <?php echo $this->Html->link('JobTask', array('controller' => 'JobTasks', 'action' => 'view'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-edit"></i>View Job Task</li>
        <li><i class="fa fa-id-card-o"></i><?= h($jobTask->name) ?></li>
    </ol>

     <div class="table table-hover">
        <div class="side-nav left" >
            <?= $this->Html->link(__('Edit Job Task'), ['action' => 'edit', $jobTask->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Job Task'), ['action' => 'delete', $jobTask->id], ['confirm' => __('Are you sure you want to delete the Inventory Category: {0}?', $jobTask->name), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div><br>


        <tr class="customers view content">
            <table style="width: 85%">
          

                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($jobTask->name) ?></td>
                </tr>
                <!-- <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($jobTask->id) ?></td>
                </tr> -->
                <tr>
                    <th><?= __('Task Time') ?></th>
                    <td><?= $this->Number->format($jobTask->task_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Task Cost') ?></th>
                    <td><?= $this->Number->format($jobTask->task_cost) ?></td>

                </tr>

                 <tr>
                    <div class="text">
                        <th> <strong><?= __('Description') ?></strong></th>
                        <td style="white-space:normal; word-break:break-all;overflow:hidden;">
                            <?= $this->Text->autoParagraph(h($jobTask->description)); ?>
                        </td>
                    </div>

                </tr>
            </table>

            </div>




     



        
        </div>

        <?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
       
</div>
