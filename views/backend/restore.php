<?php
include_once('../../vendor/autoload.php');
session_start();
use App\Database;
use App\Utilities;
$d = new Utilities();
$db = new Database();


//$d->dd($_FILES['import_file']);

if (isset($_POST['import']))
{
    $file = $_FILES['import_file']['tmp_name'];
//            $d->dd($db->importdb($file));
//      $d->dd($file);
      $adminData = $db->getById(1, 'admin');

      extract($_POST);

      if ($username == $adminData['username'])
      {
          if ($password == $adminData['PASS'])
          {
              //check file type
              $type = explode('.', $_FILES['import_file']['name']);
              $type = $type[1];

              if ($type == 'sql')
              {
                  $r = $db->importdb($file);
                  if ($r){
                      $_SESSION['success'] = "Backup Restored!";
                      header("location: ../settings.php");
                  }else
                  {
                      $_SESSION['error'] = "Something went Wrong!";
                      header("location: ../settings.php");
                  }
              }
              else{
                  $_SESSION['error'] = "Invalid File!";
                  header("location: ../settings.php");
              }


          }else
          {
              $_SESSION['error'] = "Password Not Correct!";
              header("location: ../settings.php");
          }
      }else
      {
          $_SESSION['error'] = "Username Not Correct!";
          header("location: ../settings.php");
      }



}
