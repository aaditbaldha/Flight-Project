<?php
$server="localhost";
$user="root";
$password="";
$db_name="flight_project";

$connected=mysqli_connect($server,$user,$password,$db_name);

if($connected)
{
	echo "You are connected";
}

$query="

INSERT INTO airport(id,country, city, airport) VALUES ('31','Albania','Tirana','Tirana Airport');
INSERT INTO airport(country, city, airport) VALUES ('Austria','Vienna','Vienna Airport');
INSERT INTO airport(country, city, airport) VALUES ('Belgium','Brussels','Brussels Airport');
INSERT INTO airport(country, city, airport) VALUES ('Finland','Helsinki','Helsinki Airport');
INSERT INTO airport(country, city, airport) VALUES ('Switzerland','Zurich','Zurich Airport');
INSERT INTO airport(country, city, airport) VALUES ('Denmark','Copenhagen','Copenhagen Airport');
INSERT INTO airport(country, city, airport) VALUES ('France','Paris','Charles de Gaulle Airport');
INSERT INTO airport(country, city, airport) VALUES ('Greece','Athens','Athens Airport');
INSERT INTO airport(country, city, airport) VALUES ('Iceland','Reykjavik','Keflavik Airport');
INSERT INTO airport(country, city, airport) VALUES ('Ireland','Dublin','Dublin Airport');
INSERT INTO airport(country, city, airport) VALUES ('Italy','Rome','Leonardo da Vinci-Fiumicino Airport');
INSERT INTO airport(country, city, airport) VALUES ('Netherlands','Amsterdam','Amsterdam Airport');
INSERT INTO airport(country, city, airport) VALUES ('Norway','Oslo','Oslo Airport');
INSERT INTO airport(country, city, airport) VALUES ('Poland','Warsaw','Warsaw Chopin Airport');
INSERT INTO airport(country, city, airport) VALUES ('Sweden','Stockholm','Stockholm Arlanda Airport');
INSERT INTO airport(country, city, airport) VALUES ('Turkey','Istanbul','Istanbul Airport');
INSERT INTO airport(country, city, airport) VALUES ('Ukraine','Kyiv','Boryspil Airport');
INSERT INTO airport(country, city, airport) VALUES ('Spain','Madrid','Madrid Airport');
INSERT INTO airport(country, city, airport) VALUES ('Latvia','Riga','Riga Airport');
INSERT INTO airport(country, city, airport) VALUES ('Belarus','Minsk','Minsk Airport');
INSERT INTO airport(country, city, airport) VALUES ('Malta','Malta','Malta Airport');
INSERT INTO airport(country, city, airport) VALUES ('Australia','Sydney','Sydney Airport');
INSERT INTO airport(country, city, airport) VALUES ('Kenya','Nairobi','Nairobi Airport');
INSERT INTO airport(country, city, airport) VALUES ('Morocco','Agadir','Agadir Airport');
INSERT INTO airport(country, city, airport) VALUES ('South Africa','Cape Town','Cape Town Airport');
INSERT INTO airport(country, city, airport) VALUES ('Egypt','Cairo','Cairo Airport');
INSERT INTO airport(country, city, airport) VALUES ('Mauritius','Port Louis','Louis Airport');
INSERT INTO airport(country, city, airport) VALUES ('Tanzania','Dar Es Salaam','Dar Es Salaam Airport');
INSERT INTO airport(country, city, airport) VALUES ('Nigeria','Abuja','Abuja Airport');
INSERT INTO airport(country, city, airport) VALUES ('Tunisia','Tunis','Tunis Airport');




";

$result=mysqli_multi_query($connected,$query);

if($result)
{
	echo "Data Inserted";
}


?>