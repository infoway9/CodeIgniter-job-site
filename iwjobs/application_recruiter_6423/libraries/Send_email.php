<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Send_email
{
    function __construct()
    {

    }

    function shoot_email($from_name, $from_email, $to_email, $subject, $mail_content)
    {
        //---------- start for define the web mail header -----------//

        $headers  = 'MIME-Version: 1.0' . "\n";

        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";

        $headers .= 'Content-transfer-encoding: 8bit' . "\n";

        $headers .= 'Date: ' . date('r', time()) . "\n";

        $headers .= 'X-Priority: 1' . "\n";

        $headers .= 'X-MSMail-Priority: High' . "\n";

        $headers .= 'X-Mailer: PHP/' . PHP_VERSION . "\n";

        $headers .= 'X-MimeOLE: Produced By IwJobs.com' . "\n";

        $headers .= 'From: ' . $from_name . ' <' . $from_email . '>' . "\n";

        $headers .= 'Message-ID: <' . md5(uniqid(time())) . '@' . $_SERVER['HTTP_HOST'] . '>' . "\n";

          //---------- end for define the web mail header -----------//


        //------------- start for sending the email ---------------------//
        
        //echo $mail_content;exit;
        @mail($to_email , $subject , $mail_content , $headers);

          //------------ end for sending the email --------------------//
    }
}