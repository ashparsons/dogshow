<?php require_once __DIR__.'/../fragments/setup.php';
?>

<?php 

    $newDogForm = isset($_POST['new-dog-submit']);
    

    if ($formSubmitted) {
        
        $errors = array();

        if (empty($_POST['dog-name'])) {
            $errors['dog-name'] = "A dog's name is required.";
        } 
        if (empty($_POST['dog-breed'])) {
            $errors['dog-breed'] = "A dog's breed is required.";
        } 
        if (empty($_POST['dog-parent'])) {
            $errors['dog-parent'] = "A dog's owner is required.";
        }
        
        if (empty($errors)) {
            $dog = array();
            $dog['dog_name'] = $_POST['dog-name'];
            $dog['breed'] = $_POST['dog-breed'];
            $dog['image_path_dog'] = $_POST['dog-image'];
            $dog['parent_id'] = $_POST['dog-parent'];
            $db->postDog($dog);
            header('Location: http://localhost:8888/dogshow/pages/dogs.php');
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Dog | Dog Show</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>

        <?php include __DIR__.'/../fragments/navigation.php'; ?>
    
        <?php
            echo "<h1>Add a New Pup Below :</h1>"; 
        ?>

        <main>

            <div id="details" class="col-xs-12" style="border: solid gray 1px;
                                                    width: 40%;
                                                    border-radius: 5px;
                                                    margin: 100px auto;
                                                    margin-left: 380px;
                                                    background: rgb(100, 100, 100, 0.5);
                                                    padding: 50px;">

                <form name="new-dog-form" method="post">
                    <div class="form-row">
                        <label>Name</label>
                        <input name="dog-name" type="text" placeholder="Name">
                        <?php if (isset($errors['dog-name'])) {?>
                            <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['dog-name']; ?> </span>
                        <?php } ?>
                    </div>
                    
                    <div class="form-row">
                        <label>Breed</label>
                        <input name="dog-breed" type="text" placeholder="Breed">
                        <?php if (isset($errors['dog-breed'])) {?>
                            <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['dog-breed']; ?> </span>
                        <?php } ?>
                    </div>
                    
                    <div class="form-row">
                        <label>Headshot</label>
                        <input name="dog-image" type="text" value="dogs/default.jpg" readonly>
                    </div>

                    <div class="form-row">
                        <label>Owner</label>
                        <select name="dog-parent" class="custom-select" style="width:100%;">
                            <option value="">Select an Owner...</option>

                            <?php
                                $owners = $db->getOwners();
                                foreach ($owners as $owner) {
                                    $firstname = $owner['owner_firstname'];
                                    $lastname = $owner['owner_lastname'];
                                    $id = $owner['owner_id'];
                            ?>

                            <option value="<?= $id ?>"><?= $firstname . ' ' . $lastname ?></option>

                            <?php
                                }
                            ?>
                        </select> 
                        <?php if (isset($errors['dog-parent'])) {?>
                            <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['dog-parent']; ?> </span>
                        <?php } ?>
                    </div>

                    <input class="add-dog" name="new-dog-submit" type="submit" value="Add">

                </form>
            </div>

        </main>
    </body>
</html>