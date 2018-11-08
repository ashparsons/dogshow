<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<?php 

$newCommentForm = isset($_POST['new-comment-submit']);


if ($formSubmitted) {
    
    $errors = array();

    if (empty($_POST['comment_made'])) {
        $errors['comment-made'] = "Please add a comment.";
    } 
    
    if (empty($errors)) {
        $note = array();
        $note['user_comment_id'] = $_POST['usersid'];
        $note['comment'] = $_POST['comment_made'];
        $db->postComment($note);
    }
}
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Profile | Dog Show</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
    <link rel="stylesheet" href="../css/main.css">
  </head>

  <body>
    <?php include __DIR__.'/../fragments/navigation.php'; ?>

    <?php
        echo "<h1>Welcome, $login_session </h1>"; 
    ?>

    <div id="profile">

      <div class="col-xs-4" id="user-details">
          <ul style="padding-top: 100px;"> 
              <li>
                  <img style="border-radius:50%" src='../<?= $login_picture ?>'>
              </li>
              <li><b></p><?= $login_session ?></b></li>
              <li><b></p><?= $login_email ?></b></li>
              <li><b></p> <a href="editprofile.php?id=<?= $login_id ?>">Edit Profile</a></b></li>
          </ul>    
      </div>

      <div class="col-xs-8" id="user-comments"  style="padding-top: 50px;">

        <h4>Interact with your fellow Judges below</h4> 

        <div class="col-xs-4" style="margin-top: 15px;">

          <form name="new-comment-form" action="<?= $self ?>" method="POST">

            <select name="usersid" style="width:100%;" hidden>
              <option value="<?= $login_id ?>"></option>
            </select> 

            <div class="col-xs-12">
              <textarea class="col-xs-12" rows="4" name="comment_made"></textarea>
                <?php if (isset($errors['comment-made'])) {?>
                  <span style="background: rgb(255, 255, 255);" class="error"> <span class="ui-icon ui-icon-alert"></span> <?= $errors['comment-made']; ?> </span>
                <?php } ?>
            </div>

            <input class="col-xs-11" style="padding: 5px; margin-left: 15px;" type="submit" name="new-comment-submit" value="Comment">

          </form>

        </div>

        <div id="comments" style="background: rgb(100, 100, 100, 0.8);" class="col-xs-8" >
          <?php
            $notes = $db->getNotes();
            foreach ($notes as $note) {
            $name = $note['username'];
            $idposter = $note['user_comment_id'];
            $comment = $note['comment'];
          ?>

          <div class="col-xs-4">
            <h3><?= $name ?></h3>
            <p><?= $comment ?></p>
          </div>

          <?php
          }
          ?>
        </div>

        
      </div>

    </div>
  </body>

</html>