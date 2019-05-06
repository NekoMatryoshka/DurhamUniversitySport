<?php

//insert.php

require '../DB/DB_Connection.php';

if(isset($_POST["name"]))
{
 
 $f_id = explode('|',$_POST['f_id']);
 
 $query = "
 INSERT INTO bookings 
 (name, f_id, f_name, start_time, end_time) 
 VALUES ('".$_POST["name"]."', '".$f_id[0]."', '".$f_id[1]."', '".$_POST["start_time"]."', '".$_POST["end_time"]."')
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}



?>