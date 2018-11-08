<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<?php 

    $newEntryForm = isset($_POST['new-entry-submit']);

    if ($formSubmitted) {

        $id = $_POST['id'];

        $errors = array();

        if(empty($_POST['events-id'])) {
            $errors['events-id'] = "Please select an event.";
        } 
        
        // if($_POST['events-id'] && $eventdates === $dogsdate) {
        //     $errors['events-id'] = "Only 1 event/day allowed.";
        // } 
        
        if(empty($errors)) {
            $entry = array();
            $entry['events_id'] = $_POST['events-id'];
            $entry['dogs_id'] = $_POST['dogs-id'];
            $db->postEntry($entry);
        }
        
    } else {
        $id = $_GET['id'];
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Dog Details | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    
    <body>

        <?php include __DIR__.'/../fragments/navigation.php'; ?>

        <main>

            <?php
                $dog = $db->getDogDetails($id);
                $dogName = $dog['dog_name'];
                $breed = $dog['breed'];
                $dogimg = '../'.$dog['image_path_dog'];
                $ownerfirstname = $dog['owner_firstname'];
                $ownerlastname = $dog['owner_lastname'];
            ?>

            <h1 style="margin-top: -5px;"><?= $dogName ?></h1>
            <h4><?= $breed ?></h4>

            <div id="details" class="col-xs-12">
                <div id="dog-image" class="col-xs-4">
                    <img src='<?= $dogimg ?>'>
                </div>

                <div id="dog-info" class="col-xs-8">
                    <h3><?= $dogName ?> is a <?= $breed ?> who belongs to <?= $ownerfirstname . ' ' . $ownerlastname ?>.</h3>
                    <h3>This year, <?= $dogName ?>  and <?= $ownerfirstname ?> have entered into : </h3>
                    <ul>

                    <?php
                        foreach ($dog['dogsentered'] as $dogsentered) {
                            echo "<li>$dogsentered</li>";
                        }
                        foreach ($dog['dogsdate'] as $dogsdate) {
                            echo "<li class='date' hidden>$dogsdate</li>";
                        }
                    ?>
                    </ul>

                    <h4>Enter <?= $dogName ?> into an Event :</h4>

                    <form name="new-entry-form" method="post" action="<?= $self ?>">
                    
                        <div class="form-row">

                            <select name="dogs-id" class="custom-select" style="width:100%;" hidden>

                                <option class="<?= $dogsdate ?>" value="<?= $id ?>"><?= $dogName ?></option>

                            </select> 
                        </div>

                        <div class="form-row">

                            <select name="events-id" class="custom-select" style="width:100%;">

                                <option value="">Select an Event..</option>

                                <?php
                                    $events = $db->getEvents();
                                    foreach ($events as $event) {
                                        $category = $event['event_category'];
                                        $eventid = $event['event_id'];
                                        $eventdate = $event['event_date'];      
                                ?>

                                <option class="<?= $eventdate ?>" value="<?= $eventid ?>"><?= $category ?></option>

                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <?php if (isset($errors['events-id'])) {?>
                            <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['events-id']; ?> </span>
                        <?php } ?>

                        <input type="hidden" name="id" value="<?= $id ?>">

                        <input class="add-contestant" name="new-entry-submit" type="submit" value="Enter <?= $dogName ?>">

                    </form>
                
                </div>
            </div>

        </main>
    </body>
</html>