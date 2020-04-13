<?php

include_once('../../vendor/autoload.php');

use App\Entry;

$obj = new Entry();

$form = $obj->userForm($_GET['item']);

if($form) {
    ?>

    <div class="form-group col-md-6">
        <label for="inputUserId">User ID(Recommended) </label>
        <input onkeyup="getUserName()" name="user_id" type="number" class="form-control" id="user_id" placeholder="User ID">
       
    </div>
    <div class="form-group col-md-6">
        <label for="inputName">Name</label>
        <input onkeyup="getUserId()"  type="text" class="form-control" id="user_name" placeholder="Name">
        <span id="userError">  </span>
    </div>

    <div class="form-group col-md-6">
        <label for="Balance">Balance</label>
        <input disabled type="number" class="form-control" id="balance" value="000">
    </div>
    <div class="form-group col-md-6">
        <label for="shareAmount">Share(s)</label>
        <input disabled type="number" class="form-control" id="shares" value="000">
    </div>


        <div class="form-group col-md-6">
            <label for="current_value_per_share">Current Value Per Share</label>
            <input readonly type="number" class="form-control" id="current_value_per_share" value="000" name="current_value_per_share">
        </div>
        <div class="form-group col-md-6">
            <label for="current_profit">Current Profit Per Share</label>
            <input readonly type="number" class="form-control" id="current_profit_per_share" value="000" name="current_profit_per_share">
        </div>
        <div class="form-group col-md-6">
            <label for="current_profit">Current Profit</label>
            <input readonly type="number" class="form-control" id="current_profit" value="000" name="current_profit">
        </div>



    <?php
}
else{
    ?>

<!--    <input name="user_id" type="hidden" value="NULL">-->
<?php
}
?>