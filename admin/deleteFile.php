<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:/admin/login.php');
    exit();
}
if(isset($_POST['submit'])){
    require('../conn-db.php');
    $fileId = $_POST['fileid'];
        $sql = $conn->prepare("DELETE from tests WHERE id = '$fileId'");
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
    <title>delete file</title>
  </head>
  <body>
    <div class="signup-page">
      <form action="deleteFile.php" method="POST" class="signup-form" enctype="multipart/form-data">
        <div class="form-container">
          <h1 class="signup-header">delete file</h1>
          <input type="text" placeholder="File id" required name="fileid" />
          <button  type="submit" name="submit" value="submit" class="btn signup-form__btn">
            submit
          </button>
        
        </div>
      </form>
    <div >
    </div
    </div>
  </body>