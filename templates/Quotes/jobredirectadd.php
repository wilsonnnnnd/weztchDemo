<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Quote $quote
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 */
?>
<?= $this->Html->css('choices.min.css'); ?>
<style>
    a {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s;
    }
    .error-message{
        color:red !important;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .red {
        color: red;
        font-style: normal;
        font-size: 120%;
        display: inline-block;
        white-space: nowrap;
    }

    .legend {
        font-style: normal;
        font-size: 100%;
        display: inline-block;
        white-space: nowrap;
    }

    div.tasks {
        width: 420px;
        height: 150px;
        overflow: scroll;
    }

</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="far fa-copy"></i>Quotes</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="far fa-copy"></i><a <?php echo $this->Html->link('Quotes', array('controller' => 'Quotes', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Add Quote</li>
    </ol>
    <div class="card" style="width: 70rem;">
        <div class="card-body">
            <h5 class="card-title">Add Quote</h5><div class="pull-right"><div class="red">* </div>&nbsp;<div class = legend>Indicates mandatory inputs</div></div><br>
            <div class="card-text">
                <?= $this->Form->create($quote) ?>
                <div class="form-group">
                    <label for="cust_id">Customer</label> <?php echo $this->Html->link( ' <i class="fas fa-plus"></i></a>', array('controller'=>'Customers','action'=>'quoteredirectadd'), array('escape'=>false, 'title' => "Click to add a new Customer")); ?>


                    <?php echo $this->Form->control('cust_id', ['required' => true, 'options' => $arr_customers, 'label' => false, 'class' => 'form-control selectpicker-customer border']); ?>
                </div><br>
                <div class="form-group">
                    <label for="heading">Heading <div class = red>*</div></label>
                    <?php echo $this->Form->control('heading', ['required' => true, 'maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date">Quote Date <div class = red>*</div></label>
                        <?php echo $this->Form->control('date', ['value'=>date("m/d/Y"),'required' => true, 'type' => 'date', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="expiry">Expiry <div class = red>*</div></label>
                        <?php echo $this->Form->control('expiry', ['value'=>date('m/d/Y',strtotime("+14 day")),'required' => true, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estimated_completion">Estimated Date of Completion <div class = red>*</div></label>
                        <?php echo $this->Form->control('estimated_completion', ['required' => true, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>

                <div class="row gy-2 gx-3 align-items-center">
                    <div class="col-auto">
                        <label for="estimated_cost">Estimated Cost <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('estimated_cost', ['required' => true, 'onkeyup'=>'changeEstimate(this.value)', 'label' => false,'placeholder' => 'Enter value in dollars', 'type' => 'number','min' => 0, 'max'=>999999999.99, 'id'=>'ESTid', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="gst">GST <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('gst', ['required' => true, 'type'=>'hidden','min'=>0,'max'=>999999999.99,'id'=>'GSTid1','label' => false,'class' => 'form-control']); ?>
                            <?php echo $this->Form->control('gst', ['required' => true, 'disabled'=>'disabled','min'=>0,'max'=>999999999.99,'id'=>'GSTid2','label' => false,'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="estimated_total">Total Cost <div class = red>*</div></label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                            <?php echo $this->Form->control('estimated_total', ['required' => true, 'onkeyup'=>'changeTotal(this.value)', 'min'=>0,'max'=>999999999.99,'id'=>'Totalid','label' => false, 'placeholder' => 'Enter value in dollars','class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group-prepend">
                            <?php $options = array('1' => 'No Job', '2' => 'Has Job');
                            echo $this->Form->control('status', ['required' => true, 'options' => $options, 'value' => 1,'type'=>'hidden', 'label' => false, 'class' => 'form-control', 'empty' => false]); ?>
                        </div>
                    </div>
                    <div class="tasks pull-right">
                        <p style="margin-bottom:1px;"><input id="chkbox1" type="checkbox">
                            <label for="chkbox1">Action Adjustment</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox2" type="checkbox">
                            <label for="chkbox2">Assembly & Test</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox3" type="checkbox">
                            <label for="chkbox3">Bias Adjustment</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox4" type="checkbox">
                            <label for="chkbox4">Body Clean & Polish</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox5" type="checkbox">
                            <label for="chkbox5">Disassembly & Diagnosis</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox6" type="checkbox">
                            <label for="chkbox6">Electronics Repair</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox7" type="checkbox">
                            <label for="chkbox7">Electronics Service & Inspection</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox8" type="checkbox">
                            <label for="chkbox8">Fret Polish/Minor Fret Dress</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox9" type="checkbox">
                            <label for="chkbox9">Fretboard Clean & Service</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox10" type="checkbox">
                            <label for="chkbox10">Hardcase Clean & Vacuum</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox11" type="checkbox">
                            <label for="chkbox11">Hardware Inspection</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox12" type="checkbox">
                            <label for="chkbox12">Hardcase Repair</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox13" type="checkbox">
                            <label for="chkbox13">Intonation Adjustment</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox14" type="checkbox">
                            <label for="chkbox14">Luthier Repair</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox15" type="checkbox">
                            <label for="chkbox15">Modification</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox16" type="checkbox">
                            <label for="chkbox16">Neck Adjustment</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox17" type="checkbox">
                            <label for="chkbox17">Nut Re-Cut/Replacement</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox18" type="checkbox">
                            <label for="chkbox18">Relic</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox19" type="checkbox">
                            <label for="chkbox19">Repaint/Refinish</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox20" type="checkbox">
                            <label for="chkbox20">Restring & Tune Up</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox21" type="checkbox">
                            <label for="chkbox21">Tube Inspection & Replacement</label></p>
                        <p style="margin-bottom:1px;"><input id="chkbox22" type="checkbox">
                            <label for="chkbox22">Voltage Test</label></p>
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="items_required">Items Required</label>
                        <?php echo $this->Form->control('items_required', ['required' => false, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'id'=>'test', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <?php echo $this->Form->control('description', ['required' => false, 'onkeyup'=>'changeDesc(this.value)', 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'id'=>'Description', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary', 'disable' => true, 'id' => 'submit', 'style' => 'float:right']) ?>
            <?= $this->Form->end() ?>
            <?= $this->Form->button ('Cancel', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
        </div>
    </div>



    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
    <?= $this->Html->script('choices.min.js'); ?>
    <?= $this->Html->script('bootstrap.bundle.min.js'); ?>

    <!--//set the submit only can submit once-->
    <script type="text/javascript">
        $('form').submit(function() {
            $(document).find("button[type='Submit']").prop('disabled', true);
        });
    </script>

    <script>
        const sorting_customer = document.querySelector('.selectpicker-customer');
        // const commentSorting = document.querySelector('.selectpicker');
        // const commentSorting = document.querySelector('.selectpicker');
        const sortingchoices_instrument = new Choices(sorting_customer, {
            placeholder: false,
            itemSelectText: ''
        });

        // Trick to apply your custom classes to generated dropdown menu
        let sortingClass = sorting.getAttribute('class');
        window.onload = function() {
            sorting.parentElement.setAttribute('class', sortingClass);
        }
    </script>

    <script>
        function changeEstimate(value){
            let temp = Number(value)*0.1;
            let result = Math.round((Number(temp) + Number.EPSILON) * 100) / 100;
            document.getElementById('GSTid1').value=Number(result);
            document.getElementById('GSTid2').value=Number(result);

            let temp2 = Number(value) + Number(result);
            let result2 = Math.round((Number(temp2) + Number.EPSILON) * 100) / 100;
            document.getElementById('Totalid').value=Number(result2);
        }
    </script>

    <script>
        function changeTotal(value){
            let temp = Number(value)/11;
            let result = Math.round((Number(temp) + Number.EPSILON) * 100) / 100;
            document.getElementById('GSTid1').value=Number(result);
            document.getElementById('GSTid2').value=Number(result);

            let temp2 = Number(value) - Number(result);
            let result2 = Math.round((Number(temp2) + Number.EPSILON) * 100) / 100;
            document.getElementById('ESTid').value=Number(result2);
        }
    </script>

    <script>
        let textNew = "";

        function changeDesc(value){
            textNew = value;
            // document.getElementById('test').value = textNew;
        }

        $("#chkbox1").change(function(){
            if(this.checked == true){textNew += "- Action Adjustment \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Action Adjustment .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox2").change(function(){
            if(this.checked == true){textNew += "- Assembly & Test \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Assembly & Test .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox3").change(function(){
            if(this.checked == true){textNew += "- Bias Adjustment \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Bias Adjustment .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox4").change(function(){
            if(this.checked == true){textNew += "- Body Clean & Polish \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Body Clean & Polish .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox5").change(function(){
            if(this.checked == true){textNew += "- Disassembly & Diagnosis \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Disassembly & Diagnosis .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox6").change(function(){
            if(this.checked == true){textNew += "- Electronics Repair \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Electronics Repair .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox7").change(function(){
            if(this.checked == true){textNew += "- Electronics Service & Inspection \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Electronics Service & Inspection .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox8").change(function(){
            if(this.checked == true){textNew += "- Fret Polish/Minor Fret Dress \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Fret Polish/Minor Fret Dress .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox9").change(function(){
            if(this.checked == true){textNew += "- Fretboard Clean & Service \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Fretboard Clean & Service .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox10").change(function(){
            if(this.checked == true){textNew += "- Hardcase Clean & Vacuum \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Hardcase Clean & Vacuum .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox11").change(function(){
            if(this.checked == true){textNew += "- Hardware Inspection \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Hardware Inspection .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox12").change(function(){
            if(this.checked == true){textNew += "- Hardcase Repair \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Hardcase Repair .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox13").change(function(){
            if(this.checked == true){textNew += "- Intonation Adjustment \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Intonation Adjustment .*\n"),"\n");};
            $('#Description').val(textNew);
        });$("#chkbox14").change(function(){
            if(this.checked == true){textNew += "- Luthier Repair \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Luthier Repair .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox15").change(function(){
            if(this.checked == true){textNew += "- Modification \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Modification .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox16").change(function(){
            if(this.checked == true){textNew += "- Neck Adjustment \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Neck Adjustment .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox17").change(function(){
            if(this.checked == true){textNew += "- Nut Re-Cut/Replacement \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Nut Re-Cut/Replacement .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox18").change(function(){
            if(this.checked == true){textNew += "- Relic \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Relic .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox19").change(function(){
            if(this.checked == true){textNew += "- Repaint/Refinish \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Repaint/Refinish .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox20").change(function(){
            if(this.checked == true){textNew += "- Restring & Tune Up \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Restring & Tune Up .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox21").change(function(){
            if(this.checked == true){textNew += "- Tube Inspection & Replacement \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Tube Inspection & Replacement .*\n"),"\n");};
            $('#Description').val(textNew);
        });
        $("#chkbox22").change(function(){
            if(this.checked == true){textNew += "- Voltage Test \n"};
            if(this.checked == false){textNew = textNew.replace(new RegExp("(\n)?- Voltage Test .*\n"),"\n");};
            $('#Description').val(textNew);
        });
    </script>
