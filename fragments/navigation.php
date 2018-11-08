<?php 

include('../session.php'); 

if(!isset($_SESSION['username'])) {
    header("location: login.php");
}

?>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<div id="navigation">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home2.php">Reed Dog Shows</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="dogs2.php"><i class="material-icons">pets</i></a>
                    </li>
                    <li>
                        <a href="owners2.php"><i class="material-icons">face</i></a>
                    </li>
                    <li>
                        <a href="events.php"><i class="material-icons">event_note</i></a>
                    </li>

                    <li>
                        <div class="dropdown">
                            <button class="dropdownplace"><a style="color: black;">
                                <img style="border-radius:50%; height: 30px;" src='../<?= $login_picture ?>'><?= '  ' . $login_session ?></a>
                            </button>
                            <div class="dropdown-content">
                                <a href="profile.php">Profile</a>
                                <a href="logout.php">Logout</a>
                                <a><?php echo date("Y/m/d"); ?></a>
                            </div>
                        </div> 
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

