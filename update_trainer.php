<?php
// update_trainer.php


@include 'config.php'; // Include your database configuration

session_start();


// Check if the user's ID and name are provided in the URL parameters
if (isset($_GET['trainerId']) && isset($_GET['traineeId'])){
    $trainerId = $_GET['trainerId'];
    $traineeId = urldecode($_GET['traineeId']); // Decode the URL-encoded name

    // Update the trainer_id column in the trainer table
    $updateQuery = "UPDATE trainer SET trainer_id = $trainerId WHERE trainee_id = $traineeId";
    mysqli_query($conn, $updateQuery);

    // Redirect back to the page where the link was clicked
    header('Location: admin_page.php');
    exit;
} else {
    // Handle the case when the user ID or name is not provided in the URL.
    // For example, you might redirect the user or show an error message.
    header('login_form.php');
}


?>
