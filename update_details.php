<?php
// wo_session.php

@include 'config.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // If the user is not logged in, redirect to the login page or show an error message.
    header('location:login_form.php');
    exit; // Optional, to stop further execution.
}

// Assuming you have a valid session, retrieve the Uid from the URL parameter.
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
} else {
    // Handle the case when the Uid is not provided in the URL. You might redirect the user or show an error message.
    // Example:
    header('location: login_form.php');
    exit; // Optional, to stop further execution.
}

// Form submission handling
if (isset($_POST['submit'])) {
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);

    // Perform validation on the submitted data (e.g., check if the date and duration are valid, etc.)

    // Perform the update query
    $updateQuery = "UPDATE user_form SET age = $age, height = $height, weight = $weight WHERE id = $uid";
    mysqli_query($conn, $updateQuery);


    // Redirect after form submission
    header('location:member_page.php'); // Replace 'index.php' with the appropriate page where you want to redirect after form submission.
    exit; // Optional, to stop further execution.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update details form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Update Your Details</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="age" required placeholder="Age">
      <input type="text" name="height" required placeholder="Height">
      <input type="text" name="weight" required placeholder="Weight">
      <input type="submit" name="submit" value="Submit" class="form-btn">
   </form>

</div>

</body>
</html>