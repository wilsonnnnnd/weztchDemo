<?php

/**
 * @var float $avgJobs
 * @var float $dValue
 * @var string $cust_type_str
 * @var string $cust_type_no
 * @var string $intro_str_by_month
 * @var string $intro_value_by_month
 * @var string $intro_str_by_year
 * @var string $intro_value_by_year
 * @var string $introMethodMoreValue
 * @var string $cust_add
 * @var string $cust_no
 * @var string $job_customer_name
 * @var string $job_customer_no
 * @var string $inst_brand
 * @var string $num_inst_brand
 * @var string $inst_type
 * @var string $num_inst_type
 * @var string $inst_model
 * @var string $num_inst_model
 * @var string $receipt_job_name
 * @var string $receipt_job_no
 * @var string $receipt_type_name
 * @var string $receipt_type_no
 * @var \App\Model\Entity\ServiceJob[]|\Cake\Collection\CollectionInterface $serviceJobs
 */
?>



<!DOCTYPE html>
<html lang="en">

<?= $this->Html->css('style.css') ?>
<!--overview start-->

<style>
    .but{
    .button4:hover {background-color: #e7e7e7;}
    }

</style>


<body>
<div class="row" style="margin-left: auto; margin-right: auto;">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-chart-line"></i> Statistics</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>
                <a <?php echo $this->Html->link('Home', array('controller' => 'Pages', 'action' => 'home'), array('escape' => false)); ?></a>
            </li>
            </li>
            <li><i class="fas fa-chart-line"></i>Statistics</li>
        </ol>
    </div>
    <div class="table table-hover">
        <div class="side-nav left">
        </div>
        <div class="customers view content">
            <h3>Statistics</h3>
            <table style="width: 85%"
            <tr>
                <th><?= __('Service Jobs in the last month') ?></th>
                <td class=ddd><?= h($totalJobsMonth) ?></td>
            </tr>
            <tr>
                <th><?= __('Service Jobs in the last year') ?></th>
                <td class=ddd><?= h($totalJobsYear) ?></td>
            </tr>
            <tr>
                <th><?= __('Average length of Service Job') ?></th>
                <td class=ddd><?= h($avgJobs) ?> Hours</td>
            </tr>
            <tr>
                <th><?= __('Estimated job length vs Actual job length') ?></th>
                <td style="white-space:normal; word-break:break-all;overflow:hidden;"><?= h($dValue) ?></td>
            </tr>
            <tr>
                <th><?= __('Average Income per Job') ?></th>
                <td class=ddd>$<?= h($avgjobincome) ?> </td>
            </tr>
<!--            <tr>-->
<!--                <th>--><?//= __('Average Deviation from Quotes to Invoice') ?><!--</th>-->
<!--                <td class=ddd>$--><?//= h($avgdeviation) ?><!-- </td>-->
<!--            </tr>-->
            <tr>
                <th><?= __('Total Amount Received via Invoices For Current Month') ?></th>
                <td class=ddd>$<?= h($totalpaidinvoice) ?> </td>
            </tr>
            <tr>
                <th><?= __('Total Amount Spent via Receipts For Current Month') ?></th>
                <td class=ddd>$<?= h($totalReceipts) ?> </td>
            </tr>


            </table>
            <h3>Business Analysis Graphs</h3><br>
            <?= $this->Form->button('Customer Analysis Graphs', ['onclick' => 'cust_graph()','class' => 'btn btn-secondary']) ?>
            <br>
            <div id="cust_graph" style="display: none">
                <div class="row">
                    <!-- Customers with the most jobs -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Customers with the most jobs
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="Most_jos_graph_bar" height="300" width="500"></canvas>
                            </div>
                        </section>
                    </div>
                    <!-- Most common suburbs based on customer addresses -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Most common suburbs based on customer addresses
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="bar" height="300" width="500"></canvas>
                            </div>
                        </section>
                    </div>
                </div>
                <!--   Most common customer introduction methods-->
                <div class="row" >
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Most common customer introduction methods
                                <div class="btn-group" style="float: right">
                                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" ></a>
                                    <ul class="dropdown-menu" style="background-color: #e7e7e7">
                                        <?= $this->Form->button ('Sort: Last 12 months', ['onclick' => 'updatePieChartAsYear()', 'style' => 'border: none;background-color: #e7e7e7']) ?>
                                        <li class="divider"></li>
                                        <?= $this->Form->button ('Sort: Last 30 days', ['onclick' =>'updatePieChartAsMonth()', 'style' => 'border: none;background-color: #e7e7e7'])?>
                                    </ul>
                                </div>

                            </header>

                            <div class="panel-body text-center">
                                <canvas id="pie" height="300" width="400"></canvas>
                            </div>
                        </section>
                    </div>

                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Customers: Business vs Individual
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="pie2" height="300" width="400"></canvas>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <br>
            <?= $this->Form->button('Instrument Analysis Graphs', ['onclick' => 'inst_graph()', 'class' => 'btn btn-secondary']) ?>
            <br>
            <div id="inst_graph" style="display: none">
                <div class="row">
                    <!-- Instruments with the most brand -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Most common instrument brands
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="instrumentBrand" height="300" width="500"></canvas>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Most common instrument models
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="instrumentModel" height="300" width="500"></canvas>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <!-- Instruments with the most model -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Most common instrument types
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="instrumentType" height="300" width="500"></canvas>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <br>
            <?= $this->Form->button('Expenses Analysis Graphs', ['onclick' => 'rece_graph()', 'class' => 'btn btn-secondary']) ?>
            <div id="rece_graph" style="display: none"  >
                <div class="row">
                    <!-- Receipt with the type -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Most common receipt types
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="receipt_type" height="300" width="500"></canvas>
                            </div>
                        </section>
                    </div>
                    <!-- Receipt with the job type -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Most common job types
                            </header>
                            <div class="panel-body text-center">
                                <canvas id="receipt_job_type" height="300" width="500"></canvas>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<script src="https://cdn.bootcdn.net/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-stacked100@1.0.0"></script>


<script>

    function Cal_as_number(total, num) {
        return total + num;
    }
    // function reply_click(clicked_id)
    // {
    //     alert(clicked_id);
    // }

    function cust_graph() {

        var cust_graph = document.getElementById("cust_graph");
        if (cust_graph.style.display === "none") {
            cust_graph.style.display = "block";
        } else {
            cust_graph.style.display = "none";
        }
    }
    function inst_graph() {
        var inst_graph = document.getElementById("inst_graph");
        if (inst_graph.style.display === "none") {
            inst_graph.style.display = "block";
        } else {
            inst_graph.style.display = "none";
        }
    }
    function rece_graph() {
        var rece_graph = document.getElementById("rece_graph");
        if (rece_graph.style.display === "none") {
            rece_graph.style.display = "block";
        } else {
            rece_graph.style.display = "none";
        }
    }


    // Most common customer introduction methods chart
    let intro_str_by_month = "<?php echo $intro_str_by_month ?>";
    intro_str_by_month = intro_str_by_month.replace(/,\s*$/, "");
    const intro_name_by_month = intro_str_by_month.split(",");

    let intro_value_by_month = "<?php echo $intro_value_by_month ?>";
    intro_value_by_month = intro_value_by_month.replace(/,\s*$/, "");
    const intro_method_by_month = intro_value_by_month.split(",").map(Number);
    const Sum_intro_As_number_by_month = intro_method_by_month.reduce(Cal_as_number);
    const data_intro_Sum_by_month =  function(tooltipItem) {
        return tooltipItem.label + ': ' + tooltipItem.parsed+ " | " + (tooltipItem.parsed/Sum_intro_As_number_by_month*100).toFixed(2) + '% of Total';
    };



    let piechart = document.getElementById("pie").getContext("2d");


    // setup block
    const dataBytime = {
        labels: intro_name_by_month,
        datasets: [{
            data: intro_method_by_month,
            backgroundColor: [
                'rgb(255, 99, 132,0.2)',
                'rgb(54, 162, 235,0.2)',
                'rgb(255, 205, 86,0.2)',
                'rgb(198,13,50,0.2)',
                'rgb(49,62,72,0.2)',
                'rgb(73,100,161,0.2)',
                'rgb(76,171,27,0.2)',
            ],
            borderColor: [
                'rgb(255, 99, 132,0.7)',
                'rgb(54, 162, 235,0.7)',
                'rgb(255, 205, 86,0.7)',
                'rgb(198,13,50,0.7)',
                'rgb(49,62,72,0.7)',
                'rgb(73,100,161,0.7)',
                'rgb(76,171,27,0.7)',
            ],
            hoverOffset: 10
        }]

    };

    // config block
    const config = {
        type: 'pie',
        data: dataBytime,
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: data_intro_Sum_by_month
                    }
                }
            }
        }
    };



    // render /init block
    const myChart = new Chart(
        document.getElementById('pie'),
        config
    );

    let intro_str_by_year = "<?php echo $intro_str_by_year ?>";
    intro_str_by_year = intro_str_by_year.replace(/,\s*$/, "");
    const intro_name_by_year = intro_str_by_year.split(",");

    let intro_value_by_year = "<?php echo $intro_value_by_year ?>";
    intro_value_by_month = intro_value_by_year.replace(/,\s*$/, "");
    const intro_method_by_year = intro_value_by_month.split(",").map(Number);
    const Sum_intro_As_number_by_year = intro_method_by_year.reduce(Cal_as_number);


    const data_intro_Sum_by_year =  function(tooltipItem) {
        return tooltipItem.label + ': ' + tooltipItem.parsed+ " | " + (tooltipItem.parsed/Sum_intro_As_number_by_year*100).toFixed(2) + '% of Total';
    };



    // const updateChart_by_year = document.getElementById('Year');
    // updateChart_by_year.addEventListener('click', updatePieChartAsYear);
    // const updateChart_by_month = document.getElementById('Month');
    // updateChart_by_month.addEventListener('click', updatePieChartAsMonth);

    function updatePieChartAsMonth(){

        myChart.data.labels = intro_name_by_month;
        myChart.data.datasets[0].data = intro_method_by_month;

        myChart.options.plugins.tooltip.callbacks.label= data_intro_Sum_by_month;
        myChart.update();
    }
    function updatePieChartAsYear(){
        myChart.data.labels = intro_name_by_year;
        myChart.data.datasets[0].data = intro_method_by_year;
        myChart.options.plugins.tooltip.callbacks.label= data_intro_Sum_by_year;
        myChart.update();
    }









    let cust_type_str = "<?php echo $cust_type_str ?>";
    cust_type_str = cust_type_str.replace(/,\s*$/, "");
    const arr_cust_type_str = cust_type_str.split(",");

    let cust_type_no = "<?php echo $cust_type_no ?>";
    cust_type_no = cust_type_no.replace(/,\s*$/, "");
    const arr_cust_type_no = cust_type_no.split(",").map(Number);
    const Sum_cust_type_no = arr_cust_type_no.reduce(Cal_as_number);

    let piechart2 = document.getElementById("pie2").getContext("2d");
    new Chart(piechart2, {
        type: "pie",
        data: data = {
            labels: arr_cust_type_str,
            datasets: [{
                data: arr_cust_type_no,
                backgroundColor: [
                    'rgb(255, 99, 132,0.2)',
                    'rgb(54, 162, 235,0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132,0.7)',
                    'rgb(54, 162, 235,0.7)'
                ],
                hoverOffset: 10
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.parsed+ " | " + (tooltipItem.parsed/Sum_cust_type_no*100).toFixed(2)+'% of Total';
                        }

                    }
                }
            }
        }
    });



    // bar chart = Most common suburbs based on customer
    let $cust_add = "<?php echo $cust_add ?>";
    $cust_add = $cust_add.replace(/,\s*$/, "");
    const cust_state = $cust_add.split(",");

    let $cust_no = "<?php echo $cust_no ?>";
    $cust_no = $cust_no.replace(/,\s*$/, "");
    const cust_state_no = $cust_no.split(",").map(Number);
    const Sum_cust_state_no = cust_state_no.reduce(Cal_as_number);

    let barchart = document.getElementById("bar").getContext("2d");

    data2 = {
        labels: cust_state,
        datasets: [{
            label: ['Number of customers'],
            data: cust_state_no,
            backgroundColor: [

                'rgba(75, 192, 192, 0.5)'

            ],
            borderColor:['rgba(75, 192, 192, 1)'],
            borderWidth: 2
        }]
    }


    new Chart(barchart, {
        type: "bar",
        data: data2,
        options: {
            scales: {
                y: {
                    ticks: {
                        reverse: false,
                        stepSize: 1
                    },
                    suggestedMax: 10,
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label+ ': ' + [tooltipItem.parsed.y]+ " | " + (tooltipItem.parsed.y/Sum_cust_state_no*100).toFixed(2)+ '% of Total';
                        }

                    }
                }
            }
        }
    });

    //bar chart = Customers with the most jobs
    let $job_customer_name = "<?php echo $job_customer_name ?>";
    $job_customer_name = $job_customer_name.replace(/,\s*$/, "");
    // $job_customer_name =  $job_customer_name.replace(/&#039;/g, "'");
    const customer_name = $job_customer_name.split(",");

    let $job_customer_no = "<?php echo $job_customer_no ?>";
    $job_customer_no = $job_customer_no.replace(/,\s*$/, "");
    const customer_no = $job_customer_no.split(",").map(Number);

    const Sum_customer_no = customer_no.reduce(Cal_as_number);

    let bar2chart = document.getElementById("Most_jos_graph_bar").getContext("2d");
    data3 = {
        labels: customer_name,
        datasets: [{
            label: ['Number of jobs'],
            data: customer_no,
            backgroundColor: [

                'rgba(255,51,108,0.83)'

            ],
            borderColor:['rgba(255,51,108,1)'],
            borderWidth: 2
        }]
    }


    new Chart(bar2chart, {
        type: "bar",
        data: data3,
        options: {
            scales: {
                y: {
                    ticks: {
                        reverse: false,
                        stepSize: 1
                    },
                    suggestedMax: 10,
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label+ ': ' + [tooltipItem.parsed.y]+ " | " + (tooltipItem.parsed.y/Sum_customer_no*100).toFixed(2)+ '% of Total';
                        }

                    }
                }
            }
        }
    });

    //instrument type:
    let $inst_type = "<?php echo $inst_type ?>";
    $inst_type = $inst_type.replace(/,\s*$/, "");
    const inst_type2 = $inst_type.split(",");

    let $num_inst_type = "<?php echo $num_inst_type ?>";
    $num_inst_type = $num_inst_type.replace(/,\s*$/, "");
    const num_inst_type2 = $num_inst_type.split(",").map(Number);

    const Sum_num_inst_type2 = num_inst_type2.reduce(Cal_as_number);

    let instrumentTypeChart = document.getElementById("instrumentType").getContext("2d");
    instrumentType_data = {
        labels: inst_type2,
        datasets: [{
            label: ['Amount of each type'],
            data: num_inst_type2,
            backgroundColor: [

                'rgba(26,61,173,0.83)'

            ],
            borderColor:['rgba(26,61,173,1)'],
            borderWidth: 2
        }]
    }


    new Chart(instrumentTypeChart, {
        type: "bar",
        data: instrumentType_data,
        options: {
            scales: {
                y: {
                    ticks: {
                        reverse: false,
                        stepSize: 1
                    },
                    suggestedMax: 10,
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label+ ': ' + [tooltipItem.parsed.y]+ " | " + (tooltipItem.parsed.y/Sum_num_inst_type2*100).toFixed(2)+ '% of Total';
                        }

                    }
                }
            }
        }
    });


    //instrument model:
    let $inst_model = "<?php echo $inst_model ?>";
    $inst_model = $inst_model.replace(/,\s*$/, "");
    const inst_model2 = $inst_model.split(",");

    let $num_inst_model = "<?php echo $num_inst_model ?>";
    $num_inst_model = $num_inst_model.replace(/,\s*$/, "");
    const num_inst_model2 = $num_inst_model.split(",").map(Number);
    const Sum_num_inst_model2 = num_inst_model2.reduce(Cal_as_number);

    let instrumentModelChart = document.getElementById("instrumentModel").getContext("2d");
    instrumentModel_data = {
        labels: inst_model2,
        datasets: [{
            label: ['Amount of each model'],
            data: num_inst_model2,
            backgroundColor: [

                'rgba(235, 103, 52, 0.83)'

            ],
            borderColor:['rgba(235, 103, 52, 1)'],
            borderWidth: 2
        }]
    }


    new Chart(instrumentModelChart, {
        type: "bar",
        data: instrumentModel_data,
        options: {
            scales: {
                y: {
                    ticks: {
                        reverse: false,
                        stepSize: 1
                    },
                    suggestedMax: 10,
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label+ ': ' + [tooltipItem.parsed.y]+ " | " + (tooltipItem.parsed.y/Sum_num_inst_model2*100).toFixed(2)+ '% of Total';
                        }

                    }
                }
            }
        }
    });

    //instrument brand:
    let $inst_brand = "<?php echo $inst_brand ?>";
    $inst_brand = $inst_brand.replace(/,\s*$/, "");
    const inst_brand2 = $inst_brand.split(",");

    let $num_inst_brand = "<?php echo $num_inst_brand ?>";
    $num_inst_brand = $num_inst_brand.replace(/,\s*$/, "");
    const num_inst_brand2 = $num_inst_brand.split(",").map(Number);
    const Sum_num_inst_brand2 = num_inst_brand2.reduce(Cal_as_number);

    let instrumentBrandChart = document.getElementById("instrumentBrand").getContext("2d");

    instrumentBrand_data = {
        labels: inst_brand2,
        datasets: [{
            label: ['Amount of each brand'],
            data: num_inst_brand2,
            backgroundColor: [
                'rgba(52, 235, 156, 0.83)'
            ],
            borderColor:['rgba(52, 235, 156, 1)'],
            borderWidth: 2
        }]
    }


    new Chart(instrumentBrandChart, {
        type: "bar",
        data: instrumentBrand_data,
        options: {
            scales: {
                y: {
                    ticks: {
                        reverse: false,
                        stepSize: 1
                    },
                    suggestedMax: 10,
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label+ ': ' + [tooltipItem.parsed.y]+ " | " + (tooltipItem.parsed.y/Sum_num_inst_brand2*100).toFixed(2)+ '% of Total';
                        }

                    }
                }
            }
        }
    });

    //Receipt type:
    let $receipt_type_name = "<?php echo $receipt_type_name ?>";
    $receipt_type_name = $receipt_type_name.replace(/,\s*$/, "");
    const Arr_receipt_type_name = $receipt_type_name.split(",");

    let $receipt_type_no = "<?php echo $receipt_type_no ?>";
    $receipt_type_no = $receipt_type_no.replace(/,\s*$/, "");
    const Arr_receipt_type_no = $receipt_type_no.split(",").map(Number);
    const Sum_Arr_receipt_type_no = Arr_receipt_type_no.reduce(Cal_as_number);

    let receipt_type_Chart = document.getElementById("receipt_type").getContext("2d");

    new Chart(receipt_type_Chart, {
        type: "bar",
        data: data = {
            labels: Arr_receipt_type_name,
            datasets: [{
                label: ['Amount of each receipt type'],
                data: Arr_receipt_type_no,
                backgroundColor: [
                    'rgba(232,17,17,0.5)'
                ],
                borderColor:['rgba(232,17,17,1)'],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    ticks: {
                        reverse: false,
                        stepSize: 1
                    },
                    suggestedMax: 10,
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label+ ': ' + [tooltipItem.parsed.y]+ " | " + (tooltipItem.parsed.y/Sum_Arr_receipt_type_no*100).toFixed(2)+ '% of Total';
                        }

                    }
                }
            }
        }
    });

    //Receipt Job type:
    let $receipt_job_name = "<?php echo $receipt_job_name ?>";
    $receipt_job_name = $receipt_job_name.replace(/,\s*$/, "");
    const Arr_receipt_job_name = $receipt_job_name.split(",");

    let $receipt_job_no = "<?php echo $receipt_job_no ?>";
    $receipt_job_no = $receipt_job_no.replace(/,\s*$/, "");
    const Arr_receipt_job_no = $receipt_job_no.split(",").map(Number);
    const Sum_Arr_receipt_job_no = Arr_receipt_type_no.reduce(Cal_as_number);

    let receipt_job_type_Chart = document.getElementById("receipt_job_type").getContext("2d");

    new Chart(receipt_job_type_Chart, {
        type: "bar",
        data: data = {
            labels: Arr_receipt_job_name,
            datasets: [{
                label: ['Amount of each job type'],
                data: Arr_receipt_job_no,
                backgroundColor: [
                    'rgba(229,45,1,0.5)'
                ],
                borderColor:['rgba(229,45,1,1)'],
                borderWidth: 2
            }]
        },
        options: {

            scales: {
                y: {
                    ticks: {
                        reverse: false,
                        stepSize: 1
                    },
                    suggestedMax: 10,
                },
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label+ ': ' + [tooltipItem.parsed.y]+ " | " + (tooltipItem.parsed.y/Sum_Arr_receipt_job_no*100).toFixed(2)+ '% of Total';
                        }

                    }
                }
            }
        }
    });


</script>
