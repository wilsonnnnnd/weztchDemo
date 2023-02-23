<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote $quote
 * @var \Cake\Collection\CollectionInterface|string[] $findQuotes
 * @var \Cake\Collection\CollectionInterface|string[] $findInvoices
 * @var \Cake\Collection\CollectionInterface|string[] $findJobs
 */
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .image{
        display: inline-block;
        -webkit-transition: all 200ms ease-in;
        -webkit-transform: scale(1);
        -ms-transition: all 200ms ease-in;
        -ms-transform: scale(1);
        -moz-transition: all 200ms ease-in;
        -moz-transform: scale(1);
        transition: all 200ms ease-in;
        transform: scale(1);
    }

    .image:hover {
        -webkit-transition: all 200ms ease-in;
        -webkit-transform: scale(1.5);
        -ms-transition: all 200ms ease-in;
        -ms-transform: scale(1.5);
        -moz-transition: all 200ms ease-in;
        -moz-transform: scale(1.5);
        transition: all 200ms ease-in;
        transform: scale(1.5);
    }
</style>

<?= $this->Html->css('style.css') ?>
<!--overview start-->

<div class="col-lg-12">

    <div class="row">
        <div class="col-lg-12">
            <?php echo $this->Html->image('guitar.gif',array('style'=>"width:100px;height:100px",'alt'=>"animation",'class'=>'image pull-right')); ?>
            <h3 class="page-header"><i class="fas fa-home"></i></i> Home
            </h3>
        </div>


    </div>
</div>



<div class="row">
    <!--/.Dashboard Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box dark-bg">' . '<i class="fa fa-laptop">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">'  . 'Dashboard' . '</div>' . '</div>'), ['action' => 'dashboard', 'controller' => 'pages'], ['escape' => false]) ?>
    </div>
    <!--/.Websites Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box orange-bg">' . '<i class="far fa-bookmark">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">'  . 'Websites' . '</div>' . '</div>'), ['action' => 'websites', 'controller' => 'pages'], ['escape' => false]) ?>
    </div>
    <!--/.Statistics Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box red-bg">' . '<i class="fas fa-chart-line">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">'  . 'Statistics' . '</div>' . '</div>'), ['action' => 'stats', 'controller' => 'pages'], ['escape' => false]) ?>
    </div>
    <!--/.Export Files Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box linkedin-bg">' . '<i class="fas fa-file-download">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">'  . 'Export Files' . '</div>' . '</div>'), ['action' => 'export', 'controller' => 'pages'], ['escape' => false]) ?>
    </div>
</div>
<hr style="height:2px;border-width:0">
<div class="row">

    <!--/.Customers Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box blue-bg">' . '<i class="fa fa-users">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">'  . 'Customers' . '</div>' . '</div>'), ['action' => 'index', 'controller' => 'customers'], ['escape' => false]) ?>
    </div>

    <!--/.Quotes Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box brown-bg">' . '<i class="far fa-copy">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">' . 'Quotes' . '</div>' . '</div>'), ['controller' => 'Quotes', 'action' => 'index'], ['escape' => false]) ?>
    </div>


    <!--/.Instruments Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box bg-secondary">' . '<i class="fas fa-guitar">' . '</i>' . '<div class="title" style="font-size:14px;padding-top: 17%">' . 'Instruments' . '</div>' . '</div>'), ['controller' => 'Instruments', 'action' => 'index'], ['escape' => false]) ?>
    </div>

    <!--/.Service Jobs Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box green-bg">' . '<i class="fas fa-tools">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">' . 'Service Jobs' . '</div>' . '</div>'), ['controller' => 'ServiceJobs', 'action' => 'index'], ['escape' => false]) ?>
    </div>

    <!--/.Invoices Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box Lime-bg">' . '<i class="fas fa-print">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">' . 'Invoices' . '</div>' . '</div>'), ['controller' => 'Invoices', 'action' => 'index'], ['escape' => false]) ?>
    </div>

    <!--/.Receipts Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box magenta-bg">' . '<i class="fas fa-receipt">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">' . 'Receipts' . '</div>' . '</div>'), ['controller' => 'Receipts', 'action' => 'index'], ['escape' => false]) ?>
    </div>

    <!--/.Categories Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box bg-warning">' . '<i class="fas fa-clipboard-list">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">' . 'Inventory Categories' . '</div>' . '</div>'), ['controller' => 'Inventories', 'action' => 'index'], ['escape' => false]) ?>
    </div>

    <!--/.Items Page-->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $this->Html->link(__('<div class="info-box purple-bg">' . '<i class="fas fa-cube">' . '</i>' . '<div class="title" style="font-size:15px;padding-top: 17%">' . 'Inventory Items' . '</div>' . '</div>'), ['controller' => 'Parts', 'action' => 'index'], ['escape' => false]) ?>
    </div>
</div>

</html>
