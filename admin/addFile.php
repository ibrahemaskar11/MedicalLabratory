<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:/admin/login.php');
    exit();
}
if(isset($_POST['submit'])){
    require('../conn-db.php');

$name = $_SESSION['admin']['username'];
$uploads_dir = "../uploads";
$avatar = "";
if($_FILES["avatar"]["error"] == UPLOAD_ERR_OK){
    $tmp_name = $_FILES["avatar"]["tmp_name"];
    $avatar = $_FILES["avatar"]["name"];
    move_uploaded_file($tmp_name, "$uploads_dir/$name.$avatar");
}else{
    exit();
}
        $username = $_POST['username'];
        $email = $_POST['email'];
        $userid = $_POST['userid'];
        $testType = $_POST['test'];
        $appointmentId = $_POST['appointment'];
        $sql = "INSERT INTO tests (username,email,userid,test_type,appointment_id,filename) VALUES ('$username','$email','$userid', '$testType','$appointmentId', '$avatar')";
        $query=$conn->prepare($sql);
        $query->execute();
        $data=$query->fetch();
            header('http://localhost:1337/test/admin/');

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles.css" />
    <title>add user</title>
  </head>
  <body>
    <div class="signup-page">
      <form action="addFile.php" method="POST" class="signup-form" enctype="multipart/form-data">
        <div class="form-container">
          <h1 class="signup-header">add document</h1>
          <input type="text" placeholder="Full Name" required name="username" />
          <input type="email" placeholder="Email" required name="email" />
          <input
            type="text"
            placeholder="userid"
            required
            name="userid"
          />
          <input
            type="text"
            placeholder="test"
            required
            name="test"
          />
          <input
            type="text"
            placeholder="appointment id"
            required
            name="appointment"
          />
     
            <input

        type="file"
        name="avatar"
     placeholder="add a document"
    />
          <button  type="submit" name="submit" value="Upload" class="btn signup-form__btn">
            submit
          </button>
        
        </div>
      </form>
    <div >
    </div
    </div>
  </body>