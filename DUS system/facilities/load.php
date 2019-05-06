<?php
include("../DB/DB_Connection.php");

if(isset($_POST["query"]))
{	
	$search = $_POST["query"];
	$query = "
	SELECT * FROM facilities 
	WHERE p_id LIKE '%".$search."%'
	OR password LIKE '%".$search."%'
	OR first_name LIKE '%".$search."%'
	OR last_name LIKE '%".$search."%'
	";
}
else
{
	$query = "SELECT * FROM facilities";	
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
	<table class="table table-striped table-dark text-center">
		<tr>
			<th>Name</th>
			<th>Open</th>
			<th>Close</th>
			<th>Description</th>
			<th>Contact</th>
			<th>Tel</th>
			<th>Price</th>
			<th>Image</th>
		</tr>
	';
		
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td width="10%">'.$row["name"].'</td>
			<td width="10%">'.$row["open_time"].'</td>
			<td width="10%">'.$row["close_time"].'</td>
			<td width="30%">'.$row["description"].'</td>
			<td width="10%">'.$row["contact"].'</td>
			<td width="10%">'.$row["tel"].'</td>
			<td width="10%">'.$row["price"].'</td>
			<td width="10%">'.$row["image"].'</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="8" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>