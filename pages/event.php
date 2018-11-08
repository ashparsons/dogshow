<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<?php 

    $newPrizeForm = isset($_POST['prize-update']);

    if ($formSubmitted) {

        $id = $_POST['id'];

        $errors = array();

        // if (empty($_POST['new-prize'])) {
        //     $errors['prize-number'] = "Please insert a new value.";
        // } 

        // if ($_POST['new-prize'] && $_POST['prize-number'] === 'first' && $_POST['new-prize'] < 1299) {
        //     $errors['prize-number'] = "First Prize cannot be smaller than Second Prize.";
        // }

        // if ($_POST['new-prize'] && $_POST['prize-number'] === 'second' && $_POST['new-prize'] > 1299) {
        //     $errors['prize-number'] = "Second Prize cannot be larger than First Prize.";
        // }

        // if ($_POST['new-prize'] && $_POST['prize-number'] === 'second' && $_POST['new-prize'] < 1099) {
        //     $errors['prize-number'] = "Second Prize cannot be smaller than Third Prize.";
        // }

        // if ($_POST['new-prize'] && $_POST['prize-number'] === 'third' && $_POST['new-prize'] > 1099) {
        //     $errors['prize-number'] = "Second Prize cannot be larger than First Prize.";
        // }

        if (empty($errors)) {

            $event = array();
            $event['event_id'] = $id;

            if ($_POST['prize-number'] == 'first') {
                $event['prize_first'] = $_POST['new-prize'];
            } else if ($_POST['prize-number'] == 'second') {
                $event['prize_second'] = $_POST['new-prize'];
            } else if ($_POST['prize-number'] == 'third'){
                $event['prize_third'] = $_POST['new-prize'];
            }
            $db->postPrize($event);
        }
    } else {
        $id = $_GET['id'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Event Details | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>

        <?php include __DIR__.'/../fragments/navigation.php'; ?>

        <main>

            <?php
                
                $event = $db->getEventDetails($id);
                $category = $event['event_category'];
                $first = $event['prize_first'];
                $second = $event['prize_second'];
                $third = $event['prize_third'];
                $date = $event['event_date'];
                //$eventid = $event['event_id'];
            ?>

            <h1 style="font-size: 55px;"> View and Edit <?=$category ?></h1>

            <div id="details" style="min-height: 500px; margin-top: 100px;">

                <div class="col-xs-6">

                    <div id="dog-info" class="col-xs-12">
                        <h3><?= $category ?> has a first prize of R<?= $first ?>, a second prize of R<?= $second ?>, and a third prize of R<?= $third ?>.</h3>
                        <h3>It takes place on <?= $date ?>.</h3>
                        <h3>The following dogs are entered into <?= $category ?> :</h3>
                        <ul>
                        <?php
                            foreach ($event['dogsentered'] as $dogsentered) {
                                echo "<li>$dogsentered</li>";
                            }
                        ?>
                        </ul>
                    </div>

                </div>

                <div class="col-xs-6">

                    <h4>Change <?= $category ?>'s Prize Values :</h4>

                    <form name="new-price-form" method="post" action="<?= $self ?>">
                
                        <div class="form-row">

                            <select name="prize-number" class="custom-select" style="width:100%;">
                                <option value="first">First Prize - R<?= $first ?></option>
                                <option value="second">Second Prize - R<?= $second ?></option>
                                <option value="third">Third Prize - R<?= $third ?></option>
                            </select> 
                        </div>

                        <input type="text" name="new-prize" placeholder="New Prize Amount">

                        <?php if (isset($errors['prize-number'])) {?>
                            <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['prize-number']; ?> </span>
                        <?php } ?>


                        <input type="hidden" name="id" value="<?= $id ?>">

                        <input style="width: 100%; padding: 10px; margin-top: 15px;" type="submit" name="prize-update" value="Update">

                    </form>
                    
                </div>
            </div>

        </main>

    </body>
</html>