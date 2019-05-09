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
	$query = "SELECT * FROM members";	
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
	<table class="table table-striped table-dark text-center">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Password</th>
			<th>Email</th>
			<th>Tel</th>
			<th>Action</th>
		</tr>
	';
		
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td width="15%">'.$row["m_id"].'</td>
			<td width="20%">'.$row["name"].'</td>
			<td width="10%"> *Secret Info* </td>
			<td width="20%">'.$row["email"].'</td>
			<td width="15%">'.$row["tel"].'</td>
			<td width="20%">
				<button type="button" name="edit" class="btn btn-outline-primary edit" id="'.$row["id"].'">Edit</button>
				<button type="button" name="delete" class="btn btn-outline-danger delete" id="'.$row["id"].'">Del</button>
			</td>
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
