<?php

require '../DB/DB_Connection.php';

if(isset($_POST["id"]))
{

	$query = "
	DELETE from blocks WHERE id='".$_POST["id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();
    echo $query;
}

?>