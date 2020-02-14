<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php session_start();?>
<body>
  <div class="container">
    <?php include 'menu.html';?>
    <?php include 'mysql_connect.php';?>
    <?php
      $stmt = $conn->prepare("SELECT user.username, post.* FROM post INNER JOIN user ON user.id=post.creator;");
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows == 0) {
        echo "<h1>Posts</h1>";
        echo "<p>No posts available</p>";
      } else {
        echo "<h1>Posts</h1>";
        while($row = $result->fetch_assoc()){
          $title = $row['title'];   
          $content = $row['content']; 
          $creator = $row['username'];
          echo '<div class="card">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' .htmlspecialchars($title). '</h5>';
          echo '<h6 class="card-subtitle mb-2 text-muted">by ' .htmlspecialchars($creator). '</h6>';
          echo '<p class="card-text">' .htmlspecialchars($content). '</p>';
          echo '</div>';
          echo '</div>';

        }
      }
    ?>
    <?php 
      if (isset($_SESSION['username'])) {
        print('Create a post as '.$_SESSION['username']);
        include 'blog.html';
      }
      else {
      echo "<p>You need to log in to make a post</p>";
      }
    ?>
  </div>
</body>
</html>

