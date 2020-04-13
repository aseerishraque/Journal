<?php
if ($_SESSION['user_type'] == 'admin')
    $home = 'index.php';
else
    $home = 'user-dashboard.php';
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $home ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-calculator"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Journal <sup>v2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <?php
    if ($_SESSION['user_type'] == 'admin')
    {
         ?>
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>


        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="tables.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Ledger</span></a>
        </li>

        <!-- New Entry -->
        <li class="nav-item">
            <a class="nav-link" href="new_entry.php">
                <i class="fas fa-folder-plus"></i>
                <span>New Entry</span></a>
        </li>

        <!-- User List -->
        <li class="nav-item">
            <a class="nav-link" href="all_users.php">
                <i class="fas fa-user-friends"></i>
                <span>All Users</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- User List -->
        <li class="nav-item">
            <a class="nav-link" href="transfers.php">
                <i class="fas fa-user-friends"></i>
                <span>All Transfers</span></a>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="share_transfer.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Transfer Share</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- User List -->
        <li class="nav-item">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-tools"></i>
                <span>Settings</span></a>
        </li>

        <?php
    }elseif ($_SESSION['user_type'] == 'user')
    {
        ?>
        <li class="nav-item active">
            <a class="nav-link" href="user-dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item ">
            <a class="nav-link" href="user-information.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>User Information</span></a>
        </li>

        <li class="nav-item ">
            <a class="nav-link" href="reset_password_user.php">
                <i class="fas fa-fw fa-user-secret"></i>
                <span>Change Password</span></a>
        </li>

        <?php
    }
    ?>




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>