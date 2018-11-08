<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<?php
// if(!isset($_SESSION[$login_user])) {
//     header("location: login.php");
// }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Events | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <?php include __DIR__.'/../fragments/navigation.php'; ?>
        <?php
            echo "<h1>What's On this Weekend?</h1>";

            $d1=strtotime("November 02");
            $d2=ceil(($d1-time())/60/60/24);
            echo "<h4>There are " . $d2 ." days until the Competition.</h4>";
        ?>

        <main>

            <?php
                $events = $db->getEvents();
                foreach ($events as $event) {
                    $category = $event['event_category'];
                    $first = $event['prize_first'];
                    $second = $event['prize_second'];
                    $third = $event['prize_third'];
                    $date = $event['event_date'];
                    $eventid = $event['event_id'];
                ?>

                    <div id="event-table">
                        <div class="trial">
                            <a style="font-family: 'Lobster', cursive;
                                      font-size: 28px;
                                      color: white;
                                      text-shadow: black 0px 0px 10px;" 
                                href='event.php?id=<?= $eventid ?>'><?= $category ?></a><br>
                                    
                            <ul style="font-size: 17px;">
                                <li> <b>First Place : </b> R<?= $first ?></li>
                                <li> <b>Second Place : </b> R<?= $second ?></li>
                                <li> <b>Third Place : </b> R<?= $third ?></li>	
                                <li> <b>Date : </b><?= $date ?></li>		
                            </ul> 
                        </div>
                    </div>
            <?php 
                } 
            ?>

        </main>
    </body>
</html>