<?php session_start();
@include 'config.php'; ?>

<?php

if (isset($_POST['submit'])) {

   //$name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   //$cpass = md5($_POST['cpassword']);
   //$user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_array($result);

      if ($row['user_type'] == 'admin') {

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_type'] = $row['user_type'];
         header('location:admin_page.php');
      } elseif ($row['user_type'] == 'user') {
         $_SESSION['user_id'] = $row['id']; // Store the user ID in the session.
         $_SESSION['user_name'] = $row['name'];
         header('location:member_page.php');
      }
   } else {
      $error[] = 'incorrect email or password!';
   }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Log in</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styles/login_style.css">

</head>


<body>
   <div class="backg">
      <div id="card">
         <div id="thumb"></div>
         <div id="title">
            <span class="main-let">G</span>ym<span class="main-let">C</span>lub
         </div>
      </div>
   </div>

   <div id="mfollower"></div>
   <div class="top">
      <div class="form-container">

         <form action="" method="post">
            <h3>
               <span class="red-let">W</span>elcome
            </h3>
            <?php
            if (isset($error)) {
               foreach ($error as $error) {
                  echo '<span class="error-msg">' . $error . '</span>';
               };
            };
            ?>
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>Don't have an account yet? <a href="register_form.php">Create one.</a></p>
         </form>

      </div>
   </div>


   <script>
      const mfl = document.getElementById("mfollower");
      const test = document.getElementById("card");

      document.addEventListener("mousemove", event => {
         const {
            pageX,
            pageY
         } = event;

         var e = -(window.innerWidth / 2 - pageX) / 50,
            n = -(window.innerHeight / 2 - pageY) / 150;

         test.style.transform = 'rotateY(' + e + 'deg) rotateX(' + n + 'deg)';

         mfl.animate({
            left: `${pageX}px`,
            top: `${pageY}px`
         }, {
            duration: 2000,
            fill: "both"
         });
      });
   </script>

</body>

</html>