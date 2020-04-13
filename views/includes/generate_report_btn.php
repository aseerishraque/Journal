<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <?php
    date_default_timezone_set("Asia/Dhaka");
    $downloaded_filename = "Full_Ledger_".date("d_m_Y_H_i");
    ?>
    <button onclick="exportTableToExcel('tblData_to_excel', '<?php echo $downloaded_filename?>' )" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
</div>