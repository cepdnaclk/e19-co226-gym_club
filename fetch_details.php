<?php
@include 'config.php';
$u_id = $_POST["user_id"];
$sql = "SELECT age, gender, height, weight from user_form where id = $u_id";
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
<span>Membership ID: <?php echo $u_id ?></span>
<span>Age: <?php echo $age; ?></span>
<span>Gender: <?php echo $gender; ?></span>
<span>Height: <?php echo $height; ?> cm</span>
<span>Weight: <?php echo $weight; ?> kg</span>