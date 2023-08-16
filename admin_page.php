<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) { //If the 'user_name' session variable is not set, this line redirects the user to the login page.
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
  <title>Trainer Home</title>

  <link rel="stylesheet" href="styles/admin_style.css">

  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->
  <script src="./scripts/jquery.min.js"></script>
  <script src="./scripts/jquery-ui.min.js"></script>

  <!-- Script for My Trainees Table -->
  <script>
    function showDialogBox(Title, Content, callback) {
      $('#dialog').dialog({
        title: Title,
        autoOpen: false,
        show: {
          effect: 'fade',
          duration: 200
        },
        hide: {
          effect: 'fade',
          duration: 200
        },
        modal: true,
        resizable: false,
        height: "auto",
        width: 500,
        position: {
          my: "center",
          at: "center",
          of: window
        },
        buttons: {
          "Yes": function() {
            $(this).dialog("close");
            if (typeof callback === "function") {
              callback();
            }
          },
          "No": function() {
            $(this).dialog("close");
          }
        },
        open: function(event, ui) {
          $('<div class="custom-overlay"></div>').appendTo('body');
        },
        close: function(event, ui) {
          $('.custom-overlay').remove();
        }
      });
      $(".dialog-content").text(Content);
      $("#dialog").dialog("open");
    }

    function updateMyTraineesTable() {
      var userId = <?php echo $_SESSION["user_id"]; ?>;
      var dataToSend = {
        user_id: userId
      };

      $.ajax({
        url: "fetch_trainees.php",
        method: "POST",
        data: dataToSend,
        success: function(response) {
          $("#my_trainees_table").html(response);
        },
        error: function(xhr, status, error) {
          alert("Error: " + xhr.status + ": " + xhr.statusText);
        }
      });
    }

    function bindMyTraineesOnClick() {
      $('#my_trainees_table').on('click', '.a_rm_trainee', function(event) {

        var trainerId = $(this).data('trainer-id'); // Get the trainer ID from the data attribute
        var traineeId = $(this).data('trainee-id'); // Get the trainee ID from the data attribute

        var url = "remove_trainer.php?trainerId=" + trainerId + "&traineeId=" + encodeURIComponent(traineeId);

        showDialogBox("Remove Trainee", "Are you sure you want to remove " + $(this).text() + " from your assigned trainees list?", function() {
          $.ajax({
            url: url,
            method: "GET",
            success: function(response) {
              updateMyTraineesTable(); //Refresh the table after removing
              updateAvailableTraineesTable();
            },
            error: function(xhr, status, error) {
              alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
          });
        })

      });
    }

    function updateAvailableTraineesTable() {
      var userId = <?php echo $_SESSION["user_id"]; ?>;
      var dataToSend = {
        user_id: userId
      };

      $.ajax({
        url: "fetch_available.php",
        method: "POST",
        data: dataToSend,
        success: function(response) {
          $("#available_trainees_table").html(response);
        },
        error: function(xhr, status, error) {
          alert("Error: " + xhr.status + ": " + xhr.statusText);
        }
      });
    }

    function bindAvailableTraineesOnClick() {
      $('#available_trainees_table').on('click', '.a_add_trainee', function(event) {

        var trainerId = $(this).data('trainer-id'); // Get the trainer ID from the data attribute
        var traineeId = $(this).data('trainee-id'); // Get the trainee ID from the data attribute

        var url = "update_trainer.php?trainerId=" + trainerId + "&traineeId=" + encodeURIComponent(traineeId);

        showDialogBox("Add Trainee", "Are you sure you want to add " + $(this).text() + " to your assigned trainees list?", function() {
          $.ajax({
            url: url,
            method: "GET",
            success: function(response) {
              updateAvailableTraineesTable(); //Refresh the table after adding
              updateMyTraineesTable();
            },
            error: function(xhr, status, error) {
              alert("Error: " + xhr.status + ": " + xhr.statusText);
            }
          });
        })
      });
    }

    $(document).ready(function() {
      updateMyTraineesTable();
      bindMyTraineesOnClick();
      updateAvailableTraineesTable();
      bindAvailableTraineesOnClick();
    });
  </script>

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
      <h3>Welcome back, <span class="user_type">Coach</span></h3>
      <h3><span class="user_name"><?php echo $_SESSION['admin_name'] ?></span></h3>
    </div>

  </div>

  <div class="UD_sect">
    <div class="user_details">
      <div class="icon">
        <span class="material-symbols-rounded">Account_circle</span>
      </div>
      <div class="details">
        <div id="details-text">
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

      <a href="#" class="card-edit-link">
        <span class="material-symbols-rounded">edit_square</span>
      </a>
    </div>
  </div>


  <div class="SUB_sect">
    <div class="WO_Sect">
      <h2>Your Trainees</h2>
      <div class="WOS_card">
        <span>These are the traineese that are currently assigned to you. You can remove anyone by clicking on their name.</span>
        <div id="my_trainees_table">
          <!-- Table contents generated by JS -->
        </div>
      </div>
    </div>
  </div>

  <div class="SUB_sect">
    <div class="WO_Sect">
      <h2>Avaliable Trainees</h2>
      <div class="WOS_card">
        <span>These are the trainese that isn't currently assigned to any coach. You can adopt anyone by clicking on their name.</span>
        <div id="available_trainees_table">
          <!-- Table contents generated by JS -->
        </div>
      </div>
    </div>
  </div>


  <div id="dialog" title="title" style="display: none;">
    <span class="material-symbols-rounded" style="font-size: 60px; margin-right: 20px;">warning</span>
    <span class="dialog-content">Content goes here?</span>
  </div>

</body>

</html>