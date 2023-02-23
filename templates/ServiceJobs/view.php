<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceJob $serviceJob
 */
use Cake\I18n\Time;
?>
<style>
    .ddd {
        color: mediumblue;
        text-decoration: underline;
        word-break:break-all;
        overflow:hidden;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-tools"></i>Service Job</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-tools"></i><a <?php echo $this->Html->link('Service Jobs', array('controller' => 'ServiceJobs', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="fa fa-eye"></i>View Job</li>
        <li><i class="fa fa-id-card-o"></i><?= h($serviceJob->job_name." (J".$serviceJob->id.")") ?></li>
    </ol>
    <div class="table table-hover">
        <div class="side-nav left" >
            <?= $this->Html->link(__('Edit Service Job'), ['action' => 'edit', $serviceJob->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Service Job'), ['action' => 'delete', $serviceJob->id], ['confirm' => __('Are you sure you want to delete the job for {0}?', $serviceJob->job_name), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div>
        <div class="customers view content">
            <br>
            <h2><?= h($serviceJob->job_name) ?></h2>
            <table style="width: 85%">
                <tr>
                    <th><?= __('Job ID') ?></th>
                    <td><?= h("J".$serviceJob->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Instrument') ?></th>
                    <td class = ddd><?= $serviceJob->has('instrument') ? $this->Html->link($serviceJob->instrument->instrument_name, ['controller' => 'Instruments', 'action' => 'view', $serviceJob->instrument->id]) : '' ?></td>

                </tr>
                <tr>
                    <th><?= __('Quote') ?></th>
                    <td class = ddd><?= $serviceJob->has('quote') ? $this->Html->link("Q".$serviceJob->quote->id." | Date: ".$serviceJob->quote->date->i18nFormat('dd/MM/yy'), ['controller' => 'Quotes', 'action' => 'view', $serviceJob->quote->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Estimated Time to Complete Service Job') ?></th>
                    <td><?= h($serviceJob->est_hours) ?></td>
                </tr>
                <tr>
                    <th><?= __('Job Start Date') ?></th>
                    <td><?= h($serviceJob->date_started->i18nFormat('dd/MM/yyyy')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Job End Date') ?></th>
                    <td><?= h($serviceJob->date_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time Taken to Complete Service Job') ?></th>
                    <td><?= h($serviceJob->act_hours) ?></td>
                </tr>
                <tr>
                    <th><?= __('Jobs Performed') ?></th>
                    <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($serviceJob->jobs_performed) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($serviceJob->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?php if ($serviceJob->status == '1') { ?>
                            <a class="btn btn-block btn-warning btn-sm" disabled>
                                Current
                            </a>
                        <?php } else if ($serviceJob->status == '2'){ ?>
                            <a class="btn btn-block btn-success btn-sm" disabled>
                                Complete
                            </a>
                        <?php } else if ($serviceJob->status == '3'){ ?>
                            <a class="btn btn-block btn-danger btn-sm" disabled>
                                Cancelled
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-block btn-primary btn-sm" disabled>
                                No Status
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>

</div>
