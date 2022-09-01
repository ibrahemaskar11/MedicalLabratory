<?php
  session_start();
if(!isset($_SESSION['admin'])){
    header('http://localhost:1337/MedicalLaboratory/admin/login.php');
    exit();
}
    require('../conn-db.php');
    $userSql = $conn->prepare("SELECT * FROM users");
    $userSql->execute();
    $users = $userSql->fetchAll();
    $appointmentSql = $conn->prepare("SELECT * FROM appointments");
    $appointmentSql->execute();
    $appointments = $appointmentSql->fetchAll();
    $tests=['Cardiologists', 'Dermatologists', 'Endocrinologists', 'Gastroenterologists', 'Allergists', 'Immunologists'];
    $id = $_SESSION['admin']['username'];
    $testsSql = $conn->prepare("SELECT * FROM tests");
    $testsSql->execute();
    $testResults = $testsSql->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles.css" />
    <link rel="stylesheet" href="media-query.css" />
    <title>Edge Laboratory</title>
  </head>
  <body>
    <nav class="navbar-admin">
        <div class="navbar-container">  
        <div class="navbar-left">
          <h1>Edge.</h1>
      
        </div>
        <div class="navbar-right ">
            <a class="btn sign-up" href="logout.php">log out</a>
   
          </div>
      </nav>

<table class="content-table">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>address</th>
        <th>age</th>
    
        <th></th>
    </tr>
    <tbody>
        <?php
        foreach($users as $user){
          $id = $user['id'];
          $username = $user['username'];
          $email = $user['email'];
          $age = $user['age'];
          $address = $user['address'];
          
         echo "<tr>
                <td>$id</td>
                <td>$username</td>
                <td>$email</td>
                <td>$address</td>
                <td>$age</td>
            
                <td>  <a href='http://localhost:1337/test/admin/deleteUser.php' class='btn del-user'>delete</a>
                
               </td>
              </tr>";
        }
        ?>
        
        
        
      </tbody>

</thead>
</table>

<div class="about-me">
    <h2>appointemnts</h2>
    <table class="content-table">
   
            <th>id</th>
        
            <th>name</th>
            <th>date</th>
            <th>type</th>
            <th>phone number</th>
            <th>email</th>
            <th>user-ID</th>
            <th> </th>
        </tr>
        <tbody>
          <?php 
          foreach($appointments as $appointment){
            $appointmentId = $appointment['id'];
            $usernameAppointment = $appointment['username'];
            $dateAppointment = $appointment['appointment_date'];
            $typeIndex = $appointment['test_type'] -1;
            $type = $tests[$typeIndex];
            $phoneNumber = $appointment['phone_number'];
            $email = $appointment['email'];
            $userId = $appointment['userid'];
            echo 
            "<tr>
              <td>$$appointmentId</td>
              <td>$usernameAppointment</td>
              <td>$dateAppointment</td>
              <td>$type</td>
              <td>$phoneNumber</td>

              <td>$email@ex.com</td>
              <td>$userId</td>
          
              <td>  
                <td>  <a href='http://localhost:1337/test/admin/deleteAppointment.php' class='btn del-user'>delete</a>
              </td>
            </tr>";
          }
          ?>
          </tbody>
    
    </thead>
    </table>
    
<div class="about-me">
    <h2>Tests</h2>
    <table class="content-table">
   
            <th>id</th>
        
            <th>name</th>
            <th>type</th>
            <th>appointment id</th>
            <th>user id</th>
            <th>email</th>
            <th>file</th>
        </tr>
        <tbody>
          <?php
            foreach($testResults as $test){
              $id= $test['id'];
              $name = $test['username'];
              $typeIndex = $test['test_type']-1;
              $type = $tests[$typeIndex];
              $appointmentId = $test['appointment_id'];
              $userId = $test['userid'];
              $email = $test['email'];
              $file = $test['filename'];

              echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$type</td>
                    <td>$appointmentId</td>
                    <td>$userId</td>

                    <td>$email</td>
                
                <td>  <a href='http://localhost:1337/test/admin/deleteFile.php' class='btn del-user'>delete</a>
                        </td>
                      </tr>";
            }
          ?>
            <tr>
            <th >
            <a href="addFile.php" class="add-more" >add more</a></th>
        </tr>
          </tbody>
    
    </thead>
    </table>

    <footer class="footer">
        <div class="footer-container">
        <div class="footer-contact-us">
            <h3>Contact Us</h3>
            <ul>
                <li>2946 Angus Road, NY</li>
                <li>+31 123 456 7890</li>
                <li>contact@edge.com</li>
            </ul>
        </div>
        <div class="footer-account">
            <h3>Account</h3>
            <ul>
            <li>Sign in</li>
            <li>Create account</li>
            <li>IOS App</li>
            <li>Android App</li>
            </ul>
        </div>
        <div class="footer-company">
            <h3>Company</h3>
            <ul>
                <li>About Us</li>
                <li>Services</li>
                <li>Our Team</li>
                <li>Contacts</li>
            </ul>
        </div>
        <div class="footer-legal">
            <h3>LEGAL</h3>
            <ul>
                <li>Claims</li>
                <li>Privacy</li>
                <li>Terms</li>
                <li>Policies</li>
            </ul>
        </div>
      
    
        <div class="footer-subscribe">
            <h3>SUBSCRIBE TO OUR NEWSLETTER</h3>
            <p>The latest news, articles, and resources, sent to your inbox weekly.</p>
            <div class="subscribe-actions">
                <input type="email" placeholder="Enter your email address">
                <button class="btn btn-subscribe">
                    Subscribe
                </button>
            </div>
        </div>
        </div>   
        <div class="footer-copyright">
            <h3>EDGE</h3>
            <p class="footer__copyright">
                &copy; Copyright by
                <a
                class="footer__link twitter-link"
                target="_blank"
                href="https://twitter.com/ibrahim_askar11"
                >Ibrahim Askar </a
                >All rights reserved
            </p>
        </div>
        </div>
    </footer>  
    

  </body>