<?php
    require_once __DIR__.'/../classes/DatabaseHandler.php';
    $db = new DatabaseHandler('mysql','localhost:8889','dog_show','root','');
    $self = htmlspecialchars($_SERVER['PHP_SELF']);

    $formSubmitted = $_SERVER['REQUEST_METHOD'] === 'POST';
?>