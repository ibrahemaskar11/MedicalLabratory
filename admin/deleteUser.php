<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:/admin/login.php');
    exit();
}
if(isset($_POST['submit'])){
    require('../conn-db.php');
    $userId = $_POST['userid'];
        $sql = $conn->prepare("DELETE from users WHERE id = '$userId'");
        $sql->execute();
        header("http://localhost:1337/MedicalLaboratory/admin/");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles.css" />
    <title>delete user</title>
  </head>
  <body>
    <div class="signup-page">
      <form action="deleteUser.php" method="POST" class="signup-form" enctype="multipart/form-data">
        <div class="form-container">
          <h1 class="signup-header">delete user</h1>
          <input type="text" placeholder="User Id" required name="userid" />
          <button  type="submit" name="submit" value="submit" class="btn signup-form__btn">
            submit
          </button>
        
        </div>
      </form>
    <div >
    </div
    </div>
  </body>