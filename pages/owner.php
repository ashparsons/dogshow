<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Owner Details | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    
    <body>

        <?php include __DIR__.'/../fragments/navigation.php'; ?>
        <main>

            <?php
                $id = $_GET['id'];
                $owner = $db->getOwnerDetails($id);
                $ownerimg = '../'.$owner['image_path_owner'];
                $ownerfirstname = $owner['owner_firstname'];
                $ownerlastname = $owner['owner_lastname'];
                $number = $owner['owner_phonenumber'];
            ?>

            <h1 style="margin-top: 55px;"><?= $ownerfirstname . ' ' . $ownerlastname ?></h1>

            <div id="details" class="col-xs-12">
                <div id="owner-image" class="col-xs-6">
                    <img style="border-radius:50%; margin-left: 150px; margin-top: 50px;" src='<?= $ownerimg ?>'>
                </div>

                <div id="owner-info" class="col-xs-6">
                    <ul>
                    <br> <b>Name :</b> <br> <li><?= $ownerfirstname . ' ' . $ownerlastname ?></li>
                    <br> <b>Number :</b> <br> <li><?= $number ?></li>
                    <br> <b>Dogs Owned :</b> <br> <?php
                            foreach ($owner['dogsentered'] as $dogsentered) {
                                echo "<li>$dogsentered</li>";
                            }
                        ?>
                    </ul>
                    
                </div>
            </div>

        </main>
    </body>
</html>