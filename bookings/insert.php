<?php

//insert.php

require '../DB/DB_Connection.php';

if(isset($_POST["m_id"]))
{
 $query = "
 INSERT INTO bookings 
 (m_id, m_name, f_id, f_name, start_time, end_time) 
 VALUES ('".$_POST["m_id"]."', '".$_POST["m_name"]."', '".$_POST["f_id"]."', '".$_POST["f_name"]."', '".$_POST["start_time"]."', '".$_POST["end_time"]."')
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>