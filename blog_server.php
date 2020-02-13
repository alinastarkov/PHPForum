<?php include 'mysql_connect.php';?>
<?php
  $id = $_POST['userID'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $stmt = $conn->prepare("insert into post (creator, title, content) values('$id', '$title', '$content')");
  $success = $stmt->execute();
  if (!$success){
    echo json_encode($stmt->error); 
  } else {
    echo json_encode(array("statusCode"=>200));
  }
?>

