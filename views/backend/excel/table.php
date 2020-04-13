<?php
include_once('../../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
use App\MultiEntry;

$d = new Utilities();

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<style type="text/css">
    #tblData{
        /*display: none;*/
    }
    table, tr, td,th{
        border: 1px solid black;
        border-collapse: collapse;
    }
    td{
        padding: 0;
    }
</style>

<body>

<table id="tblData_to_excel" >
    <thead>
    <tr>
        <th colspan="7">Full Ledger</th>
    </tr>
    <tr>

        <th>Date</th>
        <th>Item</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance</th>

    </tr>
    </thead>

    <tbody>
    <?php

    $obj = new Entry();
    $All = $obj->showJournal();
    $d = 0;
    $c = 0;
    $b = 0;
    if ($All != 0)
        foreach ($All as $value){
            $d += $value['debit'];
            $c += $value['credit'];
            $b = $c - $d;
            ?>

            <tr>
                <td><?php echo $value['date']?>  </td>
                <td><?php echo $value['item']?></td>
                <td><?php
                    if($value['user_id'] != 0)
                        echo $value['user_id']?></td>
                <td><?php echo $value['name'] ?>
                </td>
                <td><?php
                    if($value['debit']!=0)
                        echo number_format($value['debit'], 2)?></td>
                <td><?php
                    if ($value['credit']!=0)
                        echo number_format($value['credit'], 2)?></td>
                <td><?php echo number_format($b, 2)?></td>

            </tr>

            <?php

        }

    $share = new Share();
    $shareUsers = $share->allShares();

    foreach ($shareUsers as $user)
    {
        $userdb = new User();

        $userInfo = $userdb->getById($user['user_id'], $userdb->table);
        $share_quantity = $userdb->getUserShareQuantity($user['user_id']);
        $balance = $userdb->getBalance($user['user_id']);
     ?>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <th colspan="7">User ID: <?php echo $user['user_id'] ?></th>
        </tr>
        <tr>
            <th colspan="7"><?php echo $userInfo['name'] ?></th>
        </tr>
        <tr>
            <th colspan="7">Current Balance: BDT <?php echo number_format($balance, 2) ?></th>
        </tr>
        <tr>
            <th colspan="7">Share(s): <?php echo $share_quantity ?> </th>
        </tr>
        <tr>

            <th>Date</th>
            <th colspan="3">Item</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>

        </tr>
        <?php
        $obj = new Entry();
        $All = $obj->showUserJournal($user['user_id']);
        $d = 0;
        $c = 0;
        $b = 0;
        if ($All != 0)
            foreach ($All as $value){
                $d += $value['debit'];
                $c += $value['credit'];
                $b = $c - $d;
                ?>

                <tr>
                    <td><?php echo $value['date']?>  </td>
                    <td colspan="3"><?php echo $value['item']?></td>
                    <td><?php
                        if($value['debit']!=0)
                            echo number_format($value['debit'], 2)?></td>
                    <td><?php
                        if ($value['credit']!=0)
                            echo number_format($value['credit'], 2)?></td>
                    <td><?php echo number_format($b, 2)?></td>
                </tr>

                <?php

            }

        ?>
    <?php
    }
    ?>

    </tbody>

</table>
<button onclick="exportTableToExcel('tblData_to_excel')">Export Table Data To Excel File</button>
<script type="text/javascript">
    function exportTableToExcel(tableID, filename = 'file1'){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>
</body>
</html>
