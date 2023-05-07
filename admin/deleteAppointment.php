<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:/admin/login.php');
    exit();
}
if(isset($_POST['submit'])){
    require('../conn-db.php');
    $appointmentId = $_POST['appointmentid'];
        $sql = $conn->prepare("DELETE from appointments WHERE id = '$appointmentId'");
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
    <title>delete appointment</title>
  </head>
  <body>
    <div class="signup-page">
      <form action="deleteAppointment.php" method="POST" class="signup-form" enctype="multipart/form-data">
        <div class="form-container">
          <h1 class="signup-header">delete appointment</h1>
          <input type="text" placeholder="Appointment id" required name="appointmentid" />
          <button  type="submit" name="submit" value="submit" class="btn signup-form__btn">
            submit
          </button>
        
        </div>
      </form>
    <div >
    </div
    </div>
  </body>