<?php

require '../DB/DB_Connection.php';
session_start();

$username = $_SESSION["m_id"];
$query = "SELECT * FROM members WHERE m_id = '$username'";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetch();
$m_id = $result['id'];

$name = $_POST["name"];
$f_id = $_POST["f_id"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$dow = $_POST["dow"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];

$query = "
INSERT INTO `blocks` (`name`, `f_id`, `m_id`, `start_time`, `end_time`, `start_date`, `end_date`, `dow`) 
VALUES ('$name', '$f_id', '$m_id', '$start_time', '$end_time', '$start_date', '$end_date', '$dow')
";
$statement = $connect->prepare($query);
$statement->execute();

echo 'New block booking is inserted.';
?>