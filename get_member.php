<?php

// get_member.php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Get Members</title>
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style2.css">

</head>
<div class="container">
<body>
   
   <h1>Get Members Page</h1>
   <!-- Place your content here -->

   <a href="admin_page.php" class="back-btn">Back</a>

</body>
</div>
</html>
