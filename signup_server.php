<body>
  <?php include 'menu.html';?>
  <?php include 'mysql_connect.php';?>
  <?php
    
    $errors = array();
    $username = $_POST['username'];
    $password_unhash = $_POST['password'];
    $password = password_hash(
    $_POST['password'],PASSWORD_DEFAULT);

    if (empty($username)) {
      array_push($errors, "Your username is empty");
    }
    if (empty($password_unhash)) {
      array_push($errors, "Your password is empty");
    }

    if(count($errors) === 0) {
      $stmt = $conn->prepare("SELECT * FROM user WHERE username = '$username' LIMIT 1");
      $stmt->execute();
      $resultarr = $stmt->get_result();
      if ($resultarr->num_rows > 0) {
          $result = $resultarr->fetch_assoc();
          if ($result['username'] === $username) {
          array_push($errors, "Please choose another username. This username already exists");
        }
      } 
      if(count($errors) === 0){
        $stmt2 = $conn->prepare("insert into user (username, password) values('$username', '$password')");
        $success = $stmt2->execute();
      }
    }
  ?>
  <p>
    <?php
      if (isset($success)) {
        if (!$success) {
          print('Signup failed: '. $stmt->error);
        } 
      }
      if (count($errors) >0) {
        foreach($errors as $error) {
          print($error);
        }
      }
      else {
        print('Signup successful');
      }
    ?>
  </p>
</body>


