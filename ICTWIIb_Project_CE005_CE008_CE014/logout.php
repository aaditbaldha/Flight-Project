<?php
session_start();

if (isset($_SESSION['name'])==false && isset($_SESSION['id'])==false && isset($_SESSION['email'])==false) {
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="flight_project.css">
    <title>Logout</title>

    </style>
</head>
<body style="background-color: lavender;">
    <h1>GOIVIVO</h1> 
    <h2>Thank you for using our services <?php echo $_SESSION['name']; session_unset(); session_destroy(); ?></h2>
    <button style="margin-left: 600px;"><a href="login.php">CLICK HERE TO LOGIN</a></button>
</body>
</html>