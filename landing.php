<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){ //If the 'user_name' session variable is not set, this line redirects the user to the login page.
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style-landing.css">
   <script src="https://kit.fontawesome.com/ce26a37708.js" crossorigin="anonymous"></script>

</head>
<body>
   
<div class="banner">

   <div class="content">
      <h3>Hi, <span>member</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>this is a sample member page</p>
      <!-- <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a> -->
      <a href="logout.php" class="btn">
        <i class="fas fa-sign-out"></i> Logout
      </a>
   </div>

</div>

<div class="UD_sect">
  <div class="user_details">
    <div class="icon">
      <span class="fas fa-user fa-10x"></span>
    </div>
    <div class="details">
      <h3 class="card-title">Test Surname</h3>
      <p>Gender: Male</p>
      <p>Height: 10m</p>
      <p>Weight: 70kg</p>
      <p>Body Fate: 1kg</p>
    </div>
  </div>
</div>

<div class="goal_carousel">
  <h2>Current Fitness Goals</h2>
  <ul class="cards">
    <li class="card">
      <div>
        <h3 class="card-title">Dumbell Training</h3>
        <div class="card-content">
          <span class="fas fa-dumbbell fa-5x"></span>
          <p>Welcome to our dumbbell training program! Whether you're a beginner or an experienced lifter, our trainers will help you achieve your fitness goals. With our comprehensive training plans and expert guidance, you'll build muscle, burn fat, and improve your overall health and well-being.</p>
        </div>
      </div>
      <div class="card-link-wrapper">
        <a href="" class="card-link">Change Goal</a>
      </div>
    </li>
    <li class="card">
      <div>
        <h3 class="card-title">Goal 2</h3>
        <div class="card-content">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab repudiandae magnam harum natus fuga et repellat in maiores.</p>
        </div>
      </div>
      <div class="card-link-wrapper">
        <a href="" class="card-link">Learn More</a>
      </div>
    </li>
    <li class="card">
      <div>
        <h3 class="card-title">Goal 3</h3>
        <div class="card-content">
          <p>Phasellus ultrices lorem vel bibendum ultricies. In hendrerit nulla a ante dapibus pulvinar eu eget quam.</p>
        </div>
      </div>
      <div class="card-link-wrapper">
        <a href="" class="card-link">Learn More</a>
      </div>
    </li>
  </ul>
</div>

<div class="WO_Sect">
    <h2>Workout Sessions</h2>
    <div class="WOS_card">
    <ul>
      <li><a href="">Item 1</a></li>
      <li><a href="">Item 2</a></li>
      <li><a href="">Item 3</a></li>
    </ul>
    </div>
</div>


</body>
</html>