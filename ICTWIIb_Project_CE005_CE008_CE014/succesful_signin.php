<?php

session_start();

require 'phpmailer/PHPMailerAutoload.php';

if(isset($_SESSION['name'])==false && isset($_SESSION['id'])==false && isset($_SESSION['email'])==false)
{
    header("location:login.php");
}
else if(isset($_SESSION['login']) && $_SESSION['enter_from']!="signin")
{
    
    header("location:login.php");
}
else
{
    $message="You have succesfully created your";
    

    $mail=new PHPMailer;

    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';

    $mail->Username='aaditbaldha2002@gmail.com';
    $mail->Password='9023603280';

    $mail->setFrom('aaditbaldha2002@gmail.com');
    $mail->addAddress($_SESSION['email']);
    

    $mail->Subject='PHP MAILER SUBJECT';
    $mail->Body=$message;

    $mail->send();

}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="flight_project.css">
        <title>Login</title>
        
    </head>
    <body style="background-color: lavender;">
        <h1>GOIVIVO </h1>
        <h2><?php echo'Welcome '.$_SESSION['name'];?></h2>
        <h1>YOU HAVE SUCCESFULLY CREATED ACCOUNT</h1>
        <button style="margin-left:625px;"><a href="login.php"> Click to Login </a></button>
    </body>
    </html>
