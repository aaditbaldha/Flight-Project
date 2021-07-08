<?php

$server_name="localhost";
$user_name="root";
$password="";

$con=mysqli_connect($server_name,$user_name,$password);

$sql[0]="INSERT INTO `flight_project`.`airport` (`id`,`country`,`city`,`airport`) VALUES ('61','United States','Atlanta','Hartsfield–Jackson Atlanta Airport') ";
$sql[1]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Los Angeles','Los Angeles Airport') ";
$sql[2]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Denver','Denver Airport') ";
$sql[3]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','New York','John F. Kennedy Airport') ";
$sql[4]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','San Francisco','San Francisco Airport') ";
$sql[5]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Orlando','Orlando Airport') ";
$sql[6]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Miami','Miami Airport') ";
$sql[7]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Minneapolis','Minneapolis–Saint Paul Airport') ";
$sql[8]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Detroit','Detroit Metropolitan Airport') ";
$sql[9]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Philadelphia','Philadelphia Airport') ";
$sql[10]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','San Diego','San Diego Airport') ";
$sql[11]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Kansas City','Kansas City Airport') ";
$sql[12]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Calgary','Calgary Airport') ";
$sql[13]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Nashville','Nashville Airport') ";
$sql[14]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Portland','Portland Airport') ";
$sql[15]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('United States','Oakland','Oakland Airport') ";
$sql[16]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Canada','Toronto','Toronto Pearson Airport') ";
$sql[17]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Canada','Vancouver','Vancouver Airport') ";
$sql[18]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Canada','Calgary','Calgary Airport') ";
$sql[19]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Canada','Montreal','Montreal-Trudeau Airport') ";
$sql[20]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Colombia','Bogota','El Dorado Airport') ";
$sql[21]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Brazil','Rio de Janerio','Rio de Janerio-Galeao Airport') ";
$sql[22]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Brazil','Sau Paulo','Sau Paulo-Guarulhos Airport') ";
$sql[23]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Brazil','Sau Paulo','Sao Paulo-Congonhas Airport') ";
$sql[24]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Brazil','Brasilia','Brasilia Airport') ";
$sql[25]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Brazil','Belo Horizonte','Tancredo Neves Airport') ";
$sql[26]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Peru','Lima','Jorge Chavez Airport') ";
$sql[27]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Chile','Santiago','Arturo Merino Benitez Airport') ";
$sql[28]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Argentina','Buenos Aires','Jeorge Newbery Airport') ";
$sql[29]="INSERT INTO `flight_project`.`airport` (`country`,`city`,`airport`) VALUES ('Venezuela','Caracas','Simon Bolivar Airport') ";

for($i=0;$i<30;++$i)
{
    $result=mysqli_query($con,$sql[$i]);
}
?>