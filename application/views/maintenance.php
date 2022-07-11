<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Maintenance Page</title>
    <!-- Bootstrap -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $base_url . 'application/assets/css/bootstrap.min.css'; ?>">

    <!-- External Css -->
    <link rel="stylesheet" href="<?php echo $base_url . 'application/assets/css/fontawesome-all.min.css'; ?>">

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url . 'application/assets/css/main.css'; ?>">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600%7CRoboto:300i,400,500" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo $base_url . 'application/assets/images/apple-touch-icon.png'; ?>">

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo $base_url . 'application/assets/js/jquery.min.js'; ?>"></script>

    <script src="<?php echo $base_url . 'application/assets/js/popper.min.js'; ?>"></script>
    <script src="<?php echo $base_url . 'application/assets/js/bootstrap.min.js'; ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url .'application/assets/dashboard/css/dashboard.css'; ?>">

    <style>

        .error-template{
            padding: 40px 15px;
            text-align: center;
        }
        .error-actions{
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .error-actions .btn{
            margin-right: 10px;
        }
        .message-box h1{
            color: #252932;
            font-size: 98px;
            font-weight: 700;
            line-height: 98px;
            text-shadow: rgba(61, 61, 61, 0.3) 1px 1px, rgba(61, 61, 61, 0.2) 2px 2px, rgba(61, 61, 61, 0.3) 3px 3px;
        }
    </style>
  </head>
  <body class="alice-bg">
    <div class="container" style="height:100vh">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <div class="error-template">
                    <h1 class="mb-4">
                        :) Oops!</h1>
                    <h4 class="mb-4">
                        Temporarily down for maintenance</h4>
                    <h3 class="mb-4">
                        We’ll be back soon!</h3>
                    <div>
                        <p>
                            Sorry for the inconvenience but we’re performing some maintenance at the moment.
                            we’ll be back online shortly!</p>
                        <p>
                            — The Team</p>
                    </div>
                    <div class="error-actions">
                        <span style="margin-top: 10px;" class="btn btn-info">Mentric Technologies </span>
                    </div>
                </div>
            </div>
        </div>
    </div>




  </body>

</html>
