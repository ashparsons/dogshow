<?php require_once __DIR__.'/../fragments/setup.php'; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link rel="stylesheet" href="../css/main.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <?php include __DIR__.'/../fragments/navigation.php'; ?> 

        <!-- Container (About Section) -->
        <div id="about" style="background: #FFFFE0;" class="container-fluid">

            <h1 style="text-align: center; font-size: 44px; margin-top: 50px; margin-bottom: 70px;">Reed Dog Shows</h1>
            <div class="row">
                <div class="col-sm-8">
                    <h2>About Us</h2><br>
                    <h4>We offer the highest quality dog shows for everyone from beginners (owners and pups alike) to international champions.
                        <br>2018 will be our 10 year anniversary, and we are so happy that you could take time to come and judge our fur-babies.
                    </h4><br>
                    <p>Reed Dog Shows evaluates our furry friends in courses such as: Agility, Obedience, Rally Obedience, Puppy and Herding.
                        <br> Scores will be given out of 10, and 3 winners from each category will be selected based on their scores.
                    </p>
                </div>
                <div id="dogcar" class="col-xs-4">
            <div id="dogCarousel" class="carousel slide" data-ride="dogCarousel">
                <!-- Indicators -->
                <ol class="carousel-indicators" style="width: 50px;">
                    <li data-target="#dogCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#dogCarousel" data-slide-to="1"></li>
                    <li data-target="#dogCarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <img src="../dogs/gdood_car.jpg" style="height: 250px; border-radius: 50%;" alt="Doodle">
                    </div>

                    <div class="item">
                        <img src="../dogs/gshep_car.jpg" style="height: 250px; border-radius: 50%;" alt="Shepard">
                    </div>

                    <div class="item">
                        <img src="../dogs/glab_car.jpg" style="height: 250px; border-radius: 50%;" alt="Lab">
                    </div>
                </div>

            </div>
        </div>
            </div>
        </div>

        <div class="container-fluid bg-grey">
            <div class="row">
                <div class="col-sm-4">
                    <i class="material-icons" style="font-size: 250px; margin-left: 100px;">history</i>
                </div>
                <div class="col-sm-8">
                    <h2>Our History</h2><br>
                    <h4><strong>WHERE IT BEGAN:</strong> We have been hosting events for dog-parents to show off their furry children since 2008. 
                    Because this year is our 10th anniversary, we will have special performances from some of our past winners, as well as added treats for 
                    humans and pups who come to see it!</h4><br>
                    <p><strong>WHAT'S NEXT:</strong>We hope that our next 10 years will bring many more beginners into the world of dog shows, as well as 
                    introducing more future stars! We hope to have the show be bi-annual and take place in new provinces.</p>
                </div>
            </div>
        </div>

        <!-- Container (Services Section) -->
        <div id="services" style="background: #E6E6FA;" class="container-fluid text-center">
            <h2>OUR JUDGES PORTAL</h2>
            <h4>What we offer</h4>
            <br>
            <div class="row slideanim">
                <div class="col-sm-4">
                    <i class="material-icons">pets</i>
                    <h4>Contestants</h4>
                    <p>Get to know the pampered pooches who will be taking part this year!</p>
                </div>
                <div class="col-sm-4">
                    <i class="material-icons">face</i>
                    <h4>Owners</h4>
                    <p>Get to know the faces and contact details of the owners!</p>
                </div>
                <div class="col-sm-4">
                    <i class="material-icons">event_note</i>
                    <h4>Events</h4>
                    <p>Find the schedule and event details for this year!</p>
                </div>
            </div>
            <br><br>
            <div class="row slideanim">
                <div class="col-sm-4">
                    <i class="material-icons">money</i>
                    <h4>Prizes</h4>
                    <p>View and update the prizes for events!</p>
                </div>
                <div class="col-sm-4">
                    <i class="material-icons">add</i>
                    <h4>Add</h4>
                    <p>Add new pups to the contest, and to different events!</p>
                </div>
                <div class="col-sm-4">
                    <i class="material-icons">chat</i>
                    <h4>Chat</h4>
                    <p>Communicate with your fellow judges via the message board!</p>
                </div>
            </div>
            <br><br>
        </div>

        <footer class="container-fluid text-center" style="background: #E0FFFF;">
            <a href="#myPage" title="To Top">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
            <p>Reed Dog Show</p>
        </footer>

        <script>
            $(document).ready(function(){
                // Add smooth scrolling to all links in navbar + footer link
                $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
                    // Make sure this.hash has a value before overriding default behavior
                    if (this.hash !== "") {
                        // Prevent default anchor click behavior
                        event.preventDefault();

                        // Store hash
                        var hash = this.hash;

                        // Using jQuery's animate() method to add smooth page scroll
                        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top
                        }, 900, function(){

                            // Add hash (#) to URL when done scrolling (default click behavior)
                            window.location.hash = hash;
                        });
                    } // End if
                });

                $(window).scroll(function() {
                    $(".slideanim").each(function(){
                        var pos = $(this).offset().top;

                        var winTop = $(window).scrollTop();
                        if (pos < winTop + 600) {
                            $(this).addClass("slide");
                        }
                    });
                });
            })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular-route.js"></script>

    </body>
</html>