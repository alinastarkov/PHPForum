<?php include 'mysql_connect.php';?>
<?php
  $id = $_POST['userID'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  print($title);
  $stmt = $conn->prepare("insert into post (creator, title, content) values(?,?,?)");
  $stmt->bind_param("iss", $id, $title, $content);
  $success = $stmt->execute();
  if (!$success){
    echo json_encode($stmt->error); 
  } else {
    echo json_encode(array("statusCode"=>200));
    echo("SUCCESSS!!");
  }
?>

