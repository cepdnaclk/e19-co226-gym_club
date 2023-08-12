<?php
// goal.php

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Goal</title>

    <link rel="stylesheet" href="styles/goals_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
        function bindOnClick() {
            $('#card-carousel').on('click', '.card', function(event) {
                var goalID = $(this).data('goal-id'); // Get the goal ID from the data attribute
                var userID = <?php echo $_SESSION["user_id"]; ?>;

                var url = "update_goal.php?user_id=" + userID + "&goal_id=" + goalID;

                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        window.location.href = "member_page.php#goal_card";
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + xhr.status + ": " + xhr.statusText);
                    }
                });
            });
        }

        $(document).ready(function() {
            bindOnClick();
        })
    </script>
</head>

<body>
    <div id="body-wrapper">
        <span id="title">Select your desired goal</span>
        <div id="card-carousel">

            <div class="card" data-goal-id="1">
                <div class="card-img">
                    <div class="image-container">
                        <img src="../gym_membership/images/goals/goal_1.jpg" alt="Goal_image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="card-text">
                    <h2>Muscle Gain</h2>
                    <span>Sculpt your physique and embrace a new level of strength with our Muscle Gain program. Elevate your weight and strength while enhancing muscle definition. Unlock a new chapter of confidence as you see your hard work and dedication transform your body.</span>
                </div>
            </div>

            <div class="card" data-goal-id="2">
                <div class="card-img">
                    <div class="image-container">
                        <img src="../gym_membership/images/goals/goal_2.jpg" alt="Goal_image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="card-text">
                    <h2>Weight Loss</h2>
                    <span>Embark on a transformative journey with our Weight Loss program. Shed those extra pounds, redefine your body's contours, and discover a healthier version of yourself. Embrace a new lifestyle filled with energy, vitality, and the satisfaction of achieving your weight loss goals.</span>
                </div>
            </div>

            <div class="card" data-goal-id="3">
                <div class="card-img">
                    <div class="image-container">
                        <img src="../gym_membership/images/goals/goal_3.jpg" alt="Goal_image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="card-text">
                    <h2>Cardiovascular Health</h2>
                    <span>Elevate your heart health and vitality through our Cardiovascular Health program. Improve your endurance, strengthen your heart, and fuel your body with the benefits of cardiovascular exercise. Embrace the path to long-lasting wellness and a thriving heart.</span>
                </div>
            </div>

            <div class="card" data-goal-id="4">
                <div class="card-img">
                    <div class="image-container">
                        <img src="../gym_membership/images/goals/goal_4.jpg" alt="Goal_image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="card-text">
                    <h2>Strength Training</h2>
                    <span>Unleash your inner strength with our Strength Training program. Build a foundation of power, agility, and muscle resilience. Whether you're a novice or a seasoned athlete, this program will empower you to conquer challenges and achieve peak performance.</span>
                </div>
            </div>

            <div class="card" data-goal-id="5">
                <div class="card-img">
                    <div class="image-container">
                        <img src="../gym_membership/images/goals/goal_5.jpg" alt="Goal_image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="card-text">
                    <h2>Flexibility and Mobility</h2>
                    <span>Discover the art of flexibility and mobility with our specialized program. Enhance your body's range of motion, release tension, and improve posture. Unwind and rejuvenate as you unlock newfound flexibility, contributing to your overall well-being.</span>
                </div>
            </div>

            <div class="card" data-goal-id="6">
                <div class="card-img">
                    <div class="image-container">
                        <img src="../gym_membership/images/goals/goal_6.jpg" alt="Goal_image">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="card-text">
                    <h2>Overall Wellness</h2>
                    <span>Embrace holistic wellness with our comprehensive program designed to elevate every aspect of your life. Maintain your body's harmony, mental clarity, and emotional balance. Reap the rewards of vitality and enjoy a life of well-rounded health.</span>
                </div>
            </div>

        </div>
    </div>

</body>

</html>