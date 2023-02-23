<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>

 <?= $this->Html->css('view-style.css'); ?>
 <?= $this->Html->css('bootstrap.min.css'); ?>
 <?= $this->Html->css('bootstrap-icons.css'); ?>
 <?= $this->Html->css('animate.min.css'); ?>
 <?= $this->Html->css('swiper-bundle.min.css'); ?>


<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-user-friends"></i>Customer</h3>
    </div>
</div>
<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-user-friends"></i><a <?php echo $this->Html->link( 'Customer', array('controller'=>'customers','action'=>'index'), array('escape'=>false)); ?></a></li>
        <li><i class="fa fa-eye"></i>View Customer</li>
        <li><i class="fa fa-id-card-o"></i><?= h($customer->type_name) ?></li>
    </ol>
    <div class="table table-hover">
        <div class="side-nav right" >
            <?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete {0}?', $customer->type_name." (".$customer->contact_name.")"), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div>
       

<body>
<!-- ======= Header/Navbar ======= -->

<main id="main">

  <!-- ======= Intro Single ======= -->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single"><?= h($customer->type_name) ?></h1>
            <span class="color-text-a" style= "font-size: 17px;"><?= h($customer->type) ?></span>
          </div>
        </div>

        <!-- Breadcrumbs on the right (depending on which is decided ) -->
        <!-- <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
              <li><i class="fas fa-user-friends"></i><a <?php echo $this->Html->link( 'Customer', array('controller'=>'customers','action'=>'index'), array('escape'=>false)); ?></a></li>
              </li>
              <li class="breadcrumb-item">
              <li><i class="fa fa-eye"></i>View Customer</li>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
              <li><i class="fa fa-id-card-o"></i><?= h($customer->type_name) ?></li>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div> -->
  </section><!-- End Intro Single-->

  <!-- ======= Customer Single ======= -->
  <section class="property-single nav-arrow-b">
    <div class="container">
      <!-- <div class="row justify-content-center">
        <div class="col-lg-8">
          <div id="property-single-carousel" class="swiper">
            <div class="swiper-wrapper">
              <div class="carousel-item-b swiper-slide">
                <img src="assets/img/slide-1.jpg" alt="">
              </div>
              <div class="carousel-item-b swiper-slide">
                <img src="assets/img/slide-2.jpg" alt="">
              </div>
            </div>
          </div>
          <div class="property-single-carousel-pagination carousel-pagination"></div>
        </div>
      </div> -->

      <div class="row">
        <div class="col-sm-12">

          <div class="row justify-content-between">
            <div class="col-md-5 col-lg-4">
              <div class="property-price d-flex justify-content-center foo">
                 <!-- the space above customer summary -->
                <div class="card-header-c d-flex">
                 
                
                 <?php echo $this->Html->image('male1.jpeg', array('alt' => 'our bigass logo', 'class' => 'logo me-auto','style'=>'height: 130px; width:130px;position: relative;top: 7px'))?>
               
                  <!-- <div class="card-title-c align-self-center">
                    <h5 class="title-c">15000</h5>
                  </div> -->
                </div>
              </div>

              
              <div class="property-summary">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d section-t4">
                      <h3 class="title-d">Customer Summary</h3>
                    </div>
                  </div>
                </div>
                <div class="summary-list">
                  <ul class="list">
                    <li class="d-flex justify-content-between">
                      <strong style="font-size:15px;">First Name:</strong>
                      <span style= "font-size: 17px;"><?= h($customer->first_name) ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong style="font-size:15px;">Last Name:</strong>
                      <span style= "font-size: 17px;"><?= h($customer->last_name) ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong style="font-size:15px;">Gender:</strong>
                      <span style= "font-size: 15px;"><?= h($customer->gender) ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong style="font-size:15px;">Business:</strong>
                      <span style= "font-size: 17px;"><?= h($customer->business) ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong style="font-size:15px;">ABN:</strong>
                      <span style= "font-size: 17px;"><?= h($customer->abn) ?>
                      </span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong style="font-size:15px;">Phone No:</strong>
                      <span style= "font-size: 17px;"><?= h($customer->phone_no) ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong style="font-size:15px;">Email:</strong>
                      <span style= "font-size: 16px;"><?= h($customer->email) ?></span>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-7 col-lg-7 section-md-t3">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Description</h3>
                  </div>
                </div>
              </div>
              <div class="property-description">
                <p class="description color-text-a"  style="font-size:15px"; "word-break: break-all">
                <?= h($customer->description) ?>
                </p>
               
              </div>
              <div class="row section-t3">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Address</h3>
                  </div>
                </div>
              </div>

              <div class="property-description">
                <p class="description color-text-a" style="font-size:19px"; "word-break: break-all";">
                <?= h($customer->street),",  ", h($customer->city),"   ", h($customer->state),"   ", h($customer->postcode)?>
                </p>
                </div>
              </div>
              </div>             

              <?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
             
             
              </div> 
              <!-- <div class="amenities-list color-text-a">
                <ul class="list-a no-margin">
                  <li>Balcony</li>
                  <li>Outdoor Kitchen</li>
                  <li>Cable Tv</li>
                  <li>Deck</li>
                  <li>Tennis Courts</li>
                  <li>Internet</li>
                  <li>Parking</li>
                  <li>Sun Room</li>
                  <li>Concrete Flooring</li>
                </ul>
              </div> -->
            </div>
          </div>
        </div>
        
</footer><!-- End  Footer -->

</body>



<?= $this->Html->script('bootstrap.bundle.min.js'); ?>
<?= $this->Html->script('swiper-bundle.min.js'); ?>
<?= $this->Html->script('view-main.js'); ?>




