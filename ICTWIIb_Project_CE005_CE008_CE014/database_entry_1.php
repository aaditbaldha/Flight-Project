<?php

 define('DB_SERVER','localhost');
 define('DB_USERNAME','root');
 define('DB_PASSWORD','');
 define('DB_NAME','flight_project');

 $link=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

 if($link===false)
 {
    echo "it seems some error";
 }





 $sql[0]="INSERT INTO `airport`(`id`,`country`,`city`,`airport`) VALUES('1','India','Mumbai','Chhatrapati Shivaji Airport')";
 $sql[1]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Delhi','Indira Gandhi Airport')";
 $sql[2]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Kolkata','Netaji Subhash Chandra Bose Airport')";
 $sql[3]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Banglore','Kempegowda Airport')";
 $sql[4]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Chennai','Chennai Airport')";
 $sql[5]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Ahemdabad','Sardar Vallabhbhai Patel Airport')";
 $sql[6]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Pune','Pune Airport')";
 $sql[7]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Chandigarh','Chandigarh Airport')";
 $sql[8]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('China','Goa','Goa Airport')";
 $sql[9]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Kochi','Cochin Airport')";
 $sql[10]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('India','Hyderabad','Rajiv Gandhi Airport')";
 $sql[11]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('China','Beiljing','Beiljing Capital Airport')";
$sql[12]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('China','Shanghai','Shanghai Pudong Airport')";
 $sql[13]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('China','Hongkong','Hongkong Airport')";
 $sql[14]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('China','Beiljing','Beiljing Capital Airport')";
 $sql[15]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('South Korea','Seoul','Gimpo Airport')";
  $sql[16]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('South Korea','Busan',' Aimhae Airport')";
$sql[17]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('UAE','Dubai','Dubai Airport')";
$sql[18]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('UAE','Sharjah','Sharjah Airport')";
$sql[19]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('UAE','Abu Dhabi','Abu Dhabi Airport')";
 $sql[20]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Japan','Tokyo','Handela Airport')";
 $sql[21]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Japan','Osaka','Kansai Airport')";
   $sql[22]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Philippines','Manila','Niloy Aquino Airport')";
 $sql[23]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Iran','Teheran','Mehrabad Airport')";
  $sql[24]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Pakistan', 'Islamabad','Chalala Airport')";
 $sql[25]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Srilanka','Colomba','Bandaranaike Airport')";
  $sql[26]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Indonesia','Singapore','Singapore Changi Airport')";
  $sql[27]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Thailand','Bangkok','Suvarnabhumi Airport')";
 $sql[28]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Russia','Moscow','Sheremetyeva Airport')";
  $sql[29]="INSERT INTO `airport`(`country`,`city`,`airport`) VALUES('Bangladesh','Dhaka','Hazrat Shahjahal Airport')";
 for($i=0;$i<30;++$i)
{
    $result=mysqli_query($link,$sql[$i]);
}


?>