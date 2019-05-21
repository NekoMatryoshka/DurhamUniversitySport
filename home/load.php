
<?php

include("../DB/DB_Connection.php");

if(isset($_POST["query"]))
{	
	$search = $_POST["query"];
	$query = "
	SELECT id, name, TIME_FORMAT(open_time, '%H:%i') as open_time, TIME_FORMAT(close_time, '%H:%i') as close_time, contact, price, description, image, tel
	FROM facilities 
	WHERE name LIKE '%".$search."%'
	OR open_time LIKE '%".$search."%'
	OR close_time LIKE '%".$search."%'
	OR description LIKE '%".$search."%'
	OR price LIKE '%".$search."%'
	OR contact LIKE '%".$search."%'
	OR tel LIKE '%".$search."%'
	OR price LIKE '%".$search."%'
	";
}
else
{
	$query = "SELECT id, name, TIME_FORMAT(open_time, '%H:%i') as open_time, TIME_FORMAT(close_time, '%H:%i') as close_time, contact, price, description, image, tel
	 FROM facilities ";	
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();

$output = '<div class="card-columns">';
		
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
			<div class="card text-center">
				<img class="card-img-top" src="'.$row["image"].'" height="250">
				<div class="card-body">
					<h5 class="card-title">'.$row["name"].'</h5>
					<p class="card-text">'.$row["description"].'</p>
				</div>	
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><b>Opening Times: </b>'.$row["open_time"].' - '.$row["close_time"].'</li>
					<li class="list-group-item"><b>Contact: </b>'.$row["contact"].'</li>
					<li class="list-group-item"><b>Tel: </b>'.$row["tel"].'</li>
					<li class="list-group-item"><b>Price: </b>£'.$row["price"].' per session</li>
				</ul>';
			
		if (isset($_POST["session"]) && $_POST["session"] == "admin"){
			$output .= '
				<div class="card-footer">
					<button type="button" name="edit" class="btn btn-outline-primary edit" id="'.$row["id"].'">Edit</button>
					<button type="button" name="delete" class="btn btn-outline-danger delete" id="'.$row["id"].'">Del</button>
				</div>
			</div>';
		}
		else
		{
			$output .= '
				<div class="card-footer">
					<a href="./bookings/main.php" type="button" class="btn btn-xs">Booking</a>
				</div>
			</div>';
		}
		
		
	}
}
else
{
	$output .= '
	<h2>Not found</h2>
	
	';
}
$output .= '</div>';
echo $output;
?>

