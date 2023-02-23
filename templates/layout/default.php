<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@600&display=swap" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <?php echo $this->Html->meta('favicon.ico', '/webroot/favicon.ico', ['type' => 'icon']);?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <!-- Bootstrap CSS -->
    <?= $this->Html->css('bootstrap.min.css'); ?>
    <!-- bootstrap theme -->
    <?= $this->Html->css('bootstrap-theme.css'); ?>
    <!--external css-->
    <!-- font icon -->
    <?= $this->Html->css('elegant-icons-style.css'); ?>
    <?= $this->Html->css('font-awesome.min.css'); ?>
    <!-- full calendar css-->
    <?= $this->Html->css('../assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css'); ?>
    <?= $this->Html->css('../assets/fullcalendar/fullcalendar/fullcalendar.css'); ?>
    <!-- easy pie chart-->
    <?= $this->Html->css('../assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css'); ?>
    <!-- owl carousel -->
    <?= $this->Html->css('owl.carousel.css', ['type' => 'text/css']); ?>
    <?= $this->Html->css('jquery-jvectormap-1.2.2.css', ['rel' => 'stylesheet']); ?>
    <!-- Custom styles -->
    <?= $this->Html->css('fullcalendar.css'); ?>
    <?= $this->Html->css('widgets.css'); ?>
    <?= $this->Html->css('style.css'); ?>
    <?= $this->Html->css('style-responsive.css'); ?>
    <?= $this->Html->css('xcharts.min.css'); ?>
    <?= $this->Html->css('jquery-ui-1.10.4.min.css'); ?>
    <!-- button styles -->
    <?= $this->Html->css('https://www.w3schools.com/w3css/4/w3.css'); ?>

    <style>
        .header {
            min-height: 65px !important;

        }

        body {
            font-family: 'Jura', sans-serif !important;
        }


        img {
            width: 5%;
            height: 5%;
        }

        @media only screen and (max-width: 768px) {
            .nav-collapse {
                display: none;
            }

            .main {
                margin-right: 0;
            }
        }
        * { touch-action: pan-y; !important}
    </style>
    <!-- The title of Web -->
    <title>Weztech Admin Management</title>
</head>

<body>
    <!-- container section start -->
    <section id="container" class="" >

        <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips"  data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->

                <div class="logo" style='height:auto'>
                    <?php echo $this->Html->link(
                        $this->Html->image('weztechlogo.png', array('alt' => 'our bigass logo', 'class' => 'logo me-auto','style'=>'height: 50px; width:100px;position: relative;top: 7px')),
                        array('controller' => 'pages', 'action' => 'home'),
                        array('escape' => false)
                    ); ?>

                </div>

            <!--logo end-->
        </header>
        <!--header end-->

        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu">

                    <li class="sub-menu" style="margin: auto">
                        <a href="javascript:;" class="">
                            <i class="fas fa-columns""></i>
                            <span>Admin Tools</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
                        <ul class="sub">
                            <li>
                                <?= $this->Html->link(__(' <i class="fa fa-laptop"></i><span>Dashboard</span>'), ['action' => 'dashboard', 'controller' => 'pages'], ['escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__(' <i class="far fa-bookmark"></i><span>Websites</span>'), ['action' => 'websites', 'controller' => 'pages'], ['escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__(' <i class="fas fa-chart-line"></i><span>Statistics</span>'), ['action' => 'stats', 'controller' => 'pages'], ['escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__(' <i class="fas fa-file-download"></i><span>Export Files</span>'), ['action' => 'export', 'controller' => 'pages'], ['escape' => false]) ?>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <?php echo $this->Html->link(' <i class="fas fa-user-friends"></i><span>Customers</span></a>', array('controller' => 'Customers', 'action' => 'index'), array('escape' => false)); ?>

                    </li>
                    <li class="sub-menu">
                        <?php echo $this->Html->link(' <i class="far fa-copy"></i><span>Quotes</span></a>', array('controller' => 'Quotes', 'action' => 'index'), array('escape' => false)); ?>

                    </li>
                    <li class="sub-menu">
                        <?php echo $this->Html->link(' <i class="fas fa-guitar"></i><span>Instruments</span></a>', array('controller' => 'Instruments', 'action' => 'index'), array('escape' => false)); ?>

                    </li>


                     <li class="sub-menu">
                         <?php echo $this->Html->link(' <i class="fas fa-tools"></i><span>Service Jobs</span></a>', array('controller' => 'ServiceJobs', 'action' => 'index'), array('escape' => false)); ?>
                     </li>


                    </li>
                    <li class="sub-menu">
                        <?php echo $this->Html->link(' <i class="fas fa-print"></i><span>Invoices</span></a>', array('controller' => 'Invoices', 'action' => 'index'), array('escape' => false)); ?>

                    </li>
                    <li class="sub-menu">
                        <?php echo $this->Html->link(' <i class="fas fa-receipt"></i><span>Receipts</span></a>', array('controller' => 'Receipts', 'action' => 'index'), array('escape' => false)); ?>

                    </li>

                    <li class="sub-menu" style="position: center">
                        <a href="javascript:;" class="">
                            <i class="fas fa-cubes""></i>
                            <span>Inventory</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
                        <ul class="sub">
                            <li>
                                <?php echo $this->Html->link(' <i class="fas fa-clipboard-list"></i></i><span>Categories</span></a>', array('controller' => 'Inventories', 'action' => 'index'), array('escape' => false)); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link(' <i class="fas fa-cube"></i></i><span>Items</span></a>', array('controller' => 'Parts', 'action' => 'index'), array('escape' => false)); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link(' <i class="fas fa-archive"></i></i><span>Item Archive</span></a>', array('controller' => 'Parts', 'action' => 'archive'), array('escape' => false)); ?>
                            </li>

                        </ul>
                    </li>

                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <section id="main-content">
            <section class="wrapper">
                <main class="main">
                    <div class="container">
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>
                    </div>
                </main>
            </section>



            <div class="text-center">
                        <div class="credits">

                            Designed for <a href="https://www.weztech.com.au">Weztech</a>
                        </div>
                    </div>

        </section>


        <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
        <?= $this->Html->script('jquery.js'); ?>
        <?= $this->Html->script('jquery-ui-1.10.4.min.js'); ?>
        <?= $this->Html->script('jquery-1.8.3.min.js'); ?>
        <?= $this->Html->script('jquery-ui-1.9.2.custom.min.js'); ?>


        <!-- bootstrap -->
        <?= $this->Html->script('bootstrap.min.js'); ?>
        <!-- nice scroll -->
        <?= $this->Html->script('jquery.scrollTo.min.js'); ?>




        <!-- charts scripts -->
        <?php echo $this->Html->script('../assets/jquery-knob/js/jquery.knob.js'); ?>
        <?php echo $this->Html->script('../assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js'); ?>
        <?= $this->Html->script('jquery.sparkline.js'); ?>
        <?= $this->Html->script('owl.carousel.js'); ?>

        <!-- jQuery full calendar -->
        <?= $this->Html->script('fullcalendar.min.js'); ?>

        <!-- Full Google Calendar - Calendar -->
        <?php echo $this->Html->script('../assets/fullcalendar/fullcalendar/fullcalendar.js'); ?>
        <!--script for this page only-->
        <?= $this->Html->script('calendar-custom.js'); ?>
        <?= $this->Html->script('jquery.rateit.min.js'); ?>

        <!-- custom select -->

        <?= $this->Html->script('jquery.customSelect.min.js'); ?>
        <?php echo $this->Html->script('../assets/chart-master/Chart.js'); ?>
        <!--custome script for all page-->
        <?= $this->Html->script('newscripts.js'); ?>

        <!-- custom script for this page-->
        <?= $this->Html->script('sparkline-chart.js'); ?>
        <?= $this->Html->script('easy-pie-chart.js'); ?>
        <?= $this->Html->script('jquery-jvectormap-1.2.2.min.js'); ?>
        <?= $this->Html->script('jquery-jvectormap-world-mill-en.js'); ?>
        <?= $this->Html->script('xcharts.min.js'); ?>
        <?= $this->Html->script('jquery.autosize.min.js'); ?>
        <?= $this->Html->script('jquery.placeholder.min.js'); ?>
        <?= $this->Html->script('gdp-data.js'); ?>
        <?= $this->Html->script('morris.min.js'); ?>
        <?= $this->Html->script('charts.js'); ?>
        <?= $this->Html->script('jquery.slimscroll.min.js'); ?>



</body>

</html>

