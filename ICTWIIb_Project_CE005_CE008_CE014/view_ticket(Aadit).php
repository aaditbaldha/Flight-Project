<?php
session_start();
include("config.php");

if (isset($_POST['book'])) {
    $_SESSION['book_type_id'] = $_POST['book'];
}
$num_in_name = false;
$alpha_in_phone = false;
$at_least_one_error = false;
$invalid_email = false;


if (isset($_SESSION['book_type_id'])) {
    $origin = mysqli_real_escape_string($link, $_SESSION['origin']);
    $que = "SELECT `country`, `city`, `airport` FROM `airport` WHERE `city`='{$origin}'";
    $row = mysqli_query($link, $que);
    $origin_row = mysqli_fetch_assoc($row);

    $desti = mysqli_real_escape_string($link, $_SESSION['destination']);
    $que = "SELECT `country`, `city`, `airport` FROM `airport` WHERE `city`='{$desti}'";
    $row1 = mysqli_query($link, $que);
    $desti_row = mysqli_fetch_assoc($row1);

    $book_id = mysqli_real_escape_string($link, $_SESSION['book_type_id']);
    if ($origin_row['country'] == 'India' && $desti_row['country'] == 'India') {

        $que0 = "SELECT `airway_name`,`departure_time`,`arrival_time`,`duration`,`e_price`,`b_price` FROM `search_flight_domestic` WHERE `id`={$book_id}";
        $row0 = mysqli_query($link, $que0);
        $ticket_row0 = mysqli_fetch_assoc($row0);
    } else {
        $que0 = "SELECT `airway_name`,`departure_time`,`arrival_time`,`duration`,`e_price`,`b_price` FROM `search_flight_international` WHERE `id`={$book_id}";
        $row0 = mysqli_query($link, $que0);
        $ticket_row0 = mysqli_fetch_assoc($row0);
    }
    echo "<table border='3' class='logintable' align='center'>
            <tr>
            <th align ='centre' colspan='5'><i class='fa fa-ticket'></i>YOUR TICKET</th>
            </tr>
       
        
            <tr><td rowspan='5'>
            ".$ticket_row0['airway_name']."
            </td>
            
        <td>
            ".$_SESSION['departure_date']."<br>"
            
             .$ticket_row0['departure_time']."<br>
        
        
            ".$origin_row['airport']."<br>
        
            
            
            ".$origin_row['city']."<br>            
        
            ".$origin_row['country']."
            </td>";

            echo "<td rowspan='5'><td>".$ticket_row0['duration']."</td>";
            
            if($_SESSION['flight_type']==2)
            {
                echo "<td>".$_SESSION['arrival_date']."<br>";
            }
            echo
            "<td>".$ticket_row0['arrival_time']."<br>
            ".$desti_row['airport']."<br>
            ".$desti_row['city']."<br>
        ".$desti_row['country']."
            </td>
            </tr>
                </table> 
                ";
    }
?>

<html>

<body>
    <link rel="stylesheet" href="flight_project.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <form action='view_ticket(Aadit).php' method='POST'>
        <table border='3' class="logintable" align="center" cellspacing="7px" rules="none">
            <tr>
                <th colspan='4'><i class="fa fa-info-circle"></i> INFORMATION</th>
            </tr>
            <tr class="bordered"></tr>
            <tr>
                <th>Adult Name:</th>
            </tr>
            <tr>
                <td><input type='text' name='firstname' placeholder='First Name' required>
                    <input type='text' name='lastname' placeholder='Last Name' required>
                </td>
            </tr>
            <tr>
                <th>Email Address:</th>
            </tr>
            <td align="center"><input type='email' name='email' placeholder='Your Email' required></td>
            </tr>
            <tr>
                <th>Phone Number:</th>
            </tr>
            <tr>

                <td align="center"><input type='text' name='phonenum' placeholder='XXXXXXXXXX' required pattern='\d{10}'></td>
            </tr>
            <tr>
                <td colspan='4' align='center'><input type='submit' name='submit_ticket' required></td>
            </tr>

        </table>
    </form>
</body>

</html>

<?php
if (isset($_POST['submit_ticket'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenum = $_POST['phonenum'];
    $email = $_POST['email'];

    //regular expressions
    $matchphone = "/\D/";
    $match_username = "/[^a-z A-Z]/";



    //field validations
    if (preg_match($matchphone, $phonenum)) {
        $alpha_in_phone = true;
        echo "<p text-align='center'>Please type your phone number properly</p><br>";
    }

    if (preg_match($match_username, $firstname) || preg_match($match_username, $lastname)) {
        $num_in_name = true;
        echo "<p text-align='center'>Your firstname and lastname should not contain characters other than alphabets (not even spaces)</p><br>";
    }

    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $invalid_email = true;
        echo "<p text-align='center'>Invalid email address</p><br>";
    }

    if ($alpha_in_phone || $num_in_name || $invalid_email) {
        $at_least_one_error = true;
        $_POST['book'] = $_SESSION['book_type_id'];
    }

    if ($at_least_one_error) {
        echo "<p text-align='center'>Fill your form properly</p> ";
    } else {
        $_SESSION['passenger_firstname'] = $_POST['firstname'];
        $_SESSION['passenger_lastname'] = $_POST['lastname'];
        $_SESSION['passenger_email'] = $_POST['email'];
        $_SESSION['passenger_phonenum'] = $_POST['phonenum'];
        header("Location:view_plane.php");
    }
}


?>