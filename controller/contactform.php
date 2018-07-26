<?php
session_start();

        $to = "insert email address here";
        $your_feedbackmail = "Motion Sickness Gaming <insert server address here>";
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_details = $_POST['details'];
        $subject = "From Contact Form";
        $txt = "User_name: $user_name Useremail: $user_email Details: $user_details";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "From: $your_feedbackmail" . "\r\n";
        
        mail($to, $subject, $txt, $headers);
        $_SESSION['message'] = "Thankyou, your email has been sent.";
        header ('Location: ../view/php/contact.php');
?>