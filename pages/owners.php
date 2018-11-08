<?php include __DIR__.'/../fragments/setup.php';  ?>

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
</html>