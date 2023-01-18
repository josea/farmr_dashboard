<?php
    //This file is a task which runs in the server every X minutes to send notifications.
    include('db.php'); //initializes $conn = new mysqli();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    
    require __DIR__ . '/vendor/autoload.php';
    // require 'path/to/PHPMailer/src/Exception.php';
    // require 'path/to/PHPMailer/src/PHPMailer.php';
    // require 'path/to/PHPMailer/src/SMTP.php';


    $command1 = " SELECT notificationID,user,type,name from notifications;";
    $result1 = $conn -> query($command1);
    
    while ($row = $result1 -> fetch_row())
    {
        $id = $row[0];
        $userID = $row[1];
        $type = $row[2];
        $name = $row[3];

        echo 'user ' . $userID . PHP_EOL;

        sendmsg($userID, $type, $name);
        $cmd2 = "DELETE from notifications where notificationID=" . $id;
        $result2 = $conn -> query($cmd2);
    }


   // sendEmail('josearaujof@gmail.com', '[Farmr2] - ', 'Test body');

    function sendmsg($userID, $type, $name){
        if ($userID !== "none") {
            $message = "";
    
            if ($type == "block") {
                $subject =  $name . " just found a block!";
                $message = "🤑 " . $name . " just found a block!";
            }
            else if ($type == "coldBlock") {
                $subject = $name . " just received funds";
                $message = "🥶 Cold Wallet in " . $name . " just received funds. Is it a block?";
            }    
            else if ($type == "plot"){
                $subject = $name . " just completed another plot.";
                $message = "🎉 " . $name . " just completed another plot.";
            }     
            else if ($type == "offline") {
                $subject = "Lost connection to " . $name . "!";
                $message = "☠️ Lost connection to " . $name . "!";
            }
            else if ($type == "online") {
                $subject =  $name . " has reconnected!";
                $message = "😊 " . $name . " has reconnected!";
            }    
            else if ($type == "stopped") {
                $subject = $name . " stopped farming/harvesting!";
                $message = "😱 " . $name . " stopped farming/harvesting!";
            }
            else if ($type == "started") {
                $subject = $name . " started farming/harvesting!";
                $message = "😎 " . $name . " started farming/harvesting!";
            }    
            else if ($type == "drive") {
                $subject = $name . " lost one of its drives!";
                $message = "💿 " . $name . " lost one of its drives!";
            }
    
            echo 'message: ' . $message . PHP_EOL; 
            echo 'userId: ' .  $userID . PHP_EOL; 
            //sends email
            if ($message != "") {    
                if (strpos($userID ,"@") !== false ) {    
                    sendEmail($userID, $subject, $message);    
                }
            }

        }

    }


    function sendEmail($to, $subject, $body) {
        $mail = new PHPMailer(true);

        $username = 'your username@gmail.com';  
        $password = 'your app password';
        
        $fromName = 'Farmr2';
        $fromEmail = 'your username@gmail.com';  		

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $username;                     // SMTP username
            $mail->Password   = $password;                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($to);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $body;// 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>