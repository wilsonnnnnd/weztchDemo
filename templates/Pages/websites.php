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

<?= $this->Html->css('style.css') ?>
<!--overview start-->

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="far fa-bookmark"></i> Useful links</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a <?php echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'home'), array('escape' => false)); ?></a></li>
            </li>
            <li><i class="far fa-bookmark"></i>Websites</li>
        </ol>
    </div>
</div>


<div class="row">
    <!-- link for website -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box dark-bg">
            <a href="https://www.weztech.com.au">
                <i class="fas fa-briefcase"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Weztech', 'https://www.weztech.com.au'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-primary">
            <a href="https://facebook.com">
                <i class="fab fa-facebook"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Facebook', 'http://www.facebook.com/'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box purple-bg">

            <a href="https://instagram.com">
                <i class="fab fa-instagram"></i>
            </a>
            <div class="title"><?php echo $this->Html->link('Instagram', 'http://www.instagram.com/'); ?></div>
        </div>

    </div>


    <!-- link for LinkedIn -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box blue-bg">
            <a href="https://linkedin.com">
                <i class="fab fa-linkedin"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('LinkedIn', 'http://www.linkedin.com/'); ?></div>
        </div>


    </div>

    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-danger">
            <a href="https://youtube.com">
                <i class="fab fa-youtube"></i>
            </a>
            <div class="title"><?php echo $this->Html->link('Youtube', 'http://www.youtube.com/'); ?></div>
        </div>

    </div>

</div>


<!-- second row for links -->


<div class="row">
    <!-- link for website -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-info">
            <a href="https://my.waveapps.com/login/">
                <i class="fas fa-water"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Wave', 'https://my.waveapps.com/login/'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box orange-bg">
            <a href="https://www.ing.com.au/securebanking/">
                <i class="fab fa-wolf-pack-battalion"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('ING-Savings', 'https://www.ing.com.au/securebanking//'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-secondary">

            <a href="https://ibs.bankwest.com.au/BWLogin/rib.aspx">
                <i class="fas fa-university"></i>
            </a>
            <div class="title"><?php echo $this->Html->link('Bankwest', 'https://ibs.bankwest.com.au/BWLogin/rib.aspx'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-warning">
            <a href="http://www.drive.google.com">
                <i class="fab fa-google-drive"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Google Drive', 'http://www.drive.google.com'); ?></div>
        </div>


    </div>

    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box red-bg">
            <a href="https://www.google.com/intl/en-GB/gmail/about/">
                <i class="fas fa-mail-bulk"></i>
            </a>
            <div class="title"><?php echo $this->Html->link('Email', 'https://accounts.google.com/signin/'); ?></div>
        </div>

    </div>

</div>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="far fa-bookmark"></i> Store links</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                    <a <?php echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'home'), array('escape' => false)); ?></a></li>
                </li>
                <li><i class="far fa-bookmark"></i>Websites</li>
            </ol>
        </div>
    </div>


<div class="row">
    <!-- link for website -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-success">
            <a href="https://www.ebay.com.au/">
                <i class="fab fa-ebay"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Ebay', 'https://www.ebay.com.au/'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-danger">
            <a href="https://www.stewmac.com/">
                <i class="fas fa-sliders-h"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Stew Mac', 'https://www.stewmac.com/'); ?></div>
        </div>

    </div>


    <!-- link for Tube amp doctor -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box orange-bg">

            <a href="https://www.tubeampdoctor.com/">
                <i class="fas fa-stethoscope"></i>
            </a>
            <div class="title"><?php echo $this->Html->link('Amp Doctor', 'https://www.tubeampdoctor.com/'); ?></div>
        </div>

    </div>


    <!-- link for Amplified Parts -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box teal-bg">
            <a href="https://www.amplifiedparts.com/">
                <i class="fas fa-broadcast-tower"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Amplified Parts', 'https://www.amplifiedparts.com/'); ?></div>
        </div>


    </div>

    <!-- link for Stratosphere -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-secondary">
            <a href="https://stratosphereparts.com/">
                <i class="fas fa-globe"></i>
            </a>
            <div class="title"><?php echo $this->Html->link('Stratosphere', 'https://stratosphereparts.com/'); ?></div>
        </div>

    </div>

</div>


<!-- second row for links -->


<div class="row">
    <!-- link for website -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box red-bg">
            <a href="https://billyhydemusic.com.au/">
                <i class="fas fa-volume-up"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Billy Hyde', 'https://billyhydemusic.com.au/'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box yellow-bg">
            <a href="https://fivestarmusic.com.au/">
                <i class="fas fa-star"></i>
            </a>

            <div class="title"><?php echo $this->Html->link('Five Star Music', 'https://fivestarmusic.com.au/'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box blue-bg">

            <a href="https://www.musicjunction.com.au/">
                <i class="fas fa-music"></i>
            </a>
            <div class="title"><?php echo $this->Html->link('Music Junction', 'https://www.musicjunction.com.au/'); ?></div>
        </div>

    </div>


    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box bg-info">
            <a href="https://www.keyboardcorner.com.au/">
                <i class="fas fa-bolt"></i>
            </a>

            <div class="title"><?php echo $this->Html->link("KC's Rock Shop", 'https://www.keyboardcorner.com.au/'); ?></div>
        </div>


    </div>

    <!-- link for instagram -->
    <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
        <div class="info-box dark-bg">
            <a href="https://www.mannys.com.au/">
                <i class="fas fa-male"></i>
            </a>
            <div class="title"><?php echo $this->Html->link("Manny's Music", 'https://www.mannys.com.au/'); ?></div>
        </div>

    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br>

    <?php echo $this->Html->image('jimi.gif',array('style'=>"width:480px;height:360px",'alt'=>"animation")); ?>
    <?php echo $this->Html->image('angus.gif',array('style'=>"width:480px;height:360px",'alt'=>"animation")); ?>


