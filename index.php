<?php session_start(); ?>


<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DUS - Home</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


    <script>
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function validationMessage(id, message) {
        $(id).css({
            "border": '#FF0000 1px solid'
        });
        $(id).attr("placeholder", message);
        return;
    }


    function validationPass(ids) {
        for (i = 0; i < ids.length; i++) {
            $(ids[i]).css({
                "border": '#ced4da 1px solid'
            });
        }

    }

    $(document).ready(function() {

        load_data();

        function load_data(query) {
            $.ajax({
                url: "./home/load.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#card').html(data);
                }
            });
        }

        $('input.timepicker').timepicker({});

        $('#sign_in').click(function() {

            $('#modal_sign_in').modal('show');

        });


        /**sign in */
        $('#submit_sign_in').click(function() {

            var id = $('#id_sign_in').val();
            var password = $('#password_sign_in').val();

            /**validation Begins */
            validationPass(["#id_sign_up", "#password_sign_up"]);

            if (id.length <= 0) {
                validationMessage('#id_sign_up', "Please enter a valid id.")
                return;

            } else if (password.length <= 0) {
                validationMessage('#password_sign_up', "Please enter a valid password.")
                return;
            }
            /**validation ENDs */


            $.ajax({
                url: "./login/login_check.php",
                method: "POST",
                data: {
                    id: id,
                    password: password
                },
                success: function(data) {
                    if (data == "success") {
                        alert("Login Successed");
                        window.location.href = "/DUS/index.php"
                    } else {
                        alert("Invalid ID or Password");
                    }
                }
            });


        });

        /**sign in */

        $('#sign_up').click(function() {
            $('#modal_sign_up').modal('show');
        });


        /**sign UP */
        $('#submit_sign_up').click(function() {
            var id = $('#id_sign_up').val();
            var password = $('#password_sign_up').val();
            var name = $('#name_sign_up').val();
            var email = $('#email_sign_up').val();
            var tel = $('#tel_sign_up').val();

            validationPass(["#id_sign_up", "#password_sign_up", "#ame_sign_up", "#email_sign_up",
                "#tel_sign_up"
            ]);

            if (id.length <= 0) {
                validationMessage('#id_sign_up', "Please enter a valid id.")
                return;

            } else if (password.length <= 0) {
                validationMessage('#password_sign_up', "Please enter a valid password.")
                return;

            } else if (name.length <= 0) {
                validationMessage('#name_sign_up', "Please enter a valid name.")
                return;

            } else if (email.length <= 0 || !isEmail(email)) {
                validationMessage('#email_sign_up', "Please enter a valid email email.")
                return;

            } else if (tel.length <= 0) {
                validationMessage('#tel_sign_up', "Please enter a valid tel number.")
                return;
            }

            $('#directLink').css({
                'backgroundColor': 'red'
            });




            $.ajax({
                url: "./login/signup_check.php",
                method: "POST",
                data: {
                    id: id,
                    password: password,
                    name: name,
                    email: email,
                    tel: tel
                },
                success: function(data) {
                    if (data == "success") {
                        alert("Your account is successfully created");
                        window.location.href = "/DUS/index.php";
                    } else {
                        alert("Your ID alreay exists");
                        $('#id_sign_up').val("");
                    }
                }
            });


        });
        /**sign UP */


        $('#search').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });


        $('#add').click(function() {
            $('#modal_title').html("Add Facility");
            $('#form')[0].reset();
            $('#action').val('insert');
            $('#submit').val('Insert');
            $('#modal').modal('show');
        });


        /**add new facility */
        $("#form").on('submit', function(e) {

            e.preventDefault();

            var form = $('form')[0];
            var data = new FormData(form);


            /**validation Begins */
            validationPass(["#name", "#open_time", "#close_time", "#description", "#contact", "#tel",
                "#price"
            ]);

            if ($('#name').val().length <= 0) {
                validationMessage('#name', "Please enter a valid name.")
                return;
            } else if ($('#open_time').prop('selectedIndex') <= 0) {
                validationMessage('#open_time', "Please enter a valid open time.")
                return;
            } else if ($('#close_time').prop('selectedIndex') <= 0) {
                validationMessage('#close_time', "Please enter a valid close time.")
                return;
            } else if ($('#description').val().length <= 0) {
                validationMessage('#description', "Please enter a valid description.")
                return;
            } else if ($('#contact').val().length <= 0) {
                validationMessage('#contact', "Please enter a valid contact.")
                return;
            } else if ($('#tel').val().length <= 0) {
                validationMessage('#tel', "Please enter a valid tel.")
                return;
            } else if ($('#price').val().length <= 0) {
                validationMessage('#price', "Please enter a valid price.")
                return;
            }
            /**validation ENDs */


            $.ajax({
                url: "./home/action.php",
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
        /**add new facility */


        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');
            var action = 'delete';
            $.ajax({
                url: "./home/action.php",
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

        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            var action = 'load_form';
            $.ajax({
                url: "./home/action.php",
                method: "POST",
                data: {
                    id: id,
                    action: action
                },
                dataType: "json",
                success: function(data) {

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

            <h4 class="navbar-text" style="color:#CB9DCC">DURHAM UNIVERSITY<font color="white"> SPORT</font>
                </h3>

                <a class="pull-right" href="http://dur.ac.uk">
                    <img src="./public/img/durham_univ.png" width="126" height="56" alt="">
                </a>

        </div>
    </nav>

    <!-- nav2 -->
    <nav class="navbar navbar-expand-lg navbar-dark py-0 py-md-0" style="background-color:#2F1F20;">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent"
            style="background-color:#2F1F20; color:white;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./bookings/main.php">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./members/main.php">Members</a>
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
                    <a class="nav-link" href="./login/logout.php" style='color:white'>Logout</a>
                </li>
                <?php }?>
            </ul>
        </div>
    </nav>

    <!-- contents -->
    <div class="container-fluid">

        <h1 class="mt-4">Our Facilities</h1>
        <br>
        <!--search bar-->
        <div class="form-row">
            <div class="form-group col-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="background-color:#742F68; color:white;">Search</div>
                    </div>
                    <input type="text" id="search" class="form-control" placeholder="Enter text here.."
                        maxlength="20" />
                </div>
            </div>
            <div class="col-auto">
                <button type="button" id="add" class="btn btn-xs" style="background-color:#742F68; color:white;">Add New
                    Facility</button>
            </div>
        </div>

        <!-- cards -->
        <div id="card">
        </div>
        <!-- cards end -->

        <!-- modal -->
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
                                <label class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="50"
                                    placeholder="Facility's name">
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
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    maxlength="300" placeholder="Explanation of facility"></textarea>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="col-form-label">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" maxlength="50"
                                        placeholder="Email">
                                </div>
                                <div class="col">
                                    <label class="col-form-label">Tel</label>
                                    <input type="text" class="form-control" id="tel" name="tel" maxlength="20"
                                        placeholder="Phone number">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="col-form-label">Price(�) per hour</label>
                                    <input type="text" class="form-control" id="price" name="price" maxlength="10"
                                        placeholder="number">
                                </div>
                                <div class="col">
                                    <label class="col-form-label">Image</label>
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <input type="hidden" name="action" id="action" value="insert" />
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit" />
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

        <!-- modal sign in-->
        <div class="modal fade" id="modal_sign_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-form-label">ID</label>
                            <input type="text" class="form-control" id="id_sign_in" maxlength="50" placeholder="ID" />
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password_sign_in" maxlength="50"
                                placeholder="Password" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="submit_sign_in" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- mdoal sign up -->

        <div class="modal fade" id="modal_sign_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Sign Up</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-form-label">ID</label>
                            <input type="text" class="form-control" id="id_sign_up" maxlength="50" placeholder="ID" />
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password_sign_up" maxlength="50"
                                placeholder="Password" />
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name_sign_up" maxlength="50"
                                placeholder="Name" />
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="email_sign_up" maxlength="50"
                                placeholder="Email" />
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Tel</label>
                            <input type="text" class="form-control" id="tel_sign_up" maxlength="50"
                                placeholder="Phone Number" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="submit_sign_up" class="btn btn-primary">Submit</button>
                        </div>

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