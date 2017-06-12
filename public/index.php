<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <script src="libs/jquery/dist/jquery.min.js"></script>
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>

    <title>LOG IN</title>
</head>
<body>

<!-- Navigation_start -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <!-- make menu for mobile version -->
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="name_sys">Project Management</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="logOn" data-toggle="modal" data-target="#help">Help</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navigation_end -->

<!-- MainInfo_start -->
<div class="container-fluid">
    <div class="container c_main">
        <section class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <form method="POST" action="javascript:void(null);" id="login-form">
                <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                        maxlength="30" 
                        required />
                <br/>
                
                <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        maxlength="20"
                        required />

                <div class="modal-footer">
                    <p align="left" id="error" style="color: red;"></p>                 
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>
            </form>
        </section>
    </div>
</div>
<!-- MainInfo_end -->



<!-- Footer_start -->
<div class="container-fluid">
    <nav class="navbar navbar-inverse navbar-fixed-bottom">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <p class="navbar-text">Sierikov Roman © 2017</p>
            </li>
        </ul>
    </nav>
</div>
<!-- Footer_end -->

</body>
</html>