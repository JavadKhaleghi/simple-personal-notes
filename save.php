<?php

$connection = require_once "./Connection.php";

if (isset($_POST['id'])) {
    $connection->updateNote($_POST['id'], $_POST);
} else {
    $connection->addNote($_POST);
}

header('Location: index.php');