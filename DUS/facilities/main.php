<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>DUS - Facility</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


		<script>
		$(document).ready(function(){ 
			
			$('#add').click(function(){
				$('#modal_title').html("Add Facility");
				$('#modal').modal('show');
			});
		
		
			load_data();
    
			function load_data(query)
			{
		
				$.ajax({
					url:"load.php",
					method:"POST",
					data:{query:query},
					success:function(data)
					{
						$('#data').html(data);
					}
				});
		
			}
		
		
		});
		</script>

	</head>

	<body>
	
		<!-- nav1 -->
		<nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color:#742F68">
			<div class="container-fluid">

			<a class="navbar-brand" href="">
				<img src="../public/img/team_durham.png" width="80" height="80" class="d-inline-block align-top" alt="">
			</a>

			<h4 class="navbar-text" style="color:#CB9DCC">DURHAM UNIVERSITY<font color="white"> SPORT</font></h3>

			<a class="pull-right" href="http://dur.ac.uk">
				<img src="../public/img/durham_univ.png" width="126" height="56" alt="">
			</a>

			</div>
		</nav>
		
		<!-- nav2 -->
		<nav class="navbar sticky-top navbar-expand-lg navbar-dark py-0 py-md-0" style="background-color:#2F1F20;">
		
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color:#2F1F20; color:white;">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./matches/main.php">Booking</a>
					</li>

					<li class="nav-item active">
						<a class="nav-link" href="./games/main.php">Facilities</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="./players/main.php">Members</a>
					</li>
				</ul>
			</div>
			
		</nav>
		
		<!-- contents -->
		<div class="container-fluid">
			<h1 class="mt-4">Facilities List</h1>
			
			<!--search bar-->
			<div class="form-row">
    			<div class="form-group col-auto">
      				<div class="input-group">
   		 				<div class="input-group-prepend">
      					<div class="input-group-text" id="btnGroupAddon">Search</div>
    					</div>
    					<input type="text" name="search" id="search" class="form-control" placeholder="Enter text here.." aria-label="Input group example" aria-describedby="btnGroupAddon" maxlength = "20"/>
  					</div>
    			</div>
    			<div class="col-auto">
					<button type="button" name="add" id="add" class="btn btn-success btn-xs">Add Facility</button>
				</div>
  			</div>
			
			<div id="data"></div>
			
		</div>
		
		<!-- footer -->
		<nav class="navbar navbar-dark text-right" style="background-color:#742F68;">
			<div class="col-12">
				<span class="navbar-text text-white">© 2019 DUS - Group9</span>
			</div>
		</nav>
			
			
			
		<!-- modal (insert, update) -->
		
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal_title">Modal Form</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
					<form>
						
						<div class="form-group">
							<label class="col-form-label">Name</label>
							<input type="text" class="form-control" id="name" maxlength="50" placeholder="Facility's name">
						</div>
					
						<div class="form-row">
							<div class="col">
								<label class="col-form-label">Open Time</label>
								<select class="browser-default custom-select" id="open_time">
									<option selected>Click here</option>
									<option value="09:00:00">9:00AM</option>
									<option value="10:00:00">10:00AM</option>
									<option value="11:00:00">11:00AM</option>
									<option value="12:00:00">12:00PM</option>
									<option value="13:00:00">1:00PM</option>
									<option value="14:00:00">2:00PM</option>
									<option value="15:00:00">3:00PM</option>
									<option value="16:00:00">4:00PM</option>
									<option value="17:00:00">5:00PM</option>
									<option value="18:00:00">6:00PM</option>
								</select>
							</div>
							<div class="col">
								<label class="col-form-label">Close Time</label>
								<select class="browser-default custom-select" id="close_time">
									<option selected>Click here</option>
									<option value="09:00:00">9:00AM</option>
									<option value="10:00:00">10:00AM</option>
									<option value="11:00:00">11:00AM</option>
									<option value="12:00:00">12:00PM</option>
									<option value="13:00:00">1:00PM</option>
									<option value="14:00:00">2:00PM</option>
									<option value="15:00:00">3:00PM</option>
									<option value="16:00:00">4:00PM</option>
									<option value="17:00:00">5:00PM</option>
									<option value="18:00:00">6:00PM</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Description</label>
							<textarea class="form-control" id="description" rows="3" maxlength="300"></textarea>
						</div>
						
						<div class="form-row">
							<div class="col">
								<label class="col-form-label">Contact</label>
								<input type="text" class="form-control" id="contact" maxlength="50" placeholder="Email">
							</div>
							<div class="col">
								<label class="col-form-label">Tel</label>
								<input type="text" class="form-control" id="tel" maxlength="20" placeholder="Phone number">
							</div>
						</div>
						
						<div class="form-row">
							<div class="col">
								<label class="col-form-label">Price(£)</label>
								<input type="text" class="form-control" id="Price" maxlength="10" placeholder="">
							</div>
							<div class="col">
								<label class="col-form-label">Image</label>
								<input type="file" class="form-control-file" id="image">
							</div>
						</div>
						
					</form>
					
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="insert">Insert</button>
					</div>
					
				</div>
			</div>
		</div>	
		
		
		<!-- modal (confirmation)-->
		<div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal_title">Modal Form</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="message"></div>	
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					
				</div>
			</div>
		</div>	
		
		
		
	</body>

</html>
