<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-tour.min.css') ?>">
    <style type="text/css" media="screen">
        body {
            padding-top: 20px;
            padding-bottom: 20px;
            font-family: "Open Sans", Helvetica, sans-serif;
            font-size: 16px;
        }

        .navbar {
            margin-bottom: 20px;
        }

        a, a:hover, a:focus {
            color: #ecf0f1;
            text-decoration: none;
        }
    </style>

    <script type="text/javascript">
        var rootURL = '<?php echo base_url() ?>';
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">OSIS Election</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo site_url('') ?>">Home</a></li>
                        <li><a href="<?php echo site_url('vote') ?>">Vote</a></li>
                        <li><a href="<?php echo site_url('live-count') ?>">Live Count</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?php if($this->evoting_lib->logged_in()): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ucwords(strtolower($user->nama)) ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('logout') ?>">Keluar</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="<?php echo site_url('login') ?>">Sign in</a></li>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>       
    </div>
