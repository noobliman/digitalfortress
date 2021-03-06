
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Digital Fortress</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url('assets/css/landing-page.css') }}" rel="stylesheet"/>

        <!--     Fonts and icons     -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>

        <link href="{{ url('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
        <link href="{{ url('assets/css/material-dashboard.css') }}" rel="stylesheet" />
    </head>
    <body class="landing-page landing-page1">
        <nav class="navbar navbar-transparent navbar-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <!-- <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                    </button> -->
                    <a href="http://www.nitdgplug.org">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="{{ url('assets/img/new_logo.png') }}" alt="GLUG Logo">
                            </div>
                        </div>
                    </a>
                    <a href="http://www.avskr.in">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="{{ url('assets/img/avskr.jpg') }}" alt="Aavishkar Logo">
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="example" >
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="https://www.facebook.com/nitdgplug">
                            <i class="fa fa-facebook-square"></i>
                            Like
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="wrapper">
            <div class="parallax filter-gradient gray" data-color="blue">
                <div class="parallax-background">
                    <img class="parallax-background-image" src="{{ url('assets/img/2.jpg') }}">
                </div>
                <div class= "container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="parallax description">
                                <h1 class="mainfont2" style="font-size:7vw;">DIGITAL FORTRESS</h1>
                                <br><br><br><br>
                                <h4 class="mainfont2sm" align="right" width="183">get ready to be puzzled !!</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div><footer class="footer">
                <div class="container">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="social-area pull-right">
                        <a class="btn btn-social btn-facebook btn-simple">
                        <i class="fa fa-facebook-square"></i>
                        </a>
                        <a class="btn btn-social btn-twitter btn-simple">
                        <i class="fa fa-twitter"></i>
                        </a>
                        <a class="btn btn-social btn-pinterest btn-simple">
                        <i class="fa fa-pinterest"></i>
                        </a>
                    </div>
                    <div class="copyright">
                        &copy; 2018 <a href="http://nitdgplug.org">Made with &hearts; by GNU/Linux Users' Group</a>
                    </div>
                </div>
            </footer>

            <div class="section section-gray section-clients">
                <div class="container text-center">
                    <h4 class="mainfont2sm">Welcome to the Digital Fortress</h4>
                    <p>
                        Unwind through the mysteries of the past to know about the future and tackle your present.
                        And this is all bullshit because the author is in shortage of proper description. :p<br>
                    </p>
                </div>
            </div>
            <div class="section section-presentation">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="description" >
                                <h4 class="mainfont2md" style="color:chocolate;">Lots of Prizes to be Won which includes cash prizes, tshirts and other goodies</h4>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <img src="{{ url('assets/img/gifts.jpg') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="parallax filter-gradient orange" data-color="blue">
                <div class="parallax-background">
                    <img class="parallax-background-image" src="{{ url('assets/img/2.jpg') }}">
                </div>
                <div class= "container">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-3">
                            <div class="parallax description">
                                <h1 class="mainfont2md">Ready to start the game ??</h1>
                                <p align="center">
                                    <a href="dashboard" id="startgame" class="btn btn-info btn-lg" style="width: 60%;">START</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script src="{{ url('assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/jquery-ui-1.10.4.custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/awesome-landing-page.js') }}" type="text/javascript"></script>
</html>
