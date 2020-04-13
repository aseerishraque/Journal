<?php

include_once('../../vendor/autoload.php');

use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
use App\Transfer;
use App\MultiEntry;

$d = new Utilities();

//$obj = new \App\Share();
//$d->dd($obj->withdrawShare(2, 1));

//$number = 6352498.12555455568;
//$number = number_format((float) $number, 2, '.', '');
//echo $number +1.10 ;
//$a = explode('.','asd.jpg');
//
//$d->dd($a[1]);


$b = new Entry();
$a = new User();
$m = new MultiEntry();
$s = new Share();
$data['multi_entry_id'] = 1;
$data['entry_id'] = 523;
$d->dd($b->getEntryUserIds());
//$arr = $m->getMultiEntriesByEntryId(523);
//$d->dd($m->getMultiEntriesByEntryId(523));
//$d->dd($m->deleteMultiEntries($arr));

//date_default_timezone_set("Asia/Dhaka");
//echo date(date("d_m_Y_H_i"));

//$d->dd($a->getAdminCode());
//$d->dd($a->setAdminEmail('admin1@mail.com'));
//$d->dd($a->setAdminPassword('12345'));
//$d->dd($a->rollBackTransferShare(5));
//$d->dd($a->getUserSells(2));

//$data1 = $a->showUserJournal(2);
//$data2 = $a->getUserSells(2);
//$data = array_merge($data1, $data2);

//$data['user_id'] = 2;
//$data['username'] = 'heloo12';
//$data['name'] = 'Rezaul Alam';
//$data['email']= 'Hello@mail.com';
//$data['pass'] = '123zxxc';
//$data['NID'] = '01254456658745';
//$data['NID_name'] = 'Aseer Ishraqul Hoque';
//$data['name_bangla'] = 'Aseer Ishraqul Hoque';
//$data['gender'] = 'Male';
//$data['present_division'] = 'Chittagong';
//$data['present_district'] = 'Chittagong';
//$data['present_address'] = '2134, Shiraj bhaban, East Nasirabad, Khulshi';
//$data['permanent_division'] = 'Chittagong';
//$data['permanent_district'] = 'Chittagong';
//$data['permanent_address'] = '2134, Shiraj bhaban, East Nasirabad, Khulshi 4000';
//$data['profession'] = 'Business';
//$data['mobile'] = '01843774154';
//$data['fb_id'] = 'Ishraque2';
//$data['father_name'] = 'Anamul Hoque';
//$data['father_mobile'] = '01843774154';
//$data['mother_name'] = 'Romana Begum';
//$data['mother_mobile'] = '01843774154';
//$data['spouse_name'] = 'thasdashdasd';
//$data['spouse_mobile'] = '01843774154';
//$data['nominee_name'] = 'Sowad Sadik';
//$data['nominee_info'] = '01843774154';
//$data['nominee_info_details'] = 'BDATE';
//$data['bank'] = 'Mutual Trust Bank, CTG';
//$data['bank_acc'] = '01843774154542115';
//$data['bank_acc_branch'] = 'CDA Avenue';
//$data['bkash'] = '018437741545522';
//$data['bkash_type'] = 'Agent';
//$data['rocket'] = '01843774154554425';
//$data['rocket_type'] = 'personal';
//$d->dd($data);


//$d->dd($a->register($data));
//$d->dd($a->updateUser($data));
//$d->dd($a->getTotalBalance());
//$d->dd($a->showUserJournal(1));