<?php
session_start();

if(isset($_GET['logout']))
    session_destroy();
session_start();
$_SESSION['success'] = 'Successfully Logged Out';

header('Location: ../../login.php');
