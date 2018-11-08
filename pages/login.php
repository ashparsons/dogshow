<?php

    session_start();

    //ERROR MESSAGE
    $error = '';

    if (isset($_POST['submit'])) {

        if (empty($_POST['username'])) {
            
            //NO USERNAME/PASSWORD ENTERED ERROR
            $error = "Username is Required.";

        } else if (empty($_POST['password'])) {

            //NO USERNAME/PASSWORD ENTERED ERROR
            $error = "Password is Required.";

        } else {

            //IF USERNAME & PASSWORD ENTERED
            $username = $_POST['username'];
            $password = $_POST['password'];

            //CONNECT TO DATABASE
            $connect = mysqli_connect("localhost", "root", "", "dog_show");

            $query = "SELECT * 
                      FROM users 
                      WHERE username=? AND password=? LIMIT 1";

            $statement = $connect->prepare($query);
            $statement->bind_param("ss", $username, $password);
            $statement->execute();
            $statement->bind_result($username, $password);
            $statement->store_result();

            //FETCH USER ROW'S CONTENTS
            if($statement->fetch()) {

                $_SESSION['username'] = $username;
                header("location: profile.php");

            } else {

                $error = "Username or Password is invalid";

            }
            mysqli_close($connect);
        }

    }

    if(isset($_SESSION['username'])){
        header("location: home2.php");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>

    <body>
        <main>

            <div id="frm" style="border: solid gray 1px;
                                width: 40%;
                                border-radius: 5px;
                                margin: 100px auto;
                                background: rgb(100, 100, 100, 0.8);
                                padding: 50px;">

                <h1 style="margin-top: -70px;">Please log in below :</h1>

                <div id="imgcontainer" class="col-xs-12">
                    <img class="avatar" style="margin-left: 120px; margin-bottom: 20px;" src="../avatar.png" alt="Avatar" class="avatar">
                </div>

                <form action="" method="post">
                    <input id="name" name="username" placeholder="Username" type="text">
                    <input id="password" name="password" placeholder="Password" type="password"><br><br>
                    <input class="btn btn-warning" style="width: 100%" name="submit" type="submit" value=" Login ">
                    <span style="color: red; font-size: 20px; background: rgb(255, 255, 255);"><?php echo $error; ?></span>
                </form>

            </div>
        </main>
    </body>
</html>