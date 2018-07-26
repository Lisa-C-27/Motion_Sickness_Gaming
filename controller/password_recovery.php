<?php
session_start();

if(isset($_POST['pwrec'])) {
    $checkuser = "SELECT * FROM user WHERE email='" . $_POST['email'] . "';";
    include '../model/connect.php';
    $stmt = $conn->prepare($checkuser);
    $stmt->execute();
    $result = $stmt->fetch();
    
    if ($stmt->rowCount() == 0) {
        $_SESSION['message'] = "The email supplied does not exist in the database";
        header ('Location: ../view/php/forgot_password.php');
    } else {
        $algo = "md5";
        $data = microtime();
        $hash = hash($algo, $data);
        $userID = $result['userID'];
        
        $insert = "INSERT INTO password_recovery (userID, hashlink) VALUES (:id, :hash)";
        $stmt = $conn->prepare($insert);
        $stmt->bindParam(':id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
        $stmt->execute();

        $to = $_POST['email'];
        $subject = "Password recovery";
        $txt = '<html><body>
        <p>Click the recovery link to reset your password</p>
        <p><a href="https://motsickgaming.kandigalaxy.website/view/php/reset_password.php?recover=' . $hash . '"</a></p>
        </body></html>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Motion Sickness Gaming <insert email address here>' . "\r\n";
        
        mail($to, $subject, $txt, $headers);
        
        $_SESSION['message'] = "Thankyou, an email will be sent shortly. Please remember to check your junk/spam inbox.";
        header ('Location: ../view/php/forgot_password.php');
    }
}

?>