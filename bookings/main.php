<?php
session_start();
if(!isset($_SESSION["id"]))
{
	echo "<script type='text/javascript'>alert('Please login');
		 window.location='/DUS/index.php';
		 </script>";
}
?>

<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>DUS - Booking</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>	


		<script>
  
		$(document).ready(function(){  	
				
			var cdate, f_text;
      	
			$('#facility').on('change',function(){
        		 var f_value = $(this).val();
       			 var f_text = $("#facility option:selected").text();
      		    
      		  	 $('#f_id').val(f_value);
      		     $('#f_name').val(f_text);
      		     $('#f_dname').val(f_text);
      		     $('#calendar').fullCalendar('rerenderEvents');		     
  			 });
				
			// calendar
			
			var calendar = $('#calendar').fullCalendar({
				
				header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
				},
				
				navLinks: true,
				eventLimit: true,
				events: 'load.php',
				
				eventRender: function eventRender( event, element, view ) {
        			return ['all', event.f_id].indexOf($('#facility').val()) >= 0;
    			},
				
				dayClick: function(date, jsEvent, view)
				{
				
					if($('#facility').val() == "all"){
						alert("Please select the facility");
					} 
					else
					{
						$('#modal').modal('show');
						$('#date').val(date.format());
						var id = '<?php echo $_SESSION['id']?>';
						$('#name').val(id);
						$('#m_id').val(id);
						cdate = date.format();			 
					}
				},
				
				eventClick:function(event)
				{
					if(confirm("Are you sure you want to remove it?"))
					{
						var id = event.id;
						$.ajax({
							url:"delete.php",
							type:"POST",
							data:{id:id},
							success:function()
							{
								calendar.fullCalendar('refetchEvents');
							}
						});
					}
				},
				
				
			});			
			//end calendar
			
			//modal
			$('#bookButton').click(function(e){
			    e.preventDefault();
			    
				var name = $('#name').val(); 
				var f_id = $('#f_id').val();
				var f_name = $('#f_name').val();
				var start_time = cdate +" "+$('#start_time').val();
				var end_time = cdate +" "+ $('#end_time').val();

				$.ajax({  
            		url:"insert.php",  
    	   	   	 	method:"POST",  
                	data:{
                		name:name,
                		f_id:f_id,
                		f_name:f_name,
               		 	start_time:start_time,
                		end_time:end_time
                	},  
                	success:function(data)  
                	{  
                		$('#modal').modal('hide');
                		calendar.fullCalendar('refetchEvents');
                	}    	
            	}); 			
			
			
			});
		
		});
		</script>

	</head>

  	<body>
  	<!-- nav1 -->
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#742F68">
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
		<nav class="navbar navbar-expand-lg navbar-dark py-0 py-md-0" style="background-color:#2F1F20;">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color:#2F1F20; color:white;">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="">Bookings</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="../members/main.php">Members</a>
					</li>
				</ul>
				<ul class="navbar-nav navbar-right">
        			
        			<?php 
        			if(!isset($_SESSION["type"]))
					{?>
        			<li class="nav-item">
						<button type="button" id="sign_in" class="btn btn-xs" style="background-color:#2F1F20; color:white;">Login</button>
					</li>
					<li class="nav-item">
						<button type="button" id="sign_up" class="btn btn-xs" style="background-color:#2F1F20; color:white;">Sign Up</button>
					</li>
			  <?php } 
					else
					{?>
					
					<li class="nav-item">
						<?php echo "<span class='navbar-text' style='color:white'> ID: ".$_SESSION["id"]." Type: ".$_SESSION["type"]."&nbsp;&nbsp;</span>"; ?>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../login/logout.php" style='color:white'>Logout</a>
					</li>
			  <?php }?>
     			</ul>				
			</div>
		</nav>
		
		<!-- contents -->		
		<div class="container-fluid">

			<h1 class="mt-4">Bookings</h1>
			<br>
				
			<!--search bar-->
			<div class="form-row">
    			<div class="form-group col-auto">
      				<div class="input-group">
   		 				<div class="input-group-prepend">
      						<div class="input-group-text" style="background-color:#742F68; color:white;">Facility</div>
    					</div>
    					<?php require 'dropdown.php';?>
  					</div>
    			</div>
  			</div>

			<!-- calendar -->
			<div id="calendar"></div><br>
			
			<!-- modal -->
			<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">New message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<form>
					  <div class="form-group">
						<label class="col-form-label">Date</label>
						<input type="text" class="form-control" id="date" disabled>
					  </div>
					  <div class="form-group">
						<label class="col-form-label">ID</label>
						<input type="hidden" class="form-control" id="name" name="name">
						<input type="text" class="form-control" id="m_id" name="m_id" disabled>  
					  </div>
					  <div class="form-group">
						<label class="col-form-label">Facility</label>
						<input type="hidden" class="form-control" id="f_id" name="f_id">
						<input type="hidden" class="form-control" id="f_name" name="f_name">
						<input type="text" class="form-control" id="f_dname" name="f_dname" disabled>
					  </div>
					  <div class="form-group">
						<label class="col-form-label">Start Time</label>
							<select class="browser-default custom-select" id="start_time" name="start_time">
							<option selected>Start Time</option>
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
					  <div class="form-group">
						<label class="col-form-label">End Time</label>
							<select class="browser-default custom-select" id="end_time" name="end_time">
							<option selected>End Time</option>
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
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="bookButton" name="bookButton">Book</button>
				  </div>
				</div>
			  </div>
			</div>
			<!-- modal end-->
			
			
			
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
