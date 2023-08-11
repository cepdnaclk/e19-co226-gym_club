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

// Assuming you have a valid session, retrieve the Uid from the URL parameter./
if (isset($_GET['sessionId'])) {
    $sessionId = $_GET['sessionId'];

    // Now you have the $sessionId and can use it as needed, e.g., to fetch details of the workout session with this ID.
    // Perform further processing as required.
} else {
    // If the sessionId is not provided in the URL, you can redirect the user or show an error message.
    // Example:
    header('location: member_page.php');
    exit; // Optional, to stop further execution.
}

// Form submission handling
if (isset($_POST['submit'])) {
    $ex_type = mysqli_real_escape_string($conn, $_POST['ex_type']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $sets = mysqli_real_escape_string($conn, $_POST['sets']);
    $reps = mysqli_real_escape_string($conn, $_POST['reps']);

    // Perform validation on the submitted data (e.g., check if the date and duration are valid, etc.)

    // Assuming you have the "workout_sessions" table with columns "SessionId," "BurnedCalories," "Date," "Duration," and "Uid"
    $insert = "INSERT INTO exercise_log(ex_type, sets, reps, weight , SesId) VALUES ( '$ex_type', '$sets', '$reps', '$weight', '$sessionId')";
    mysqli_query($conn, $insert);

    // Redirect after form submission
    header('location: exercise_log.php?sessionId=' . $sessionId); // Replace 'index.php' with the appropriate page where you want to redirect after form submission.
    //exit; // Optional, to stop further execution.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style-exlog.css">
   <link rel="stylesheet" href="css/table-style.css">
   <link rel="stylesheet" href="css/back-button.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Exercise Log</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="ex_type" required placeholder="Exercise type">
      <input type="text" name="weight" required placeholder="Trained Weight (Kg)">
      <div = class="row::after input-container"> 
        <input type="text" name="sets" required placeholder="Number of sets">
        <input type="text" name="reps" required placeholder="Number of reps">
      </div>
      <input type="submit" name="submit" value="Submit" class="form-btn">
   </form>

</div>

<!-- <div class="btn">
   <a href="member_page.php?sessionId=<?php echo $sessionId; ?>" class="form-btn">Back</a>
</div> -->
<div class="containar">
   <a href="member_page.php?sessionId=<?php echo $sessionId; ?>" class="form-btn btn">Back</a>
</div>

<!-- <div class="form-container">

   <form action="" method="post">
      <input type="submit" name="submit" value="Submit" class="form-btn">
   </form>

</div> -->


<div class="workout-table">
      <table>
        <tr>
          <th>Exercise Type</th>
          <th>Weight</th>
          <th>Sets</th>
          <th>Reps</th>
        </tr>
        <?php
        $sql = "SELECT ex_type, sets, reps, weight from exercise_log where SesId = $sessionId";
        $result = $conn-> query($sql);

        if ($result-> num_rows >0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            //echo "<td><a href=\"exercise_log.php?id=".$row["SessionId"]."\">".$row["Date"]."</a></td>";
            echo "<td>".$row["ex_type"]."</td>";
            echo "<td>".$row["weight"]."</td>";
            echo "<td>".$row["sets"]."</td>";
            echo "<td>".$row["reps"]."</td>";
            echo "</tr>";
          }
          echo "</table>";
        }
        else{
          echo "0 results";
        }
        ?>
      </table>
      </div>

</body>
</html>