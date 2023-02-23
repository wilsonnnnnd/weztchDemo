<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>

<style>
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
    .white {
        color: white;
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

</style>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-user-friends"></i>Customers</h3>
    </div>
</div>

<div class="row">
    <ol class="breadcrumb" style="width: 70rem;">
        <li><i class="fas fa-user-friends"></i><a <?php echo $this->Html->link('Customers', array('controller' => 'Customers', 'action' => 'index'), array('escape' => false)); ?></a></li>
        <li><i class="far fa-plus-square"></i>Add Customer</li>
    </ol>
    <div class="card" style="width: 70rem;">

        <div class="card-body">
            <h5 class="card-title">Add Customer</h5><div class="pull-right">&nbsp;<div class = legend>Indicates mandatory if option<p> to the left is selected</p></div></div><div class="red pull-right">* </div><br>
            <div class="card-text">
                <?= $this->Form->create($customer) ?>
                <div class="input-group-append">
                    <label for="type">Type:</label> &ensp;
                    <?php $options = array('Individual' => 'Individual', 'Business' => 'Business');
                    echo $this->Form->control('type', ['onchange'=>'changetype(this.value)','required' => true, 'options' => $options, 'maxlength' => 50, 'placeholder' => 'Maximum length:50', 'label' => false, 'class' => 'form-control']); ?>
                    &emsp;
                    <label for="preferred_contact">Preferred Contact Method:</label> &ensp;
                    <?php $options3 = array('Email' => 'Email', 'Phone No' => 'Phone No');
                    echo $this->Form->control('preferred_contact', ['onchange'=>'changecontact(this.value)','required' => false, 'options' => $options3, 'placeholder' => 'Maximum length:100', 'label' => false, 'class' => 'form-control']); ?>
                    &emsp;
                    <label for="intro_method">Introduction Method: </label>&ensp;
                    <?php $options4 = array('Phone' => 'Phone', 'Email' => 'Email', 'Website' => 'Website', 'Facebook' => 'Facebook', 'Instagram' => 'Instagram', 'In Person' => 'In Person', 'Store Visit' => 'Store Visit');
                    echo $this->Form->control('intro_method', ['required' => false, 'options' => $options4, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="first_name">First Name <div class = red>*</div></label>
                        <?php echo $this->Form->control('first_name', ['required' => true,'id'=>'first_name', 'maxlength' => 50, 'placeholder' => 'Maximum length: 50', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="last_name">Last Name <div class = red>*</div></label>
                        <?php echo $this->Form->control('last_name', ['required' => true, 'id'=>'last_name','maxlength' => 50, 'placeholder' => 'Maximum length: 50', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="gender">Gender <div class = white>*</div></label>
                        <?php $options2 = array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other');
                        echo $this->Form->control('gender', ['required' => false, 'placeholder' => 'Click to select a gender', 'options' => $options2, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="business">Business Name <div class = red>*</div></label>
                        <?php echo $this->Form->control('business', ['required' => false, 'id'=>'business_type','maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="abn">ABN <div class = white>*</div></label>
                        <?php echo $this->Form->control('abn', ['required' => false, 'onkeypress' => 'limit(event,this.value,11);', 'maxlength' => 11, 'placeholder' => 'Enter Australian Business Number','type' => 'number', 'min' => 0, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email <div class = red>*</div></label>
                        <?php echo $this->Form->control('email', ['required' => true, 'id'=>'email','maxlength' => 100, 'placeholder' => 'Maximum length: 100', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone_no">Phone No <div class = red>*</div></label>
                        <?php echo $this->Form->control('phone_no', ['required' => false, 'id'=>'phone','onkeypress' => 'limit(event,this.value,10);', 'maxlength' => 10, 'placeholder' => 'Enter Phone Number', 'type' => 'number', 'min' => 0, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="street">Street</label>
                        <?php echo $this->Form->control('street', ['required' => false, 'id' => 'current_address', 'placeholder' => 'Start typing address here', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="city">City</label>
                        <?php echo $this->Form->control('city', ['required' => false, 'id' => 'new_address', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="state">State</label>
                        <?php echo $this->Form->control('state', ['required' => false, 'id' => 'new_state', 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="postcode">Postcode</label>
                        <?php echo $this->Form->control('postcode', ['required' => false, 'id' => 'new_postcode', 'maxlength' => 4, 'label' => false, 'class' => 'form-control']); ?>
                    </div>
                </div><br>
                <div class="form-group">
                    <label for="description">Description</label>
                    <?php echo $this->Form->control('description', ['required' => false, 'maxlength' => 500, 'placeholder' => 'Maximum length: 500', 'label' => false, 'class' => 'form-control']); ?>
                </div>
            </div>

            <?= $this->Form->button('Submit', ['class' => 'btn btn-primary', 'id' => 'submit', 'style' => 'float:right']) ?>
            <?= $this->Form->end() ?>
            <?= $this->Form->button ('Cancel', ['onclick' =>'history.back ()', 'type' =>'button','class'=>'btn btn-secondary'])?>
        </div>
    </div>
</div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<!--//set the submit only can submit once-->
<script type="text/javascript">
    $('form').submit(function() {
        $(document).find("button[type='Submit']").prop('disabled', true);
    });
</script>
<script>
    let autocomplete;
    // let autocomplete1;
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('current_address'), {
            componentRestrictions: {
                country: ["au"]
            },
        });
        autocomplete.addListener("place_changed", fillInAddress);
        // autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('new_address'));
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();
        let address1 = "";
        let postcode = "";
        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        // place.address_components are google.maps.GeocoderAddressComponent objects
        // which are documented at http://goo.gle/3l5i5Mr
        for (const component of place.address_components) {
            const componentType = component.types[0];

            switch (componentType) {
                case "street_number": {
                    address1 = `${component.long_name} ${address1}`;
                    break;
                }

                case "route": {
                    address1 += component.short_name;
                    break;
                }

                case "postal_code": {
                    $("#new_postcode").val(`${component.long_name}${postcode}`);
                    break;
                }
                case "locality":
                    $("#new_address").val(component.long_name);
                    break;

                case "administrative_area_level_1": {
                    $("#new_state").val(component.short_name);
                    break;
                }

            }
        }
        console.log(address1);
        $("#current_address").val(address1);
        // $("#street").val(postcode);

        // After filling the form with address components from the Autocomplete
        // prediction, set cursor focus on the second address line to encourage
        // entry of subpremise information such as apartment, unit, or floor number.
        // address2Field.focus();
    }
</script>

<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJMs9Hm7j3cEhbOewPl8lxFawWTEkvy7w&libraries=places&callback=initAutocomplete">
</script>
<script>
    function limit(event, value, maxLength) {
        if (value != undefined && value.toString().length >= maxLength) {
            event.preventDefault();
        }
    }
    function changetype(type){
        if(type=='Individual'){
            document.getElementById('first_name').required=true;
            document.getElementById('last_name').required=true;
            document.getElementById('business_type').required=false;
        }
        else{
            document.getElementById('first_name').required=false;
            document.getElementById('last_name').required=false;
            document.getElementById('business_type').required=true;
        }
    }
    function changecontact(contact){
        if(contact=='Email'){
            document.getElementById('email').required=true;
            document.getElementById('phone').required=false;
        }
        else{
            document.getElementById('phone').required=true;
            document.getElementById('email').required=false;
        }
    }
</script>



