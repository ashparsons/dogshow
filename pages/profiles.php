<?php require_once __DIR__.'/../fragments/setup.php'; 
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Profile | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    
    <body>

        <main>

            <h1>Welcome, Judges!</h1>
            <h4>Log into Reed Dog Shows' Judges Portal <a href="/dogshow/pages/login.php">here</a>!</h4>


            <?php
                $users = $db->getUsers();
                foreach ($users as $user) {
                $userPath = '../'.$user['image_path_user'];
                $name = $user['username'];
                $userId = $user['user_id']
            ?>

            <div id="user-details" class="col-xs-4">
                <ul style="padding-top: 100px;"> 
                    <li>
                        <img style="border-radius:50%" src='<?= $userPath ?>'>
                    </li>
                    <li><b></p><?= $name ?></b></li>
                </ul>    
            </div>
                    
            <?php
                }
            ?>

        </main>
    </body>
</html>