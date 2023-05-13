<?php
require_once __DIR__ . '/db/db.php';
session_start();
$appointmentError = "";
$appointmentSuccess = "";
//  print_r($_SESSION['user']);

$conn = db_connect();
$sql = "SELECT test_id, name FROM tests";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$tests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
mysqli_close($conn);



if (isset($_SESSION['user']) && isset($_POST['appointment'])) {
    $username = $_SESSION['user']['name'];
    $userid = $_SESSION['user']['id'];
    $email = $_SESSION['user']['email'];
    $phoneNumber = $_POST['phone'];
    $selected = $_POST['test'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    if (empty($phoneNumber)) {
        $appointmentError = "Missing information";
    }
    if (empty($time)) {
        $appointmentError = "Missing information";
    }
    if (empty($date)) {
        $appointmentError = "Missing information";
    }
    if (empty($selected)) {
        $appointmentError = "Missing information";
    }
    if ($date < date('Y-m-d')) {
        $appointmentError = "incorrect information";
    }
    if (!preg_match("/^[0-9]{11}$/", $phoneNumber)) {
        $appointmentError = "incorrect information";
    }
    if (empty($appointmentError)) {
        try {
            addAppointment($userid, $phoneNumber, $selected, $time, $date);
        } catch (Exception $e) {
            $appointmentError = $e->getMessage();
        }
    }
} else if (isset($_POST['appointment']) && !isset($_SESSION['user'])) {
    $appointmentError = "You need to login first";
    // exit();
}
// if(isset($_POST['submit'])){
//     $errors=[];
//     if(!isset($_SESSION['user'])){
//         $errors[]= 'You need to login first';
//         exit();
//     }
//     include 'conn-db.php';
//     $username=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
//     $phoneNumber=filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
//     $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
//     $selected = $_POST['disease'];
//     $time = $_POST['time'];
//     $date = $_POST['date'];
//     $userid = $_SESSION['user']['userid'];
//   if(empty($username)){
//     $errors[]="Please provide your name";
//   }
//   if(strlen($username)>100){
//     $errors[]="Name can not exceed 100 character";
//   }

//   if(empty($email)){
//     $errors[]="Please provide your email";
//   }
//   if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
//     $errors[]="Enter a valid Email";
//   }
//   if(empty($phoneNumber)){
//     $errors[]="Please provide your phone number";
//   }
//   if(empty($time)){
//     $errors[]="Please provide time of reservation";
//   }
//   if(empty($date)){
//     $errors[]="Please provide the date";
//   }
//   if(empty($errors)){
//     try{
//     $statement = "INSERT INTO appointments(username, email, phone_number, test_type, appointment_date, time, userid) VALUES ('$username', '$email', '$phoneNumber', '$selected', '$date', '$time', '$userid')";
//     $conn->prepare($statement)->execute();
//     $_POST['username']='';
//     $_POST['email']='';
//     $_POST['phone']='';
//     $_POST['disease']='';
//     $_POST['date']='';
//     $_POST['time']='';
//     header('location:profile.php');
//     }catch (Exception $err){
//         echo $err;
//     }
//   }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/styles.css" />
    <link rel="stylesheet" href="./styles/media-query.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $("#phone").on("keyup", function() {
        //         let submit = $("#appointment-submit")
        //         setTimeout(() => {
        //             console.log("hello");
        //             let inputVal = $(this).val();
        //             if (inputVal.length > 0 && inputVal.length < 11 || inputVal.length > 11) {
        //                 $(this).css("border-color", "red");
        //                 submit.prop('disabled', true)
        //                 phoneErr = true
        //             } else {
        //                 phoneErr = false
        //                 $(this).css('border-color', 'rgb(203, 213, 225)')
        //                 errorContainer.text("")
        //                 const date = $("#date")
        //                 let currentDate = new Date().toISOString().split('T')[0]; // Get the current date in ISO format
        //                 if (date.val() > currentDate) {
        //                     submit.prop('disabled', false)
        //                 }
        //             }
        //         }, 1000)

        //     });
        //     $("#date").on("input", function() {
        //         let submit = $("#appointment-submit")
        //         setTimeout(() => {
        //             let errorContainer = $('#date-error');
        //             let inputVal = $(this).val();
        //             let currentDate = new Date().toISOString().split('T')[0]; // Get the current date in ISO format

        //             if (inputVal < currentDate) {
        //                 $(this).css("border-color", "red");
        //                 errorContainer.text("Please enter a valid date (not in the future).");
        //                 submit.prop('disabled', true);
        //             } else {
        //                 $(this).css('border-color', 'rgb(203, 213, 225)');
        //                 errorContainer.text("");
        //                 if ($("#phone").val().length == 11) {
        //                     submit.prop('disabled', false);
        //                 }
        //             }
        //         }, 1000);
        //     });
        // })
    </script>
    <title>Edge Laboratory</title>
</head>

<body>
    <?php require __DIR__ . '/components/navbar.php' ?>

    <main>
        <section class="hero" id="hero">
            <div class="hero-img-container">
                <img class="hero-img" src="./assets/background.jpg" alt="" />
            </div>
            <div class="hero-content" id="hom">
                <div class="hero-text">
                    <h3>Edge Laboratories</h3>
                    <h1>Edge Laboratories is Specialized in Medical Tests and Research</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et
                        consequuntur, reiciendis veniam pariatur tempora, rerum mollitia,
                        labore dolores suscipit est quae sequi voluptatibus necessitatibus
                        modi vero earum similique. Voluptas, adipisci!
                    </p>
                    <button class="btn btn-book">Learn More &DownArrow;</button>
                </div>

        </section>
        <section class="about" id=abt>
            <div class="about-container">
                <h1>
                    trusted by the egyptian ministry of health
                </h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam pariatur optio dolorem assumenda ea
                    tempore tempora doloribus provident cupiditate tenetur.</p>

                <div class="about-details">
                    <div class="about-details-item">
                        <h3>1000</h3>
                        <h3>CLIENTS</h3>
                    </div>
                    <div class="about-details-item">
                        <h3>305</h3>
                        <h3>STAFF</h3>
                    </div>
                    <div class="about-details-item">
                        <h3>50</h3>
                        <h3>EXPIERENCE</h3>
                    </div>
                    <div class="about-details-item">
                        <h3>640</h3>
                        <h3>SUPPLIERS</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="services" id="srvs">
            <div class="container">
                <div class="services-container">
                    <h3>Services</h3>
                    <h1>Our Core Services</h1>
                    <div class="services-box">
                        <div class="service">
                            <div class="service-left">
                                <div class="serivce-img-container">
                                    <img src="./assets/icons8-optical-microscope-64.png" alt="">
                                </div>
                            </div>
                            <div class="service-right">
                                <h3>Advanced Microscopy</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src="./assets/icons8-biology-64.png" alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Molecular Biology</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src="./assets/icons8-diabetes-64.png" alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Diabetes Testing</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src="./assets/icons8-chemistry-64.png" alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Chemical Research</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src="./assets/icons8-lungs-64.png" alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Anatomical Pathology</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">

                                    <img src="./assets/icons8-anatomy-64.png" alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Heart Disease</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pricing" id="pricing">
            <div class="container">
                <div class="pricing-container">
                    <h3>Pricing</h3>
                    <h1>The right price for your needs.</h1>

                    <div class="pricing-plan-container">
                        <div class="pricing-plan">
                            <span class="plan-type">Standard</span>
                            <div class="plan-content">
                                <p class="price">400 L.E <span class="price-span">/mo</span></p>
                                <h3>400 L.E for a Monthly Cheeckup Including The Following Medical Tests</h3>
                                <ul class="plan-list">
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span> Complete Blood
                                        Count
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Liver Function Blood
                                        Test</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Prothrombin Time
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Hemoglobin A1C</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Urinalysis</li>

                                    <li style="visibility: hidden;"> <span><img src="./assets/icons8-done-48.png" alt=""></span>Liver Function Blood Test</li>
                                    <li style="visibility: hidden;"> <span><img src="./assets/icons8-done-48.png" alt=""></span>Liver Function Blood Test</li>
                                    <li style="visibility: hidden;"> <span><img src="./assets/icons8-done-48.png" alt=""></span>Liver Function Blood Test</li>
                                    <li style="visibility: hidden;"> <span><img src="./assets/icons8-done-48.png" alt=""></span>Liver Function Blood Test</li>
                                </ul>
                                <button class="btn plan-actions">Get Started</button>
                            </div>
                        </div>
                        <div class="pricing-plan pricing-plan-premium">
                            <span class="plan-type">Premium</span>
                            <div class="plan-content">
                                <p class="price">1200 L.E <span class="price-span">/mo</span></p>
                                <h3>1200 L.E for a Monthly Cheeckup Including The Following Medical Tests</h3>
                                <ul class="plan-list">
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span> Complete Blood
                                        Count
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Liver Function Blood
                                        Test</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Prothrombin Time
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Hemoglobin A1C</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Urinalysis</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Comprehensive
                                        Metabolic
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Female General
                                        Health
                                        Panel</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span> Transmitted
                                        Diaseases
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Cholesterol Lipid
                                        Levels
                                    </li>
                                </ul>
                                <button class="btn plan-actions">Get Started</button>
                            </div>
                        </div>
                        <div class="pricing-plan">
                            <span class="plan-type">Gold</span>
                            <div class="plan-content">
                                <p class="price">800 L.E <span class="price-span">/mo</span></p>
                                <h3>800 L.E for a Monthly Cheeckup Including The Following Medical Tests</h3>
                                <ul class="plan-list">
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span> Complete Blood
                                        Count
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Liver Function Blood
                                        Test</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Prothrombin Time
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Hemoglobin A1C</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Urinalysis</li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Comprehensive
                                        Metabolic
                                    </li>
                                    <li> <span><img src="./assets/icons8-done-48.png" alt=""></span>Female General
                                        Health
                                        Panel</li>
                                    <li style="visibility: hidden;"> <span><img src="./assets/icons8-done-48.png" alt=""></span> Transmitted Diaseases</li>
                                    <li style="visibility: hidden;"> <span><img src="./assets/icons8-done-48.png" alt=""></span> Cholesterol Lipid Levels</li>

                                </ul>
                                <button class="btn plan-actions">Get Started</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="contact id=" id="us">
            <div class="contact-img-container">
                <img class="contact-img" src="./assets/background2.jpg" alt="" />
            </div>
            <div class="contact-content">
                <h1>Medical Tests Carried Out By Our Expert Lab Scientists</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis itaque facilis eveniet numquam
                    consequatur sed quam recusandae quos at dolorem.</p>
                <div class="contact-us-form-group">
                    <div class="contact-us-right-group">
                        <form action="index.php" method="POST" class="contact-form">
                            <h1 class="appointment-header">Make an Appointment</h1>
                            <?php if (!empty($appointmentError)) : ?>
                                <h3 class="input-error" id="form-error">
                                    <?php echo $appointmentError; ?>
                                </h3>
                            <?php endif; ?>
                            <ul class="contact-form-input">
                                <li>
                                    <input type="text" value="<?php
                                                                if (isset($_SESSION['user'])) {
                                                                    echo $_SESSION['user']['name'];
                                                                }
                                                                ?>" placeholder="Your name" name="username" <?php if (isset($_SESSION['user'])) {
                                                                                                                echo "disabled";
                                                                                                            } ?>>
                                </li>
                                <li>
                                    <input type="email" value="<?php
                                                                if (isset($_SESSION['user'])) {
                                                                    echo $_SESSION['user']['email'];
                                                                }
                                                                ?>" placeholder="Your email" name="email" <?php if (isset($_SESSION['user'])) {
                                                                                                                echo "disabled";
                                                                                                            } ?>>
                                </li>
                                <li>
                                    <input type="text" placeholder="Your Phone Number" id="phone" name="phone">
                                </li>
                                <li>
                                    <select class="select" name="selected">
                                        <option value="0">Test Type:</option>
                                        <?php foreach ($tests as $test) : ?>
                                            <option value="<?php echo $test['test_id']; ?>">
                                                <?php echo $test['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </li>
                                <li>
                                    <input class="date" type="time" placeholder="time" name="time">
                                </li>
                                <li>
                                    <input class="date" id="date" type="date" placeholder="Date" name="date">
                                </li>

                            </ul>
                            <div class="contact-actions"></div>
                            <button class="btn btn-appointment btn-action-1" name="appointment" type="submit" id="appointment-submit">make an appointment</button>
                        </form>
                    </div>
                    <div class="contact-us-left-group">
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="./assets/pin.png" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>OUR ADDRESS</h3>
                                <p class="contact-address">
                                    2946 Angus Road, NY
                                </p>
                            </div>
                        </div>
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="./assets/telephone.png" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>PHONE NUMBER</h3>
                                <p class="contact-number">
                                    +31 123 456 7890
                                </p>
                            </div>
                        </div>
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="./assets/mail.png" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>EMAIL ADDRESS</h3>
                                <p class="contact-address">
                                    contact@edge.com
                                </p>
                            </div>
                        </div>
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="./assets/settings.png" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>WORKING HOURS</h3>
                                <p class="contact-address">
                                    Sat to Thur: 9am to 8pm
                                </p>
                            </div>
                        </div>
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
                    <h3 class="Poiret">edge</h3>
                    <p class="footer__copyright">
                        &copy; Copyright by
                        <a class="footer__link twitter-link" href="https://twitter.com/ibrahim_askar11">Ibrahim Askar
                        </a>All rights reserved
                    </p>
                </div>
                </div>
            </footer>
    </main>
    <script defer>
        const btn = document.querySelector(".navbar-btn");
        btn.onclick = function() {
            if (document.querySelector('.navbar-mobile').style.display !== "none") {
                document.querySelector('.navbar-mobile').style.display = "none";
            } else {
                document.querySelector('.navbar-mobile').style.display = "block";
            }
        };
    </script>
</body>

</html>