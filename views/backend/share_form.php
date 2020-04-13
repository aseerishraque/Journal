<?php

include_once('../../vendor/autoload.php');

use App\Entry;

$obj = new Entry();

$form = $obj->shareForm($_GET['item']);
$item = $_GET['item'];
if($item == 5 || $item == 1)
    $val = 'No. of Shares to be withdrawn';
if($form) {
    ?>

    <label for="inputAmount">
        <?php
        if(isset($val))
            echo $val;
        else
            echo "Share";
        ?>
    </label>
    <input onkeyup="shareCalculate()" name="share" type="number" class="form-control" id="share" value="1">
    <span id="shareAmount" class="alert-primary"></span>
    <?php
}

?>
