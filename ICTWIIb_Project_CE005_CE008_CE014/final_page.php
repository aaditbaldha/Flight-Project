<?php
session_start();
include ("config.php");
require 'phpmailer/PHPMailerAutoload.php';

$book_id=mysqli_real_escape_string($link,$_SESSION['book_type_id']);

$origin=mysqli_real_escape_string($link,$_SESSION['origin']);
$destination=mysqli_real_escape_string($link,$_SESSION['destination']);

$o_que="SELECT `id`, `country`, `city`, `airport` FROM `airport` WHERE `city`='$origin'";
$o_res=mysqli_query($link,$o_que);
$o_row=mysqli_fetch_assoc($o_res);

$d_que="SELECT `id`, `country`, `city`, `airport` FROM `airport` WHERE `city`='$destination'";
$d_res=mysqli_query($link,$d_que);
$d_row=mysqli_fetch_assoc($d_res); 


if($d_row['country']=='India' && $o_row['country']=='India')
{
    $airway_que="SELECT * FROM `search_flight_domestic` WHERE `id`='$book_id'";
}  

else
{
  $airway_que="SELECT * FROM `search_flight_international` WHERE `id`='$book_id'";
}
$airway_res=mysqli_query($link,$airway_que);
$air_data_row=mysqli_fetch_assoc($airway_res);

$message="Your ticket has been booked";
    
$mail=new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->Username='goivivoteam@gmail.com';
$mail->Password='005008014';
$mail->setFrom('goivivoteam@gmail.com');
$mail->addAddress($_SESSION['passenger_email']);
    
$mail->Subject='YOUR TICKET';
$mail->Body=$message;
$mail->send();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
 <link rel="stylesheet" href="flight_project.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <h1>GOIVIVO</h1> 
    <h2>Thank you for using our services. Your ticket has been sent to your email..</h2>
    <p style="text-align: center;"><a href="view_ticket_dashboard.php">CLICK HERE TO SEE YOUR TICKET</a>
    <p style="text-align: center;"><a href="dashboard.php">CLICK HERE TO GO TO DASHBOARD</a>
</body>
</html>