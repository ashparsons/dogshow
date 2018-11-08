<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Profile | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>

        <?php include __DIR__.'/../fragments/navigation.php'; ?>

        <?php 

        $newNameForm = isset($_POST['username-update']);
        $newEmailForm = isset($_POST['email-update']);
        $newPassForm = isset($_POST['password-update']);

        $id = $login_id;

        if ($formSubmitted) { 

            $errors = array();

            if (empty($_POST['new-email']) && $newEmailForm) {
                $errors['email'] = "Please insert a new email address.";
            } 

            if (empty($_POST['new-password']) && $newPassForm) {
                $errors['password'] = "Please insert a new password.";
            } 

            if (empty($errors) && $newNameForm) {
                $id = $_POST['id'];

                $user = array();
                $user['username'] = $_POST['new-username'];
                $user['id'] = $_POST['id'];
                $db->postName($user);
                
            }

            if (empty($errors) && $newEmailForm) {
                $id = $_POST['id'];

                $user = array();
                $user['email'] = $_POST['new-email'];
                $user['id'] = $_POST['id'];
                $db->postEmail($user);
                
            } 

            if (empty($errors) && $newPassForm) {
                $id = $_POST['id'];

                $user = array();
                $user['password'] = $_POST['new-password'];
                $user['id'] = $_POST['id'];
                $db->postPass($user);
                
            } 
        } 
        else {
            $id = $login_id;
        }

        ?>

        <main>

            <?php
                $user = $db->getUserDetails($login_id);
                $userPath = '../'.$user['image_path_user'];
                $name = $user['username'];
                $email = $user['email'];
                $userId = $user['user_id'];
            ?>

            <h1> Edit Your Profile </h1>

            <div class="col-xs-4">

                <img style="border-radius:50%; margin-top: 80px;" src='../avatars/<?= $userPath ?>'>
                <h3 style="padding-left: 100px;"><?= $name ?></h3>

            </div>

            <div class="col-xs-8" style="padding-top: 80px;">

                <!-- <h4>Edit Username (<?= $name ?>) :</h4>

                <div class="row">

                    <form class="col-xs-12" name="new-username-form" method="post" action="<?= $self ?>">

                        <div class="col-xs-6">
                        <input type="text" name="new-username" placeholder="New Username" required>
                        <input type="hidden" name="id" value="<?= $id ?>">
                        </div>
                        
                        <div class="col-xs-6">
                        <input class="col-xs-6" style="width: 100%; padding: 10px; margin-top: 5px;" type="submit" name="username-update" value="Update">
                        </div>

                    </form>
                </div> -->
                
                <h4>Edit Email (<?= $email ?>) :</h4>

                <div class="row">

                    <form class="col-xs-12" name="new-email-form" method="post" action="<?= $self ?>">

                        <div class="col-xs-6">
                        <input type="text" name="new-email" placeholder="New Email">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <?php if (isset($errors['email'])) {?>
                            <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['email']; ?> </span>
                        <?php } ?>
                        </div>
                        
                        <div class="col-xs-6">
                        <input class="col-xs-6" style="width: 100%; padding: 10px; margin-top: 5px;" type="submit" name="email-update" value="Update">
                        </div>

                    </form>
                </div>

                <h4>Edit Password :</h4>

                <div class="row">

                    <form class="col-xs-12" name="new-password-form" method="post" action="<?= $self ?>">

                        <div class="col-xs-6">
                        <input type="text" name="new-password" placeholder="New Password">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <?php if (isset($errors['password'])) {?>
                            <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['password']; ?> </span>
                        <?php } ?>
                        </div>

                        <div class="col-xs-6">
                        <input class="col-xs-6" style="width: 100%; padding: 10px; margin-top: 5px;" type="submit" name="password-update" value="Update">
                        </div>

                    </form>
                </div>
            </div>
        </main>

    </body>
</html>