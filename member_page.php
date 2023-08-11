<?php session_start();

@include 'config.php';

if (!isset($_SESSION['user_name'])) { //If the 'user_name' session variable is not set, this line redirects the user to the login page.
  header('location:login_form.php');
}
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
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
  <title>Member Home</title>

  <link rel="stylesheet" href="styles/member_style.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

</head>

<body>

  <nav class="navbar">
    <div class="navbar-logo"></div>
    <a id="log-out" href="logout.php">
      <span class="material-symbols-rounded">Logout</span>
      <span> Logout</span>
    </a>
  </nav>

  <div class="banner">

    <div class="content">
      <h3>Welcome back, <span class="user_type">Buddy</span></h3>
      <h3><span class="user_name"><?php echo $_SESSION['user_name'] ?></span></h3>
    </div>

  </div>
  
  <div class="UD_sect">
    <div class="user_details">
      <div class="icon">
        <span class="material-symbols-rounded">Account_circle</span>
      </div>
      <div class="details">
        <?php
        $sql = "SELECT age, gender, height, weight from user_form where id = $_SESSION[user_id]";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Fetch the user details from the result set.
          $row = $result->fetch_assoc();
          $age = $row['age'];
          $gender = $row['gender'];
          $height = $row['height'];
          $weight = $row['weight'];
        } else {
          // Handle the case when user details are not found in the database.
        }

        ?>
        <span>Membership ID: <?php echo $_SESSION['user_id'] ?></span>
        <span>Age: <?php echo $age; ?></span>
        <span>Gender: <?php echo $gender; ?></span>
        <span>Height: <?php echo $height; ?> cm</span>
        <span>Weight: <?php echo $weight; ?> kg</span>
      </div>
    </div>
  </div>
  <a href="update_details.php?uid=<?php echo $_SESSION['user_id']; ?>" class="card-link">Update Details</a>

  <div class="UD_sect">
    <h2>Current Fitness Goals</h2>
    <div class="user_details">
      <div class="icon">
        <span class="fas fa-user fa-10x"></span>
      </div>
      <div class="details">
        <?php
        $sql = "SELECT goal_id, goal_type, target_weight, target_bodyfat, target_calories from fitness_goal where goal_id = (SELECT goal_id from target WHERE UId = $_SESSION[user_id])";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Fetch the user details from the result set.
          $row = $result->fetch_assoc();
          $goal_type = $row['goal_type'];
          $target_weight = $row['target_weight'];
          $target_bodyfat = $row['target_bodyfat'];
          $target_calories = $row['target_calories'];
        } else {
          // Handle the case when user details are not found in the database.
          // You can display default values or show an error message.
          $goal_type = "Not yet selected";
          $target_weight = "Not yet selected";
          $target_bodyfat = "Not yet selected";
          $target_calories = "Not yet selected";
        }

        ?>
        <p>Goal Type: <?php echo $goal_type; ?></p>
        <p>Target Weight(Kg): <?php echo $target_weight; ?></p>
        <p>Target Bodyfat (%): <?php echo $target_bodyfat; ?></p>
        <p>Target Calories (calories/day): <?php echo $target_calories; ?></p>
      </div>
      <div class="btn">
        <a href="goal.php?uid=<?php echo $_SESSION['user_id']; ?>" class="card-link">Change Goal</a>
      </div>
    </div>
  </div>



  <div class="WO_Sect">
    <h2>Workout Sessions</h2>
    <div class="WOS_card">
      <ul>
        <li><a href="wo_session.php?uid=<?php echo $_SESSION['user_id']; ?>">Add Workout Sessions</a></li>
        <div class="workout-table">
          <table>
            <tr>
              <th>Date</th>
              <th>Burned Calories</th>
              <th>Duration</th>
            </tr>
            <?php
            $sql = "SELECT SessionId, Date, BurnedCalories, Duration from workout_session where UId = $_SESSION[user_id]";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                //echo "<td><a href=\"exercise_log.php?id=".$row["SessionId"]."\">".$row["Date"]."</a></td>";
                echo "<td><a href=\"exercise_log.php?sessionId=" . $row["SessionId"] . "\">" . $row["Date"] . "</a></td>";
                echo "<td>" . $row["BurnedCalories"] . "</td>";
                echo "<td>" . $row["Duration"] . "</td>";
                echo "</tr>";
              }
              echo "</table>";
            } else {
              echo "0 results";
            }
            ?>
          </table>
        </div>
      </ul>

    </div>
  </div>


</body>

</html>