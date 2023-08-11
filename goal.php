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
    $goal_id = mysqli_real_escape_string($conn, $_POST['goal_id']);

    // Perform validation on the submitted data (e.g., check if the date and duration are valid, etc.)

    // Perform the update query
    $update_query = "UPDATE target
                    SET goal_id = '$goal_id'
                    WHERE UId = '$uid'";

    mysqli_query($conn, $update_query);

    // Redirect after form submission
    header('location:member_page.php'); // Replace 'index.php' with the appropriate page where you want to redirect after form submission.
    exit; // Optional, to stop further execution.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Evenly Spread Cards</title>
  <link rel="stylesheet" href="css/goal_style.css">
  <!-- <link rel="stylesheet" href="css/style-landing.css"> -->
</head>
<body>
    <header>
    <h2>Select Your Goal</h2>
    </header>

    <section class="container">
        <div class="card">
            <div class="card-image  card-1"></div>
            <h2>Muscle Gain</h2>
            <p>Sculpt your physique and embrace a new level of strength with our Muscle Gain program. Elevate your weight and strength while enhancing muscle definition. Unlock a new chapter of confidence as you see your hard work and dedication transform your body.</p>
            <form action="" method="post">
                <!-- You can use a hidden input field to pass the desired value -->
                <input type="hidden" name="goal_id" value="1">
                <input type="submit" name="submit" value="Submit" class="form-btn">
            </form>
        </div>
        <div class="card">
            <div class="card-image card-2"></div>
            <h2>Weight Loss</h2>
            <p>Embark on a transformative journey with our Weight Loss program. Shed those extra pounds, redefine your body's contours, and discover a healthier version of yourself. Embrace a new lifestyle filled with energy, vitality, and the satisfaction of achieving your weight loss goals.</p>
            <form action="" method="post">
                <!-- You can use a hidden input field to pass the desired value -->
                <input type="hidden" name="goal_id" value="2">
                <input type="submit" name="submit" value="Submit" class="form-btn">
            </form>
        </div>
        <div class="card">
            <div class="card-image card-3"></div>
            <h2>Cardiovascular Health</h2>
            <p>Elevate your heart health and vitality through our Cardiovascular Health program. Improve your endurance, strengthen your heart, and fuel your body with the benefits of cardiovascular exercise. Embrace the path to long-lasting wellness and a thriving heart.</p>
            <form action="" method="post">
                <!-- You can use a hidden input field to pass the desired value -->
                <input type="hidden" name="goal_id" value="3">
                <input type="submit" name="submit" value="Submit" class="form-btn">
            </form>
        </div>
    </section>

    <section class="container">
        <div class="card">
            <div class="card-image  card-4"></div>
            <h2>Strength Training</h2>
            <p>Unleash your inner strength with our Strength Training program. Build a foundation of power, agility, and muscle resilience. Whether you're a novice or a seasoned athlete, this program will empower you to conquer challenges and achieve peak performance.</p>
            <form action="" method="post">
                <!-- You can use a hidden input field to pass the desired value -->
                <input type="hidden" name="goal_id" value="4">
                <input type="submit" name="submit" value="Submit" class="form-btn">
            </form>
        </div>
        <div class="card">
            <div class="card-image card-5"></div>
            <h2>Flexibility and Mobility</h2>
            <p>Discover the art of flexibility and mobility with our specialized program. Enhance your body's range of motion, release tension, and improve posture. Unwind and rejuvenate as you unlock newfound flexibility, contributing to your overall well-being.</p>
            <form action="" method="post">
                <!-- You can use a hidden input field to pass the desired value -->
                <input type="hidden" name="goal_id" value="5">
                <input type="submit" name="submit" value="Submit" class="form-btn">
            </form>
        </div>
        <div class="card">
            <div class="card-image card-6"></div>
            <h2>Overall Wellness</h2>
            <p>Embrace holistic wellness with our comprehensive program designed to elevate every aspect of your life. Maintain your body's harmony, mental clarity, and emotional balance. Reap the rewards of vitality and enjoy a life of well-rounded health.</p>
            <form action="" method="post">
                <!-- You can use a hidden input field to pass the desired value -->
                <input type="hidden" name="goal_id" value="6">
                <input type="submit" name="submit" value="Submit" class="form-btn">
            </form>
        </div>
    </section>

</body>
</html>
