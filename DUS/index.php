
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>DUS - Home</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
	$(document).ready(function(){  

		load_data();
		
		function load_data(query)
		{
			$.ajax({
				url:"./home/load.php",
				method:"POST",
				data:{query:query},
				success:function(data)
				{
					$('#card').html(data);
				}
			});
		}
		
		$('#search').keyup(function(){
  			var search = $(this).val();
  			if(search != '')
  			{
   				load_data(search);
  			}
  			else
  			{
   				load_data();
  			}
 		});
		
		
		$('#add').click(function(){
			$('#modal_title').html("Add Facility");
			$('#form')[0].reset();
			$('#action').val('insert');
			$('#submit').val('Insert');
			$('#modal').modal('show');
		});
			
			
		$("#form").on('submit', function(e){
			
			e.preventDefault();
			
			var form = $('form')[0];
       		var data = new FormData(form);
		
			$.ajax({
					url: "./home/action.php",
					method: "POST",
					enctype: 'multipart/form-data',
					data: data,//new FormData(this),
					contentType: false,
					processData:false,		
					success: function(data){
						$('#modal').modal('hide');
						$('#message').html(data);
						$('#confirmation').modal('show');
						load_data();
					}
			});
	
		});
		
		
		
		$(document).on('click', '.delete', function(){
			var id = $(this).attr('id');
			var action = 'delete';
			$.ajax({
					url: "./home/action.php",
					method: "POST",
					data: {id:id, action:action},
					success: function(data){
						$('#message').html(data);
						$('#confirmation').modal('show');
						load_data();
					}
			});
			
		});
		
		$(document).on('click', '.edit', function(){
			var id = $(this).attr('id');
			var action = 'load_form';
			$.ajax({
				url:"./home/action.php",
				method:"POST",
				data:{id:id, action:action},
				dataType:"json",
				success:function(data)
				{		
					
					$('#name').val(data.name);
					$('#open_time').val(data.open_time);
					$('#close_time').val(data.close_time);
					$('#description').val(data.description);
					$('#contact').val(data.contact);
					$('#tel').val(data.tel);
					$('#price').val(data.price);
					
					$('#action').val('update');
					$('#submit').val('Update');
					$("#id").val(id);
					
					$('#modal_title').html("Update Facility");
					$('#modal').modal('show');
				
				}
			});
			
		});
		
	});
  </script>


  </head>

  <body>
   	    <!-- nav1 -->	
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#742F68;">
			<div class="container-fluid">

			<a class="navbar-brand" href="">
				<img src="./public/img/team_durham.png" width="80" height="80" class="d-inline-block align-top" alt="">
			</a>

			<h4 class="navbar-text" style="color:#CB9DCC">DURHAM UNIVERSITY<font color="white"> SPORT</font></h3>

			<a class="pull-right" href="http://dur.ac.uk">
				<img src="./public/img/durham_univ.png" width="126" height="56" alt="">
			</a>
	
			</div>
		</nav>
		
		<!-- nav2 -->	
		<nav class="navbar navbar-expand-lg navbar-dark py-0 py-md-0" style="background-color:#2F1F20;">
	
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color:#2F1F20; color:white;">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./booking/main.php">Booking</a>
					</li>
	
					<li class="nav-item">
						<a class="nav-link" href="./facilities/main.php">Facilities</a>
					</li>
	
					<li class="nav-item">
						<a class="nav-link" href="./players/main.php">Members</a>
					</li>
		
				</ul>
			</div>
		</nav>
	
		<!-- contents -->		
		<div class="container-fluid">

			<h1 class="mt-4">Our Facilities</h1>
				
			<!--search bar-->
			<div class="form-row">
    			<div class="form-group col-auto">
      				<div class="input-group">
   		 				<div class="input-group-prepend">
      						<div class="input-group-text" style="background-color:#742F68; color:white;">Search</div>
    					</div>
    					<input type="text" id="search" class="form-control" placeholder="Enter text here.." maxlength="20"/>
  					</div>
    			</div>
    			<div class="col-auto">
					<button type="button" id="add" class="btn btn-xs" style="background-color:#742F68; color:white;">Add New Facility</button>
				</div>
  			</div>

			<!-- cards -->
			<div id="card">
			</div>
			<!-- cards end -->	
			
			 <!-- modal -->
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
						
							<form method="post" id="form">
						
								<div class="form-group">
									<input type="hidden" name="id" id="id">
									<label class="col-form-label">Name</label>
									<input type="text" class="form-control" id="name" name="name" maxlength="50" placeholder="Facility's name">
								</div>
					
								<div class="form-row">
									<div class="col">
										<label class="col-form-label">Open Time</label>
										<select class="browser-default custom-select" id="open_time" name="open_time">
											<option selected>Click here</option>
											<option value="09:00">9:00</option>
											<option value="10:00">10:00</option>
											<option value="11:00">11:00</option>
											<option value="12:00">12:00</option>
											<option value="13:00">13:00</option>
											<option value="14:00">14:00</option>
											<option value="15:00">15:00</option>
											<option value="16:00">16:00</option>
											<option value="17:00">17:00</option>
											<option value="18:00">18:00</option>
										</select>
									</div>
									<div class="col">
										<label class="col-form-label">Close Time</label>
										<select class="browser-default custom-select" id="close_time" name="close_time">
											<option selected>Click here</option>
											<option value="09:00">9:00</option>
											<option value="10:00">10:00</option>
											<option value="11:00">11:00</option>
											<option value="12:00">12:00</option>
											<option value="13:00">13:00</option>
											<option value="14:00">14:00</option>
											<option value="15:00">15:00</option>
											<option value="16:00">16:00</option>
											<option value="17:00">17:00</option>
											<option value="18:00">18:00</option>
										</select>
									</div>
								</div>
						
								<div class="form-group">
									<label class="col-form-label">Description</label>
									<textarea class="form-control" id="description" name="description" rows="3" maxlength="300" placeholder="Explanation of facility"></textarea>
								</div>
						
								<div class="form-row">
									<div class="col">
										<label class="col-form-label">Contact</label>
										<input type="text" class="form-control" id="contact" name="contact" maxlength="50" placeholder="Email">
									</div>
									<div class="col">
										<label class="col-form-label">Tel</label>
										<input type="text" class="form-control" id="tel" name="tel" maxlength="20" placeholder="Phone number">
									</div>
								</div>
						
								<div class="form-row">
									<div class="col">
										<label class="col-form-label">Price(£) per hour</label>
										<input type="text" class="form-control" id="price" name="price" maxlength="10" placeholder="number">
									</div>
									<div class="col">
										<label class="col-form-label">Image</label>
										<input type="file" class="form-control-file" id="file" name="file">
									</div>
								</div>
								<br>
								<div class="modal-footer">
									<input type="hidden" name="action" id="action" value="insert"/>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit"/>
								</div>
							
							</form>
						</div>
					</div>
				</div>
			</div>	
		
		
		
			<!-- modal (confirmation)-->
			<div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal_title">Confirmation</h5>
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
		
		
		</div>
		<!-- contents end -->
	    
	    <!-- footer -->
		<nav class="navbar navbar-dark text-right" style="background-color:#742F68;">
			<div class="col-12">
				<span class="navbar-text text-white">© 2019 DUS - Group9</span>
			</div>
		</nav>

	   
		
  </body>

</html>