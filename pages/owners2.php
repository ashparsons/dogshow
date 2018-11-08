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
            <h2 style="text-align: center;">Our Contestants!</h2><br>
               
        </div>

        <div class="container-fluid bg-grey" style="height: 600px;; overflow-y: auto; white-space: nowrap;">
            <h2 style="text-align: center;">Scroll to see this year's Prized Pups!</h2><br><br>
            <?php
                $dogs = $db->getDogs();
                foreach ($dogs as $dog) {
                $dogPath = '../'.$dog['image_path_dog'];
                $name = $dog['dog_name'];
                $breed = $dog['breed'];
                $dogid = $dog['dog_id'];
            ?>
                
                <div class="col-xs-4" style="text-align: center;">
                    <a href='dog.php?id=<?= $dogid ?>'>
                        <img src='<?= $dogPath ?>'>
                    </a>
                    </p><?= $name ?>
                    </p><?= $breed ?>
                    </ul>
                <br>
                <br>    
                </div>
            <?php 
                } 
            ?>
        </div>

        <!-- Container (Services Section) -->
        <div id="services" style="background: #E6E6FA;" class="container-fluid text-center">
            <h2>Add a new Contestant :</h2>
            <br>
                
            <div class="col-sm-12">
                <a href="/dogshow/pages/adddog.php"> <i style="font-size: 40px;" class="material-icons">add</i></a>
            </div>
            <br><br>
            <h4>Click the '+' to add a new dog to the event!</h4>
                
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

<!-- <?php include __DIR__.'/../fragments/setup.php';  ?>

<?php

$newSearchForm = isset($_POST['search']);

$searchText = '%';

if ($formSubmitted && $newSearchForm) {
    $searchText = $_POST['keywords'];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Owners | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <?php include __DIR__.'/../fragments/navigation.php'; ?>
        <?php
            echo "<h1>The Proud Owners!</h1>"; 
        ?>

        <main>
            <div id="searchbar" col-xs-12>
            <form name="search-form" method="POST" action="<?= $self ?>">
                    <input type="text" name="keywords">
                    <input type="submit" name="search" value="search">
                </form>
            </div>
            
            <?php
                $owners = $db->getOwnersSearch($searchText);
                foreach ($owners as $owner) {
                    $ownerPath = '../'.$owner['image_path_owner'];
                    $firstname = $owner['owner_firstname'];
                    $lastname = $owner['owner_lastname'];
                    $number = $owner['owner_phonenumber'];
                    $ownerid = $owner['owner_id'];
                ?>

                    <div id="owner-details" class="col-xs-4">
                        <ul> 
                            <li><a href='owner.php?id=<?= $ownerid ?>'>
                                <img style="border-radius:50%" src='<?= $ownerPath ?>'>
                            </a></li>
                            <li><b></p><?= $firstname . ' ' . $lastname ?></b></li>
                            <!-- <li><b><span class="glyphicon glyphicon-earphone"></span><?= ' ' . $number ?></b></li> -->
                        </ul>    
                    </div>
            <?php 
                } 
            ?>
            
        </main>    
    </body>
</html> -->