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


<!--sidebar end-->

<!--main content start-->

<?= $this->Html->css('style1.css') ?>
<!--overview start-->

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-file-download"></i> Export Files</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a <?php echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'home'), array('escape' => false)); ?></a></li>
            </li>
            <li><i class="fas fa-file-download"></i>Export files</li>
        </ol>
    </div>
</div>


<div>
        <p class="h2 text-center mb-5"> </p>
    </div>

<div class="container">

    <div class="row mt-3">
        <div class="col-lg-3 col-md-6 ">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="fas fa-user-friends"></span> </div>
                <p class="h-1 pt-6">Customers</p>
                <!-- <span class="price"> <span class="number">Customers</span> </span> -->
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Customers Record</li>
                    <li>Business Name</li>
                    <li>ABN</li>
                    <li>Contact Details</li>
                    <li>Address</li>


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'Customers', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

               </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-md-0 mt-5">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="far fa-copy"></span> </div>
                <p class="h-1 pt-6">Quotes</p>
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Quotes Information</li>
                    <li>Expiry Date</li>
                    <li>Est Total Cost</li>
                    <li>Est Completion Date</li>
                    <li>Items Required</li>
                    <!-- <li><span class="fa fa-check me-2"></span>Status</li> -->


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'Quotes', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-md-0 mt-5">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="fas fa-guitar"></span> </div>
                <p class="h-1 pt-6">Instruments</p>
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Instruments Details</li>
                    <li>Brand + Model</li>
                    <li>Country + Year</li>
                    <li>Serial Number</li>
                    <li>Instrument Owner</li>
                    <!-- <li><span class="fa fa-check me-2"></span>Status</li> -->


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'Instruments', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-md-0 mt-5">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="fas fa-tools"></span> </div>
                <p class="h-1 pt-6">Service Jobs</p>
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Service Jobs Info</li>
                    <li>Time Taken</li>
                    <li>Start Date</li>
                    <li>End Date</li>
                    <li>Jobs Performed</li>
                    <!-- <li><span class="fa fa-check me-2"></span>Status</li> -->


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'ServiceJobs', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

            </div>
        </div>
    </div>
</div>


<div>
        <p class="h2 text-center mb-5"> </p>
    </div>

   <!-- Second row  -->

<div class="container">
    <div>
        <p class="h2 text-center mb-5"> </p>
    </div>
    <div class="row mt-3">
        <div class="col-lg-3 col-md-6 ">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="fas fa-print"></span> </div>
                <p class="h-1 pt-6">Invoices</p>
                <!-- <span class="price"> <span class="number">Customers</span> </span> -->
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Invoices Record</li>
                    <li>Invoice Date</li>
                    <li>Payment Date</li>
                    <li>Amount</li>
                    <li>GST</li>


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'Invoices', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-md-0 mt-5">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="fas fa-receipt"></span> </div>
                <p class="h-1 pt-6">Receipts</p>
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Receipts Information</li>
                    <li>Date</li>
                    <li>Total Price</li>
                    <li>Purchase Source</li>
                    <li>Job & Record Type</li>
                    <!-- <li><span class="fa fa-check me-2"></span>Status</li> -->


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'Receipts', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-md-0 mt-5">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="fas fa-clipboard-list"></span> </div>
                <p class="h-1 pt-6">Inventory Categories</p>
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Categories Details</li>
                    <li>Category Type</li>
                    <li>Category Brand</li>
                    <li>Part Number</li>
                    <li>Retail Price</li>
                    <!-- <li><span class="fa fa-check me-2"></span>Status</li> -->


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'Inventories', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-md-0 mt-5">
            <div class="card d-flex align-items-center justify-content-center">
                <div class="ribon"> <span class="fas fa-cube"></span> </div>
                <p class="h-1 pt-6">Inventory Items</p>
                <ul class="mb-5 list-unstyled text-muted">
                    <li>Items Details</li>
                    <li>Category</li>
                    <li>Associated Receipt</li>
                    <li>Associated Job</li>
                    <li>Price</li>
                    <!-- <li><span class="fa fa-check me-2"></span>Jobs Performed</li> -->
                    <!-- <li><span class="fa fa-check me-2"></span>Status</li> -->


                </ul>
                <?php echo $this->Html->link(__('Export CSV'. '</i>'), ['controller' => 'Parts', 'action' => 'export'],['class'=>'btn btn-primary', 'escape' => false]) ?>

            </div>
        </div>
    </div>
</div>





