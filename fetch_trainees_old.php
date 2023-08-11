<?php

@include 'config.php'; // Include your database configuration

session_start();

$sql = "SELECT uf.id, uf.name, uf.gender, fg.goal_type
               FROM user_form uf 
               JOIN target t ON uf.id = t.UId
               JOIN fitness_goal fg ON t.goal_id = fg.goal_id
               LEFT JOIN trainer tr ON uf.id = tr.trainee_id
               WHERE user_type = 'user' AND tr.trainer_id =$_SESSION[user_id]";
$result = $conn->query($sql);
$resultsArray = array(); // Initialize an empty array

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $resultsArray[] = $row; // Append each row to the array
  }
}

echo json_encode($resultsArray); // Encode the array to JSON
?>