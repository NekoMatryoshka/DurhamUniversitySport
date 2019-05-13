<?php

//load.php

$connect = new PDO('mysql:host=localhost:80;dbname=testing', 'root', 'root');

$data = array();

$query = "SELECT * FROM events ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["name"],
  'start'   => $row["startTime"],
  'end'   => $row["endTime"]
 );
}

echo json_encode($data);

?>