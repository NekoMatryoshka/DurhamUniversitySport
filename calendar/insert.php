<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');

if(isset($_POST["name"]))
{
 $query = "
 INSERT INTO events 
 (name, startTime, endTime) 
 VALUES ('".$_POST["name"]."', '".$_POST["startTime"]."', '".$_POST["endTime"]."')
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}


?>