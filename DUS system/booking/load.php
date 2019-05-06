<?php


require '../DB/DB_Connection.php';

$data = array();

$query = "SELECT * FROM bookings ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["f_id"],
  'title'   => $row["name"],
  'start'   => $row["start_time"],
  'end'   => $row["end_time"]
 );
}

echo json_encode($data);

?>