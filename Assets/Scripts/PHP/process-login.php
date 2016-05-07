<?php
include_once 'connect.php';
include_once 'functions.php';

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // The hashed password.
    $password = hash('sha512', $password);
    if (login($username, $password, $mysqli) == true) {
        // Login success
        header('Location: ../../../index.php');
    } else {
        // Login failed
        header('Location: ../../../login.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}
