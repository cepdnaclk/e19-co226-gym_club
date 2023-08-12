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
      <a href="update_details.php?uid=<?php echo $_SESSION['user_id']; ?>" class="card-edit-link">
        <span class="material-symbols-rounded">edit_square</span>
      </a>
    </div>
  </div>

  <div class="SUB_sect">
    <h2>Current Fitness Goal</h2>
    <div id="goal_card">
      <span id="goal_intro">Here, you can set your fitness goal to tailor your workout routine and track your progress towards achieving a healthier and fitter lifestyle. Click on the card below to get started.</span>
      <a href="goal.php?uid=<?php echo $_SESSION['user_id']; ?>" class="card-edit-link">
        <div class="goal_details">
          <?php
          $sql = "SELECT goal_id, goal_type, target_weight, target_bodyfat, target_calories from fitness_goal where goal_id = (SELECT goal_id from target WHERE UId = $_SESSION[user_id])";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Fetch the user details from the result set.
            $row = $result->fetch_assoc();
            $goal_id = $row['goal_id'];
            $goal_type = $row['goal_type'];
            $target_weight = $row['target_weight'];
            $target_bodyfat = $row['target_bodyfat'];
            $target_calories = $row['target_calories'];

            echo <<<EOL
            <div class="image-container">
              <div class="image-wrapper">
                <img src="../gym_membership/images/goals/goal_{$goal_id}.jpg" alt="Your Image">
              </div>
            </div>
            <div class="details">
              <span class="s-line-title">{$goal_type}</span>
              <div class="s-line"><span>Target Weight (in kg):</span><span class="s-line-val">{$target_weight}</span></div>
              <div class="s-line"><span>Target Bodyfat (as percentage):</span><span class="s-line-val">{$target_bodyfat}</span></div>
              <div class="s-line"><span>Target Calories (calories per day): </span><span class="s-line-val">{$target_calories}</span></div>
            </div>
            EOL;
          } else {
            echo <<<EOL
            <div id="no-goal">
              <span class="material-symbols-rounded">heart_plus</span>
              <span>You haven't set a goal yet. Click here to get started!</span>
            </div>
            EOL;
          }
          ?>
        </div>
      </a>
    </div>
  </div>




  <div class="SUB_sect">
    <h2>Workout Sessions</h2>
    <div class="WOS_sect">
      <span>Here you can add and edit details about your existing workout sessions. Click on a session date to change any details.</span>
      <div class="workout-table">
        <table>
          <tr>
            <td colspan="3" class="wos-add">
              <a href="wo_session.php?uid=<?php echo $_SESSION['user_id']; ?>">
                <div>
                  <span class="material-symbols-rounded">forms_add_on</span>
                  <span class="span-text">Add a workout session</span>
                </div>
              </a>
            </td>
          </tr>
          <tr>
            <th>Date</th>
            <th>Burned Calories</th>
            <th>Duration</th>
          </tr>
          <?php
          $sql = "SELECT SessionId, Date, BurnedCalories, Duration from workout_session where UId = $_SESSION[user_id] ORDER BY Date DESC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr class='data_row'>";
              //echo "<td><a href=\"exercise_log.php?id=".$row["SessionId"]."\">".$row["Date"]."</a></td>";
              echo "<td><a href=\"exercise_log.php?sessionId=" . $row["SessionId"] . "\">" . $row["Date"] . "</a></td>";
              echo "<td>" . $row["BurnedCalories"] . "</td>";
              echo "<td>" . $row["Duration"] . "</td>";
              echo "</tr>";
            }
            echo "</table>";
          } else {
            echo "<td colspan='3'>You haven't added any workout sessions yet. Click above to get started!</td>";
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>