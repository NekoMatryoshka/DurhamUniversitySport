<?php

//database_connection.php


$mysql_hostname = 'localhost';  // database host
$mysql_port = 8889;
$mysql_username = 'root';				//database username
$mysql_password = 'root';				//database password
$mysql_dbname = 'DUS';			//database username
$connect = new PDO("mysql:host=$mysql_hostname;port=$mysql_port;dbname=$mysql_dbname", $mysql_username, $mysql_password);


//$connect = new PDO("mysql:host=localhost;dbname=DUS", "root", "");

?>