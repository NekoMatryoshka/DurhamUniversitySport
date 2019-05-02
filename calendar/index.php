
<!DOCTYPE html>
<html>
	<head>
		
		
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
	    
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
	  
  		<script>

   
		$(document).ready(function() {
		
			var cdate;
			
			var calendar = $('#calendar').fullCalendar({
				header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
				},
				
				navLinks: true,
				
				eventLimit: true,
				events: 'load.php',
				
				dayClick: function(date, jsEvent, view)
				{
					$('#Modal').modal('show');
					$('#date').val(date.format());
					cdate = date.format();			 
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
			
			$('#bookButton').click(function(e){
			    e.preventDefault();
				var name = $('#name').val(); 
				var startTime = cdate +" "+$('#startTime').val();
				var endTime = cdate +" "+ $('#endTime').val();

				$.ajax({  
            		url:"insert.php",  
    	   	   	 	method:"POST",  
                	data:{
                		name:name,
               		 	startTime:startTime,
                		endTime:endTime
                	},  
                	success:function(data)  
                	{  
                		$('#Modal').modal('hide');
                		calendar.fullCalendar('refetchEvents');
                	}    	
            	}); 			
			});
			
		});
	
		</script>
	</head>	
	<body>
		<h1 align="center">Calendar System</h1>
		<div class="container">
			<div id="calendar"></div>
		</div>
		
		<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<label class="col-form-label">name</label>
					<input type="text" class="form-control" id="name" name="name">
				  </div>
				  <div class="form-group">
				  	<label class="col-form-label">Start Time</label>
						<select class="browser-default custom-select" id="startTime" name="startTime">
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
						<select class="browser-default custom-select" id="endTime" name="endTime">
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
	
	</body>
</html>
