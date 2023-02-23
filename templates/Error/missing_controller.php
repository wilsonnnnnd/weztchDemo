<style>
    .ddd{
        margin-top: 19px;

        letter-spacing: 1px;
        font-size: 20px;
        line-height: 39px;
        color: #184a56;
    }
</style>
<div class="inner404">

    <div class="ddd">
        PAGE NOT FOUND
    </div>
    <?php echo $this->Html->image('404.gif',array('style'=>"width:800px;height:600px; background-size: cover;",'alt'=>"animation")); ?>
    <div class="ddd">
        We looked everywhere for this page but couldn't find it...
        <br>Are you sure the website URL is correct?
    </div><br>

    <?= $this->Html->link('Back to Dashboard',array('controller' => 'pages','action' => 'Dashboard'), array('escape'=>false,'title' => "Click to go back to home",'class'=>'btn btn-info'));?>

</div>

