<?php session_start(); ?>
<body>
  <?php include 'menu.html';?>
  <?php include 'mysql_connect.php';?>
  <?php
    $username = $_POST['username'];
    $stmt = $conn->prepare("select * from user where username = '$username'");
    $stmt->execute();
  ?>
  <p>
    <?php
      $result = $stmt->get_result();
      if ($result->num_rows == 0) {
        print('No account found');
      }
      else {
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row['password'])) {
          print('Hi '.$row['username'].', you are logged in.');
          $_SESSION['username'] = $row['username'];
          $_SESSION['id'] = $row['id'];
        }
        else {
          print('Wrong password.');
        }
      }
    ?>
  </p>
</body>