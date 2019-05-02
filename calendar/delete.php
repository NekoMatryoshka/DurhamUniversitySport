<?php

//delete.php

if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');
 $query = "
 DELETE from events WHERE id='".$_POST["id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>