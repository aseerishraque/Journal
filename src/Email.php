<?php


namespace App;

use PDO;


class Email extends Database
{



    public function sendMail($to,$subject,$message)
    {
        // mail(to,subject,message,headers);
        $from = $this->server_mail;

//        $to = 'aseerishraque@gmail.com';
//        $subject = "Email Verification";
// $message = "<b>Your Verification Code is 123456.</b>";



// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From:".$from;



        $r = mail($to,$subject,$message,$headers);
        if ($r)
            return true;
        else
            return false;
    }


    public function sendVerficationMail($mail, $code)
    {
//        insert into database
//        send mail to user


        $r = $this->storeAdminCode($mail, $code);
        if ($r)
            $storeOK = 1;
        else
            $storeOK = 0;

       $content = "
<!DOCTYPE html>
<html lang=\"en\">
<body>
<h2>Hello Admin,</h2>
<p>Your Email Verification Code is:</p>
<h1>$code</h1>

</body>
</html>
";

     if ($storeOK == 1)
     {
      $r = $this->sendMail($mail, 'Email Verification', $content);
          if ($r)
             $er = 0;
          else
              $er = 1;
     }



//       $er = 0;
        if ($er == 0)
           return true;
       else
           return false;


    }


    public function storeAdminCode($mail, $token)
    {
        $created_at = date("Y-m-d h:i:s", time()) ;

        $sql = "INSERT INTO admin_email_verify SET email = '$mail', v_code = $token, created_at = '$created_at'";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();

        if ($r)
            return true;
        else
            return false;
    }

    public function getAdminCode()
    {
        $sql = "SELECT * FROM admin_email_verify ORDER BY id DESC LIMIT 0,1";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if (is_null($data['v_code']))
            return false;
        else
            return $data['v_code'];
    }


    public function verifyAdminMail($token)
    {
        $tokenDB = $this->getAdminCode();

        if ($token == $tokenDB)
            $tokenOK = 1;
        else
            $tokenOK = 0;

        if ($tokenOK == 1)
        {
            $sql = "UPDATE admin SET email_verified = 1 where id = 1";
            $q = $this->conn->prepare($sql);
            $r = $q->execute();
            if ($r)
                $emailVerified = 1;
            else
                $emailVerified = 0;

            if ($emailVerified == 1)
            {
                $sql = "DELETE FROM admin_email_verify";
                $q = $this->conn->prepare($sql);
                $r = $q->execute();
                if ($r)
                    return true;
                else
                    return false;
            }
            else
                return false;
        }
        else
            return false;

    }

}