<?php
session_start();
if(!isset($_SESSION["id"]))
{
	echo "<script type='text/javascript'>alert('Please login');
		 window.location='/DUS/index.php';
		 </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DUS - Members</title>
    <script src="../public/js/validation.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {

        $('#add').click(function() {
            $('#modal_title').html("Add Member");
            $('#form')[0].reset();
            $('#action').val('insert');
            $('#submit').val('Insert');
            $('#modal').modal('show');
        });


        load_data();

        function load_data(query) {

            var session_type = $("#session_type").val();
				var session_id = $("#session_id").val();
				
				$.ajax({
					url:"load.php",
					method:"POST",
					data:{
						query:query, 
						session_type:session_type, 
						session_id:session_id
					},
					success:function(data)
					{
						$('#data').html(data);
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

        //Add new member
        $("#form").on('submit', function(e) {
            e.preventDefault();

            var id = $('#m_id').val();
            var password = $('#password').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var tel = $('#tel').val();

            validationPass(["#m_id", "#password", "#name", "#email",
                "#tel"
            ]); // Clear validation

            if (id.length <= 0) {
                validationMessage('#m_id', "Please enter a valid id.")
                return;

            } else if (password.length <= 0) {
                validationMessage('#password', "Please enter a valid password.")
                return;

            } else if (name.length <= 0) {
                validationMessage('#name', "Please enter a valid name.")
                return;

            } else if (email.length <= 0 || !isEmail(email)) {
                validationMessage('#email', "Please enter a valid email email.")
                return;

            } else if (tel.length <= 0) {
                validationMessage('#tel', "Please enter a valid tel number.")
                return;
            }



            var form = $('form')[0];
            var data = new FormData(form);

            $.ajax({
                url: "action.php",
                method: "POST",
                enctype: 'multipart/form-data',
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal').modal('hide');
                    $('#message').html(data);
                    $('#confirmation').modal('show');
                    load_data();
                }
            });

        });

        //add new member

        //delete
        $(document).on('click', '.delete', function() {
            var session_type = $("#session_type").val();
            if(confirm("Are you sure you want to delete this account?"))
            {
                var id = $(this).attr('id');
                var action = 'delete';
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        id: id,
                        action: action
                    },
                    success: function(data) {
                        $('#message').html(data);
                        $('#confirmation').modal('show');
                        load_data();
                    }
                });
                if(session_type == "user"){
                        window.location.href= "/DUS/login/logout.php";
                }
                return true;
            } 
            else 
            {
            return false;
            }
        });


        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            var action = 'load_form';
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    id: id,
                    action: action
                },
                dataType: "json",
                success: function(data) {

                    $("#id").val(id);
                    $('#m_id').val(data.m_id);
                    $('#password').val("");
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#tel').val(data.tel);

                    $('#action').val('update');
                    $('#submit').val('Update');

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
    <?php echo "<input type='hidden' name ='session_type' id='session_type' value='".$_SESSION["type"]."'/>"; ?>
	<?php echo "<input type='hidden' name ='session_id' id='session_id' value='".$_SESSION["id"]."'/>"; ?>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color:#742F68">
        <div class="container-fluid">

            <a class="navbar-brand" href="">
                <img src="../public/img/team_durham.png" width="80" height="80" class="d-inline-block align-top" alt="">
            </a>

            <h4 class="navbar-text" style="color:#CB9DCC">DURHAM UNIVERSITY<font color="white"> SPORT</font>
                </h3>

                <a class="pull-right" href="http://dur.ac.uk">
                    <img src="../public/img/durham_univ.png" width="126" height="56" alt="">
                </a>

        </div>
    </nav>

    <!-- nav2 -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark py-0 py-md-0" style="background-color:#2F1F20;">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent"
            style="background-color:#2F1F20; color:white;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../bookings/main.php">Bookings</a>
                </li>
                <li class="nav-item active">
                    	<?php 
        				if(!isset($_SESSION["type"]) || $_SESSION["type"] == "user" )
						{?>
							<a class="nav-link" href="./members/main.php">My Info</a>
						<?php 
						}	
						else
						{
						?>	
							<a class="nav-link" href="./members/main.php">Members</a>
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
                    <button type="button" id="sign_in" class="btn btn-xs"
                        style="background-color:#2F1F20; color:white;">Login</button>
                </li>
                <li class="nav-item">
                    <button type="button" id="sign_up" class="btn btn-xs"
                        style="background-color:#2F1F20; color:white;">Sign Up</button>
                </li>
                <?php } 
					else
					{?>

                <li class="nav-item">
                    <?php echo "<span class='navbar-text' style='color:white'> ID: ".$_SESSION["m_id"]." Type: ".$_SESSION["type"]."&nbsp;&nbsp;</span>"; ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/logout.php" style='color:white'>Logout</a>
                </li>
                <?php }?>
            </ul>
        </div>

    </nav>

    <!-- contents -->
        <?php 
        if($_SESSION["type"] == "admin")
		{?>
		<div class="container-fluid">
			<h1 class="mt-4">Members List</h1>
			<br>
			
			<!--search bar-->
			<div class="form-row">
    			<div class="form-group col-auto">
      				<div class="input-group">
   		 				<div class="input-group-prepend">
      					<div class="input-group-text" id="btnGroupAddon" style="background-color:#742F68; color:white;">Search</div>
    					</div>
    					<input type="text" name="search" id="search" class="form-control" placeholder="Enter text here.." aria-label="Input group example" aria-describedby="btnGroupAddon" maxlength = "20"/>
  					</div>
    			</div>
    			<div class="col-auto">
					<button type="button" name="add" id="add" class="btn btn-xs" style="background-color:#742F68; color:white;">Add Member</button>
				</div>
  			</div>
		<?php 
		} 
		else 
		{ 
        ?>
		 <div class="container-fluid">
			<h1 class="mt-4">My Info</h1>
			<br>
		 <?php 
         } 
         ?>
         
        <div id="data"></div>

        <!-- modal (insert, update) -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                <label class="col-form-label">ID</label>
                                <input type="text" class="form-control" id="m_id" name="m_id" maxlength="50"
                                    placeholder="ID">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" maxlength="50"
                                    placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="50"
                                    placeholder="Name">
                            </div>


                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" maxlength="50"
                                    placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Tel</label>
                                <input type="text" class="form-control" id="tel" name="tel" maxlength="30"
                                    placeholder="Phone Number">
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="action" id="action" value="insert">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!-- modal (confirmation)-->
        <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
    <!--contents end-->

    <!-- footer -->
    <nav class="navbar navbar-dark text-right" style="background-color:#742F68;">
        <div class="col-12">
            <span class="navbar-text text-white">� 2019 DUS - Group9</span>
        </div>
    </nav>

</body>

</html>