<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
}
    $tests=['Cardiologists', 'Dermatologists', 'Endocrinologists', 'Gastroenterologists', 'Allergists', 'Immunologists'];
    $id = $_SESSION['user']['userid'];
    require('conn-db.php');
    $sql = $conn->prepare("SELECT * FROM appointments where userid = '$id'");
    $sql->execute();
    $data = $sql->fetchAll();

    if(isset($_POST['update'])){
        $id=filter_var($_POST['id'],FILTER_SANITIZE_STRING);
        $phoneNumber=filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
        $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $selected = $_POST['selected'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $user = $_SESSION['user']['userid'];
        $sql = $conn->prepare("UPDATE 
        appointments SET  phone_number = '$phoneNumber', appointment_date = '$date', time='$time',test_type = '$selected' WHERE id = '$id'");
        $sql->execute();
        header("Refresh:0");
    }
    if(isset($_POST['delete'])){
        $delete_id = $_POST['delete_id'];
        $sql2 = $conn->prepare("DELETE from appointments WHERE id = '$delete_id'");
        $sql2->execute();
        header("Refresh:0");

    }
    $reportSql = $conn->prepare("SELECT * FROM tests where userid = '$id'");
    $reportSql->execute();
    $reports = $reportSql->fetchAll();

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="media-query.css" />
    <title>Edge Laboratory</title>
  </head>
  <body>
    <nav class="navbar">
        <div class="navbar-container">  
        <div class="navbar-left">
          <h1>Edge.</h1>
          <div class="">
          <ul class="nav-list ">
            <li><a href="http://localhost:1337/test/"> Home</a></li>
            <li><a href="http://localhost:1337/test/">About</a></li>
            <li><a href="http://localhost:1337/test/">Services</a></li>
            <li><a href="http://localhost:1337/test/">Pricing</a></li>
            <li><a href="http://localhost:1337/test/">Contact us</a></li>
          </ul>
          </div>
        </div>
        <div class="navbar-right ">
            <a class="btn sign-up" href="logout.php">log out</a>
   
          </div>
      </nav>

  <section class="contact id="contact>
        <div class="contact-img-container">
          <img class="contact-img" src="assets/slide1.jpg" alt="" />
        </div>
        <div class="contact-content">
            <h1>Medical Tests Carried Out By Our Expert Lab Scientists</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis itaque facilis eveniet numquam consequatur sed quam recusandae quos at dolorem.</p>
            <div class="contact-us-form-group">
              
              
                <div class="contact-us-right-group">
                  
                
                        <div >
                    <ul class="basic-ul  user-card-right">
                        <li>
                            <p><span> full name:<?php
                            echo " ".$_SESSION['user']['name'];
                            ?></p>
        
                        </li>
                        <li>
                            <p><span>email:<?php
                            echo " ".$_SESSION['user']['email'];
                            ?></p>
                        </li>
                        <li>
                            <p><span>age: <?php
                            echo " ".$_SESSION['user']['age'];
                            ?></p>
                        </li>
                        <li>
                            <p><span>from: <?php
                            echo " ".$_SESSION['user']['address'];
                            ?></p>
                        </li>
        
                    
                    </ul>
        
                </div>
                
            <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
                </div>
                <div class="name">
                    <div class="welcome">
                  <p>welcome  <span> <?php echo $_SESSION['user']['name'] ;?></span> to</p>
                  <h2>EDGE.</h2>
                  <p>we care about your health</p>
                    </div>
                </div>
            </div>
        </div>    
        <!-- ///////////////////////////reports///////////////////////////////////////////////////// -->
        <div class="report">
          

                <div class="about-me">
                    <h2>reports</h2>
                   
                </div>
                <div class="rep-card">
                    
                    <div class="first3-cards">
                    <?php
                    foreach($reports as $report){
                        $id = $report['id'];
                        $testIndex = $report['test_type'] ;
                        $testIndex= $testIndex-1;
                        $testType = $tests[$testIndex];
                        $appointmentId = $report['appointment_id'];
                        $sql = $conn->prepare("SELECT * FROM appointments where id = '$appointmentId'");
                        $sql->execute();
                        $data = $sql->fetch();
                        $reportLink = $report['filename'];
                        echo "<div class='card'>
                                <p class='$data'>10/12/2004</p>
                                <h2> $testType</h2>
                                <p>Lisque persius interesset his et, in quot quidam persequeris vim,
                                    ad mea essent possim iriure.
                                 <a href='http://localhost:1337/test/uploads/admin.$reportLink'><h3>download</h3></a>
                             </div>";
                    }

                    ?>
                    </div>
                    
                    
                
        </div>
        
     <div class="appointment">

            <div class="about-me">
                <h2>appointemnts</h2> 
                    <div class="know-me" id="resume">
                

    </div>
            </div>
<div class="rep-card">
            <div class="first3-cards">
          
             <h2>current appointments</h2>
            
            <?php
                foreach($data as $date){
                    $id = $date['id'];
                    $testIndex = $date[1] ;
                    $testIndex= $testIndex-1;
                    $testType = $tests[$testIndex];
                    $date = $date['appointment_date'];
                    echo "<div class='card'>
                            <p class='rep-date'>$date</p>
                            <br>
                            <h2>$testType</h2>
                            <br>
                            <p>Id: $id </p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error eaque incidunt natus, nihil in sunt!</p>
                            </div>
                    ";
                }
            ?>

            </div>
            
        </div>
</div>
</div>

    <div class="contact-img-container">

    </div>
    <div class="contact-content">
        <h1 class="blue">update your appointment</h1>

        <div class="contact-us-form-group">
            <div class="contact-us-right-group">
                <h1>update your current info</h1>
                <form action="profile.php" method="POST" class="contact-form">
                    <ul class="contact-form-input">
                        <li>
                            <input type="text" name="id"  placeholder="appointemnt id">
                        </li>
                        <li>
                            <input type="text" name="email"  placeholder="Your Email">
                        </li>
                        <li>
                            <input type="text" name="phone"  placeholder="Your Phone Number">
                        </li>
                        <li>
                            <select class="select" name="selected">
                                <option value="0">Test Type:</option>
                                <option value="1">Cardiologists</option>
                                <option value="2">Dermatologists</option>
                                <option value="3">Endocrinologists</option>
                                <option value="4">Gastroenterologists</option>
                                <option value="5">Allergists</option>
                                <option value="6">Immunologists</option>
                            </select>
                        </li>
                        <li>
                            <input  class="date" name="time"type="time" placeholder="time"
                            name="time">
                            </li>
                        <li>
                            <input  class="date" name="date" type="date" placeholder="Date">
                        </li>
                        
                    </ul>
                    <div class="contact-actions"></div>
                    <button class="btn btn-appointment btn-action-1" name="update" type="submit">confirm updates</button>
                </form>
            </div>
            <div class="contact-us-right-group" style="border-right:2px solid rgb(203, 213, 225);">
                <h1>Delete an appointment</h1>
                <form action="profile.php" method="POST" class="delete-app">
                    <ul style="display: flex; justify-content:center;">
                        <li style="margin-top:4rem;">
                            <input type="text" name="delete_id"  placeholder="appointemnt id">
                        </li>
                        
                    </ul>
                    <div class="contact-actions"></div>
                    <button class="btn btn-appointment btn-action-1" name="delete" type="submit">confirm updates</button>
                </form>
            </div>
        </div>
    </div> 
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