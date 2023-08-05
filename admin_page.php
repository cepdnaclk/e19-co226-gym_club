<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){ //If the 'user_name' session variable is not set, this line redirects the user to the login page.
   header('location:index.php');
}
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
  // Use $userId as needed, e.g., for database queries or displaying user-specific content.

  
} else {
  // Handle the case when the user ID is not available in the session.
}

if (isset($_SESSION['user_type'])) {
   $user_type = $_SESSION['user_type'];
   // Use $userId as needed, e.g., for database queries or displaying user-specific content.
 
   
 } else {
   // Handle the case when the user ID is not available in the session.
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style-landing.css">
   <link rel="stylesheet" href="css/table-style.css">
   <link rel="stylesheet" href="css/button-style.css">
   <script src="https://kit.fontawesome.com/ce26a37708.js" crossorigin="anonymous"></script>

</head>

<style>
      body {
          background-image: linear-gradient(to right, #F5F7FA, #B8C6DB);
          margin: 0;
          padding: 0;
          font-family: sans-serif;
          color: #333;
      }
      /* Other CSS rules go here */
   </style>

<body>
   
<div class="banner">

   <div class="content">
      <h3>Hi, <span>Coach</span></h3>
      <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <h2>Membership ID <span><?php echo $_SESSION['user_id'] ?></span></h2>
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
      <?php
        $sql = "SELECT age, gender, height, weight from user_form where id = $_SESSION[user_id]";
        $result = $conn-> query($sql);

        if ($result->num_rows > 0) {
          // Fetch the user details from the result set.
          $row = $result->fetch_assoc();
          $age = $row['age'];
          $gender = $row['gender'];
          $height = $row['height'];
          $weight = $row['weight'];
        } else {
            // Handle the case when user details are not found in the database.
            // You can display default values or show an error message.
        }
        
        ?>
        <p>Age: <?php echo $age; ?></p>
        <p>Gender: <?php echo $gender; ?></p>
        <p>Height: <?php echo $height; ?></p>
        <p>Weight: <?php echo $weight; ?></p>
    </div>
  </div>
</div>

<div class="WO_Sect">
    <h2>Your Trainees</h2>
    <div class="WOS_card">
    <ul>
      <li><a href="">Click on the name of the trainee to remove</a></li>
      <div class="workout-table">
      <table>
        <tr>
          <th>Name</th>
          <th>Gender</th>
          <th>Goal Type</th>
        </tr>
        <?php
        //$sql = "SELECT name, gender from user_form where user_type = $_SESSION[user_type]";
        $sql = "SELECT uf.id, uf.name, uf.gender, fg.goal_type
               FROM user_form uf 
               JOIN target t ON uf.id = t.UId
               JOIN fitness_goal fg ON t.goal_id = fg.goal_id
               LEFT JOIN trainer tr ON uf.id = tr.trainee_id
               WHERE user_type = 'user' AND tr.trainer_id =$_SESSION[user_id]";
        $result = $conn-> query($sql);

        if ($result-> num_rows >0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            //echo "<td><a href=\"exercise_log.php?id=".$row["SessionId"]."\">".$row["Date"]."</a></td>";
            echo "<td><a href=\"remove_trainer.php?trainerId=".$_SESSION["user_id"]."&traineeId=" . urlencode($row["id"]) ."\">".$row["name"]."</a></td>";
            echo "<td>".$row["gender"]."</td>";
            echo "<td>".$row["goal_type"]."</td>";
            echo "</tr>";
          }
          echo "</table>";
        }
        else{
          echo "You haven't added any Trainees yet";
        }
        ?>
      </table>
      </div>
    </ul>
    
    </div>
</div>




<div class="WO_Sect">
    <h2>Select Trainees</h2>
    <div class="WOS_card">
    <ul>
      <li><a href="">Click on the name of the trainee to add</a></li>
      <div class="workout-table">
      <table>
        <tr>
          <th>Name</th>
          <th>Gender</th>
          <th>Goal Type</th>
        </tr>
        <?php
        //$sql = "SELECT name, gender from user_form where user_type = $_SESSION[user_type]";
        $sql = "SELECT uf.id, uf.name, uf.gender, fg.goal_type
               FROM user_form uf 
               JOIN target t ON uf.id = t.UId
               JOIN fitness_goal fg ON t.goal_id = fg.goal_id
               LEFT JOIN trainer tr ON uf.id = tr.trainee_id
               WHERE user_type = 'user' AND tr.trainer_id IS NULL";
        $result = $conn-> query($sql);

        if ($result-> num_rows >0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            //echo "<td><a href=\"exercise_log.php?id=".$row["SessionId"]."\">".$row["Date"]."</a></td>";
            echo "<td><a href=\"update_trainer.php?trainerId=".$_SESSION["user_id"]."&traineeId=" . urlencode($row["id"]) ."\">".$row["name"]."</a></td>";
            echo "<td>".$row["gender"]."</td>";
            echo "<td>".$row["goal_type"]."</td>";
            echo "</tr>";
          }
          echo "</table>";
        }
        else{
          echo "There are no available Trainees";
        }
        ?>
      </table>
      </div>
    </ul>
    
    </div>
</div>


</body>
</html>