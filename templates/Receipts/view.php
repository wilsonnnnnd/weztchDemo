<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\$receipt $receipt
 */
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\Routing\RouteBuilder;
?>

<style>
    .img{width:400px !important;}
    #myImg:hover {opacity: 0.7;}
    img{
        height:auto !important
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 700px;
    }
    /* Add Animation */
    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 65px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }


</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-receipt"></i>Receipts</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-receipt"></i><a <?php echo $this->Html->link('View Receipt', array('controller' => 'Receipts', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="fa fa-eye"></i>View Receipt</li>
        <li><i class="fa fa-id-card-o"></i><?= h($receipt->receipt_name) ?></li>
    </ol>

    <div class="table table-hover">
        <div class="side-nav left" >
            <?= $this->Html->link(__('Edit Receipt'), ['action' => 'edit', $receipt->id], ['class'=>'btn btn-success']) ?>
            <?= $this->Form->postLink(__('Delete Receipt'), ['action' => 'delete', $receipt->id], ['confirm' => __('Are you sure you want to delete the receipt from {0}?', $receipt->receipt_name), 'class' => 'w3-btn w3-round-large w3-red']) ?>
        </div><br>
        <tr class="customers view content">
            <table style="width: 85%">

                <tr>
                    <th><?= __('Receipt ID') ?></th>
                    <td>R<?= h($receipt->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Receipt No') ?></th>
                    <td><?= h($receipt->receipt_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($receipt->date_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Price') ?></th>
                    <td>$<?= $this->Number->format($receipt->total_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Shipping') ?></th>
                    <td>$<?= $this->Number->format($receipt->shipping) ?></td>
                </tr>
                <tr>
                    <th><?= __('GST') ?></th>
                    <td>$<?= $this->Number->format($receipt->gst) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount') ?></th>
                    <td>-$<?= $this->Number->format($receipt->discount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Purchase Source') ?></th>
                    <td><?= h($receipt->purchase_source) ?></td>
                </tr>
                <tr>
                    <th><?= __('Purchase Method') ?></th>
                    <td><?= h($receipt->purchase_method) ?></td>
                </tr>
                <tr>
                    <th><?= __('Job Type') ?></th>
                    <td><?= h($receipt->job_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Receipt Type') ?></th>
                    <td><?= h($receipt->receipt_type) ?></td>
                </tr>
                <tr>
                    <div class="text">
                        <th> <strong><?= __('Description') ?></strong></th>
                        <td style="white-space:normal; word-break:break-all;overflow:hidden;">
                            <?= $this->Text->autoParagraph(h($receipt->description)); ?>
                        </td>
                    </div>

                </tr>
                <tr>
                    <th><?= __('Receipt Image (click to zoom)') ?></th>

                    <td><?= @$this->Html->image($receipt->image,array('id'=>'myImg','height'=> '250px !important;','width' => 'auto')) ?></td>

                </tr>
                </tr>
            </table>

    </div>
</div>
<?= $this->Form->button ('Back', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>

</div>

<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<script>




    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    function showImage2(image, content_id) {





    }

</script>
