<?php

    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $redirect_here=false;
        $seat=$_POST['seat'];
        if($seat==null)
        {
            $no_seat_selected=true;
        }
        else
            $no_seat_selected=false;
    }
    else
        $redirect_here=true;

if($redirect_here==true || $no_seat_selected==true)
{
    $atleast_one_error=true;
}
else
{
    $atleast_one_error=false;
    $_SESSION['seat']=$seat;

}


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <div class="container">
        <div class="cockpit">
            <h1>Please select a seat</h1>
        </div>

        
        <form method="POST" <?php if($atleast_one_error==true) echo'action="view_plane.php"'; else header("Location:payment.php"); ?>
            
            <div class="row">
                
                
                <input type="radio" name="seat" value="1A" id="1A" style="display: none;"><label for="1A"><div class="seat" tabindex="1">1A</div></label>
                <input type="radio" name="seat" value="1B" id="1B" style="display: none;"><label for="1B"><div class="seat_2" tabindex="1">1B</div></label>
                <input type="radio" name="seat" value="1C" id="1C" style="display: none;"><label for="1C"><div class="seat" tabindex="1">1C</div></label>
                <div class="seat_occupied">1D</div>
                <div class="seat_occupied">1E</div>
                <input type="radio" name="seat" value="1F" id="1F" style="display: none;"><label for="1F"><div class="seat_2" tabindex="1">1F</div></label>
                <input type="radio" name="seat" value="1G" id="1G" style="display: none;"><label for="1G"><div class="seat" tabindex="1">1G</div></label>
                <input type="radio" name="seat" value="1H" id="1H" style="display: none;"><label for="1H"><div class="seat" tabindex="1">1H</div></label>
            </div>
            <div class="row">
                <input type="radio" name="seat" value="2A" id="2A" style="display: none;"><label for="2A"><div class="seat" tabindex="1">2A</div></label>
                <div class="seat_occupied_2">2B</div>
                <div class="seat_occupied">2C</div>
                <input type="radio" name="seat" value="2D" id="2D" style="display: none;"><label for="2D"><div class="seat" tabindex="1">2D</div></label>
                <input type="radio" name="seat" value="2E" id="2E" style="display: none;"><label for="2E"><div class="seat" tabindex="1">2E</div></label>
                <input type="radio" name="seat" value="2F" id="2F" style="display: none;"><label for="2F"><div class="seat_2" tabindex="1">2F</div></label>
                <input type="radio" name="seat" value="2G" id="2G" style="display: none;"><label for="2G"><div class="seat" tabindex="1">2G</div></label>
                <input type="radio" name="seat" value="2H" id="2H" style="display: none;"><label for="2H"><div class="seat" tabindex="1">2H</div></label>
            </div>
            <div class="row">
                <div class="seat_occupied">3A</div>
                <input type="radio" name="seat" value="3B" id="3B" style="display: none;"><label for="3B"><div class="seat_2" tabindex="1">3B</div></label>
                <input type="radio" name="seat" value="3C" id="3C" style="display: none;"><label for="3C"><div class="seat" tabindex="1">3C</div></label>
                <input type="radio" name="seat" value="3D" id="3D" style="display: none;"><label for="3D"><div class="seat" tabindex="1">3D</div></label>
                <input type="radio" name="seat" value="3E" id="3E" style="display: none;"><label for="3E"><div class="seat" tabindex="1">3E</div></label>
                <input type="radio" name="seat" value="3F" id="3F" style="display: none;"><label for="3F"><div class="seat_2" tabindex="1">3F</div></label>
                <div class="seat_occupied">3G</div>
                <div class="seat_occupied">3H</div>
            </div>
            <div class="row">
                <input type="radio" name="seat" value="4A" id="4A" style="display: none;"><label for="4A"><div class="seat" tabindex="1">4A</div></label>
                <input type="radio" name="seat" value="4B" id="4B" style="display: none;"><label for="4B"><div class="seat_2" tabindex="1">4B</div></label>
                <input type="radio" name="seat" value="4C" id="4C" style="display: none;"><label for="4C"><div class="seat" tabindex="1">4C</div></label>
                <div class="seat_occupied">4D</div>
                <input type="radio" name="seat" value="4E" id="4E" style="display: none;"><label for="4E"><div class="seat" tabindex="1">4E</div></label>
                <input type="radio" name="seat" value="4F" id="4F" style="display: none;"><label for="4F"><div class="seat_2" tabindex="1">4F</div></label>
                <div class="seat_occupied">4G</div>
                <input type="radio" name="seat" value="4H" id="4H" style="display: none;"><label for="4H"><div class="seat" tabindex="1">4H</div></label>
            </div>
            <div class="row">
                <input type="radio" name="seat" value="5A" id="5A" style="display: none;"><label for="5A"><div class="seat" tabindex="1">5A</div></label>
                <input type="radio" name="seat" value="5B" id="5B" style="display: none;"><label for="5B"><div class="seat_2" tabindex="1">5B</div></label>
                <input type="radio" name="seat" value="5C" id="5C" style="display: none;"><label for="5C"><div class="seat" tabindex="1">5C</div></label>
                <input type="radio" name="seat" value="5D" id="5D" style="display: none;"><label for="5D"><div class="seat" tabindex="1">5D</div></label>
                <input type="radio" name="seat" value="5E" id="5E" style="display: none;"><label for="5E"><div class="seat" tabindex="1">5E</div></label>
                <div class="seat_occupied_2">5F</div>
                <div class="seat_occupied">5G</div>
                <div class="seat_occupied">5H</div>
            </div>
            <div class="row">
                <input type="radio" name="seat" value="6A" id="6A" style="display: none;"><label for="6A"><div class="seat" tabindex="1">6A</div></label>
                <input type="radio" name="seat" value="6B" id="6B" style="display: none;"><label for="6B"><div class="seat_2" tabindex="1">6B</div></label>
                <input type="radio" name="seat" value="6C" id="6C" style="display: none;"><label for="6C"><div class="seat" tabindex="1">6C</div></label>
                <input type="radio" name="seat" value="6D" id="6D" style="display: none;"><label for="6D"><div class="seat" tabindex="1">6D</div></label>
                <input type="radio" name="seat" value="6E" id="6E" style="display: none;"><label for="6E"><div class="seat" tabindex="1">6E</div></label>
                <div class="seat_occupied_2">6F</div>
                <div class="seat_occupied">6G</div>
                <div class="seat_occupied">6H</div>
            </div>
            <div class="row">
                <input type="radio" name="seat" value="7A" id="7A" style="display: none;"><label for="7A"><div class="seat" tabindex="1">7A</div></label>
                <input type="radio" name="seat" value="7B" id="7B" style="display: none;"><label for="7B"><div class="seat_2" tabindex="1">7B</div></label>
                <input type="radio" name="seat" value="7C" id="7C" style="display: none;"><label for="7C"><div class="seat" tabindex="1">7C</div></label>
                <input type="radio" name="seat" value="7D" id="7D" style="display: none;"><label for="7D"><div class="seat" tabindex="1">7D</div></label>
                <input type="radio" name="seat" value="7E" id="7E" style="display: none;"><label for="7E"><div class="seat" tabindex="1">7E</div></label>
                <input type="radio" name="seat" value="7F" id="7F" style="display: none;"><label for="7F"><div class="seat_2" tabindex="1">7F</div></label>
                <input type="radio" name="seat" value="7G" id="7G" style="display: none;"><label for="7G"><div class="seat" tabindex="1">7G</div></label>
                <input type="radio" name="seat" value="7H" id="7H" style="display: none;"><label for="7H"><div class="seat" tabindex="1">7H</div></label>
            </div>
            <button style="margin-right:250px"><a href="view_ticket(Aadit).php"style="font-size:15 px"> <i class="fa fa-arrow-left"></i> Go Back</a></button>
            <button style="position:absolute; margin-left: 200px; top:722px;"><input type="submit" value="Proceed To Payment"></button>
        </form>
    </div>
    
    
    
</body>

<?php if(isset($no_seat_selected)==true && $no_seat_selected==true) echo'<h2 style="color : red;" text-align="center">please select one seat</h2>';?>

</html>