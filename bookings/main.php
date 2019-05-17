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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
        <link rel="stylesheet" type="text/css" href="../public/css/style.css"/>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>


		<script>
  
		$(document).ready(function(){  	
				
			var cdate, open_time, close_time;
      		
			$('#facility').on('change',function(){				
				var f_value = $(this).val();
				var f_text = $("#facility option:selected").text();
				$('#f_id').val(f_value);
				$('#f_name').val(f_text);
				$('#f_dname').val(f_text);
				$('#calendar').fullCalendar('rerenderEvents');		
      		  	 
				if(f_value =="all"){
					$('#calendar').fullCalendar('option', 'minTime', '06:00');
					$('#calendar').fullCalendar('option', 'maxTime', '24:00');
					$('#calendar').fullCalendar('option','slotDuration',"00:30:00");
					calendar.fullCalendar('refetchEvents');
				}
				else
				{
					 $.ajax({
						url:"time.php",
						method:"POST",
						data:{f_id:f_value},
						dataType:"json",
						success:function(data)
						{				
							$('#calendar').fullCalendar('option', 'minTime', data.open_time);
							$('#calendar').fullCalendar('option', 'maxTime', data.close_time);
							$('#capacity').val(data.capacity);
							$('#duration').val(data.duration);
							$('#calendar').fullCalendar('option','slotDuration',data.duration);
							calendar.fullCalendar('refetchEvents');
						}	
					});
				}      
  			 });
  			
  			 
			var calendar = $('#calendar').fullCalendar({
			
				header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
				},
				height: 700,
				selectable:true,
				selectConstraint: 
				{
        			start: $.fullCalendar.moment().subtract(1, 'days'),
        			end: $.fullCalendar.moment().startOf('month').add(3, 'month')
   				},
				eventLimit: true,
				slotDuration : '00:30:00',
				eventStartEditable : true,
				slotEventOverlap : false,
				scrollTime: '09:00:00',
				events: {
					url: 'load.php',
					type: 'POST',
					data: {session_id:$("#session_id").val()}
				},
				
				eventRender: function eventRender( event, element, view ) {
					if(view.name == 'month')
   					{                       
						element.find('.fc-title').append('<div style="text-align:center;"><span style="font-size:10px; text-align:center;">'+event.f_name+'</span></div>');
					}
        			return ['all', event.f_id].indexOf($('#facility').val()) >= 0;
    			},
    			
				eventAfterRender: function(event, element, view) {
					if (view.name == "agendaDay")
					{
						$(element).css('width','90px');
					}
				},
				
				selectAllow: function(selectInfo) { 
						var hour = $('#duration').val();
						var decimal_hour = moment.duration(hour).asHours();
						var duration = moment.duration(selectInfo.end.diff(selectInfo.start));			
						return duration.asHours() <= decimal_hour;	
				},
				
				select: function(start, end, allDay)
				{
					$("#start_time").val($.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss"));
					$("#end_time").val($.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss"));
									
						if($('#facility').val() == "all")
						{
							alert("Please select the facility");
						} 
						else
						{
						
							if($("#session_type").val() == "user")
							{
								if(confirm("Are you sure you want to book?"))
								{
									var m_id = '<?php echo $_SESSION['id']?>';
									var m_name = '<?php echo $_SESSION['m_id']?>';
									var f_id = $("#facility").val();
									var f_name = $("#facility option:selected").text();
									var start_time = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
									var end_time = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
									var capacity = $('#capacity').val();
									var type = $('#session_type').val();
		
									$.ajax({  
										url:"insert.php",  
										method:"POST",  
										data:{
											m_id:m_id,
											m_name:m_name,
											f_id:f_id,
											f_name:f_name,
											capacity:capacity,
											date:cdate,
											start_time:start_time,
											end_time:end_time,
											type:type
										},  
										success:function(data)  
										{  
											alert(data);
											calendar.fullCalendar('refetchEvents');
										}    	
									}); 
								}			
							}
							else
							{
								$('#modal_admin').modal('show');
				
							}
						}		
    				
				},
				
				dayClick: function(date, jsEvent, view)
				{
					cdate = date.format();
					$('#calendar').fullCalendar('changeView', 'agendaDay');
					$('#calendar').fullCalendar('gotoDate',cdate);
				},
				
				eventClick:function(event)
				{
					var id = $("#session_id").val()
					var type = $("#session_type").val()
					if(id == event.title || type == "admin"){
						if(confirm("Are you sure you want to remove it?"))
						{
							var e_id = event.id;
							$.ajax({
								   url:"delete.php",
								   type:"POST",
								   data:{id:e_id},
								   success:function()
								   {
								   calendar.fullCalendar('refetchEvents');
								   }
							});
						}
					}
					else
					{
						alert("You can't delete other user's booking");
					}
	
				}
				
			});		
			
						
			$('#submit').click(function(){
				
				var m_id = $("#member").val();
				var m_name = $("#member option:selected").text();
				var f_id = $("#facility").val();
				var f_name = $("#facility option:selected").text();
				var start_time = $("#start_time").val();
				var end_time = $("#end_time").val();
				var capacity = $('#capacity').val();
				var type = $('#session_type').val();
				$.ajax({  
					url:"insert.php",  
					method:"POST",  
					data:{
						m_id:m_id,
						m_name:m_name,
						f_id:f_id,
						f_name:f_name,
						capacity:capacity,
						date:cdate,
						start_time:start_time,
						end_time:end_time,
						type:type
					},  
					success:function(data)  
					{  
						alert(data);
						calendar.fullCalendar('refetchEvents');
						$('#modal_admin').modal('hide')
					}    	
				}); 		
			});
		});
		</script>

	</head>

  	<body>
  	<!-- nav1 -->
  		<?php echo "<input type='hidden' name ='start_time' id='start_time' value=''/>"; ?>
  		<?php echo "<input type='hidden' name ='end_time' id='end_time' value=''/>"; ?>
  		<?php echo "<input type='hidden' name ='session_type' id='session_type' value='".$_SESSION["type"]."'/>"; ?>
   	 	<?php echo "<input type='hidden' name ='session_id' id='session_id' value='".$_SESSION["m_id"]."'/>"; ?>
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#742F68">
			<div class="container-fluid">

			<a class="navbar-brand" href="">
				<img src="../public/img/team_durham.png" width="80" height="80" class="d-inline-block align-top" alt="">
			</a>

			<h3 class="navbar-text" style="color:#CB9DCC">DURHAM UNIVERSITY<font color="white"> SPORT</font></h3>

			<a class="pull-right" href="http://dur.ac.uk">
				<img src="../public/img/durham_univ.png" width="126" height="56" class="pull-right-img" alt="">
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
						<?php 
        				if(!isset($_SESSION["type"]) || $_SESSION["type"] == "user" )
						{?>
							<a class="nav-link" href="../members/main.php">My Info</a>
						<?php 
						}	
						else
						{
						?>	
							<a class="nav-link" href="../members/main.php">Members</a>
						<?php 
						}
						?>
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
			  		<?php 
			  		} 
					else
					{?>
					
					<li class="nav-item">
						<?php echo "<span class='navbar-text' style='color:white'> ID: ".$_SESSION["m_id"]." Type: ".$_SESSION["type"]."&nbsp;&nbsp;</span>"; ?>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../login/logout.php" style='color:white'>Logout</a>
					</li>
			  		<?php 
			  		}
			  		?>
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
    					<?php require 'dropdown_facilitylist.php';?>
  					</div>
    			</div>
  			</div>

			<!-- calendar -->
			<input type="hidden" id="capacity">
			<input type="hidden" id="duration">
			<div id="calendar"></div><br>
			
			<!-- modal -->
			<div class="modal fade" id="modal_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal_title">Booking</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<label class="col-form-label">Member List</label>
							<?php require 'dropdown_memberlist.php';?>	
						</div>
					
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" id="submit" class="btn btn-primary">Submit</button>
						</div>
					
					</div>
				</div>
			</div>	

		</div>
		<!-- contents end -->
		
		<!-- footer -->
		<nav class="navbar navbar-dark text-right" style="background-color:#742F68;">
			<div class="col-12">
				<span class="navbar-text text-white">� 2019 DUS - Group9</span>
			</div>
		</nav>
		
  	</body>

</html>
