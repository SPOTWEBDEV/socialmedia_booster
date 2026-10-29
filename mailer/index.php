<?php

require "PHPMailer/PHPMailerAutoload.php";


function smtpmailer($to, $subject, $body)
{
        global $host , $emailpassword;
         $mail = new PHPMailer();
         $mail->IsSMTP();
         $mail->SMTPAuth = true;

         $mail->SMTPSecure = 'ssl'; // Using 'ssl' with port 465 as per your original configuration
         $mail->Host = 'mail.boostyard.top';
         $mail->Port = 465; // Or 587 if using 'tls'
         $mail->Username = 'support@boostyard.top';
         $mail->Password = 'support@boostyard.top'; // Use your actual email password

         $mail->IsHTML(true);
         $mail->From = 'support@boostyard.top';
         $mail->FromName = 'Boost Yard';
         $mail->Sender = 'support@boostyard.top';
         $mail->AddReplyTo('support@boostyard.top', 'Boost Yard');
         $mail->Subject = $subject;
         $mail->Body = $body;
         $mail->AddAddress($to);

         // Enable SMTP debugging
        //  $mail->SMTPDebug = 2; // 0 = off, 1 = client messages, 2 = client and server messages
        //  $mail->Debugoutput = 'html'; // Output format for debugging

         if (!$mail->Send()) {
                  // Log error or handle failure
                  error_log('Email sending failed: ' . $mail->ErrorInfo);
                  return false;
         }

         return true;
}



?>