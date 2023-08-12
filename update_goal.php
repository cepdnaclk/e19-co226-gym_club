<?php
// update_trainer.php

@include 'config.php'; // Include your database configuration

session_start();

if (isset($_GET['user_id']) && isset($_GET['goal_id'])) {
    $user_id = $_GET["user_id"];
    $goal_id = $_GET["goal_id"];
    $updateQuery = "UPDATE target
                    SET goal_id = '$goal_id'
                    WHERE UId = '$user_id'";

    mysqli_query($conn, $updateQuery);

    header('Location: member_page.php');
    exit;
} else {
    // Handle the case when the user ID or name is not provided in the URL.
    // For example, you might redirect the user or show an error message.
    header('login_form.php');
}
