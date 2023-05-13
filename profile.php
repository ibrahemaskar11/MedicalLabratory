<?php
require_once __DIR__ . '/db/db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
$appointments = fetchAppointments($_SESSION['user']['id']);
$reports = fetchReports($_SESSION['user']['id']);
if (isset($_POST['update_user'])) {
    $mrn = $_SESSION['user']['id'];
    $appointmentId = $_POST['appointmentid'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $testType = $_POST['selected'];
    if (empty($mrn) || empty($appointmentId) || empty($phone) || empty($email) || empty($date) || empty($time) || empty($testType)) {
        $error = "Missing credentials";
    }
    if (empty($error)) {
        $error = '';
        updateAppointment($appointmentId, $mrn, $phone, $testType, $time, $date);
        $appointments = fetchAppointments($_SESSION['user']['id']);
    }
}
if (isset($_POST['delete_app'])) {
    $appointmentId = $_POST['app_id'];
    deleteAppointment($appointmentId);
    $appointments = fetchAppointments($_SESSION['user']['id']);
}
$birthdate = $_SESSION['user']['birthdate'];
$formattedDate = date('Y-m-d', strtotime($birthdate));

if (isset($_POST['edit_user'])) {
    $mrn = $_SESSION['user']['id'];
    $usernameInput = $_POST['username_input'];
    $emailInput = $_POST['email_input'];
    $addressInput = $_POST['address_input'];
    $dateInput = $_POST['date_input'];
    if (empty($usernameInput) || empty($emailInput) || empty($addressInput) || empty($dateInput)) {
        $error = "Missing credentials";
    }
    if (empty($error)) {
        updateUser($mrn, $usernameInput, $emailInput, $addressInput, $dateInput);
    }
}
if (isset($_POST['update_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    if (empty($currentPassword) || empty($newPassword)) {
        $error = "missing information";
    } else {
        $mrn = $_SESSION['user']['id'];
        $message = updateUserPassword($mrn, $currentPassword, $newPassword);
        if ($message == "something went wrong") {
            $error = "something went wrong with password change";
        }
    }
}
// print_r($reports);
// print_r($appointments);

// session_start();
// if (!isset($_SESSION['user'])) {
//     header('location:login.php');
//     exit();
// }
//     $tests=['Cardiologists', 'Dermatologists', 'Endocrinologists', 'Gastroenterologists', 'Allergists', 'Immunologists'];
//     $id = $_SESSION['user']['userid'];
//     require('conn-db.php');
//     $sql = $conn->prepare("SELECT * FROM appointments where userid = '$id'");
//     $sql->execute();
//     $data = $sql->fetchAll();

//     if(isset($_POST['update'])){
//         $id=filter_var($_POST['id'],FILTER_SANITIZE_STRING);
//         $phoneNumber=filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
//         $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
//         $selected = $_POST['selected'];
//         $time = $_POST['time'];
//         $date = $_POST['date'];
//         $user = $_SESSION['user']['userid'];
//         $sql = $conn->prepare("UPDATE 
//         appointments SET  phone_number = '$phoneNumber', appointment_date = '$date', time='$time',test_type = '$selected' WHERE id = '$id'");
//         $sql->execute();
//         header("Refresh:0");
//     }
//     if(isset($_POST['delete'])){
//         $delete_id = $_POST['delete_id'];
//         $sql2 = $conn->prepare("DELETE from appointments WHERE id = '$delete_id'");
//         $sql2->execute();
//         header("Refresh:0");

//     }
//     $reportSql = $conn->prepare("SELECT * FROM tests where userid = '$id'");
//     $reportSql->execute();
//     $reports = $reportSql->fetchAll();

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/styles.css" />
    <link rel="stylesheet" href="./styles/modals.css" />
    <link rel="stylesheet" href="./styles/media-query.css" />
    <title>Edge Laboratory</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<body>
    <?php include __DIR__ . '/components/navbar.php' ?>

    <section class="contact" id="home">
        <div class=" contact-img-container">
            <img class="contact-img" src="assets/background2.jpg" alt="" />
        </div>
        <div class="contact-content">
            <h1>Medical Tests Carried Out By Our Expert Lab Scientists</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis itaque facilis eveniet numquam
                consequatur sed quam recusandae quos atem.</p>
            <div class="profile-card">


                <div class="profile-card-right-group">


                    <div>
                        <ul class="basic-ul  user-card-right">
                            <li>
                                <p>
                                    <span>name:
                                        <span id="profilename">
                                            <?php
                                            echo $_SESSION['user']['name'];
                                            ?>
                                        </span>
                                    </span>
                            </li>
                            <li>
                                <p>
                                    <span>email:<span id="profileemail">
                                            <?php
                                            echo " " . $_SESSION['user']['email'];
                                            ?>
                                        </span>
                                    </span>
                            </li>
                            <li>
                                <p>
                                    <span>age:
                                        <span id="profileage">
                                            <?php
                                            echo " " . $_SESSION['user']['age'];
                                            ?>
                                        </span>
                                    </span>
                            </li>
                            <li>
                                <p>
                                    <span>from: <span id="profilefrom">
                                            <?php
                                            echo " " . $_SESSION['user']['address'];
                                            ?></span>
                                    </span>
                                </p>
                            </li>
                            <li>
                                <h3 class="input-error" style="width:100%," id="form-error">
                                    <?php if (!empty($error)) : ?>
                                        <?php echo $error; ?>
                                    <?php endif; ?>
                                </h3>
                            </li>


                        </ul>

                    </div>
                    <div class=" update-user-info"><img src=" assets/icons8-modify-20.png">
                    </div>
                </div>
                <div class="name">
                    <div class="welcome">
                        <p>welcome
                            <span>
                                <?php echo $_SESSION['user']['name'];
                                ?>
                            </span> to
                        </p>
                        <h2>EDGE.</h2>
                        <p>we care about your health</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- ///////////////////////////reports///////////////////////////////////////////////////// -->
        <section id="reports" class="sectionStart">



            <div class="title2">
                <h1>reports</h1>
            </div>
            <div class="parent-container">
                <div class="child1-container">
                    <?php foreach ($reports as $report) : ?>
                        <a href="./view.php?url=<?php echo $report['url'] ?>" target="_blank">
                            <div class='card indgo pointer'>
                                <div class="date-card">
                                    <div class="day"><?php echo date('d', strtotime($report['date'])) ?></div>
                                    <div>
                                        <div class="month"><?php echo date('M', strtotime($report['date'])) ?></div>
                                        <div class="year"><?php echo date('Y', strtotime($report['date'])) ?></div>
                                    </div>
                                </div>
                                <div class="cardcontent">
                                    <h2><?php echo $report['test_name'] ?></h2>
                                    <p>
                                        This is a <?php echo $report['test_name'] ?> test taken on <?php echo $report['date'] ?> at <?php echo $report['time'] ?> you can check the results of your test from here
                                        <span style="margin-top:0.8rem; display:block; color:black;">
                                            Click here to view your test results
                                        </span>
                                    </p>

                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <!-- <div class='card indgo pointer'>
                        <div class="date-card">
                            <div class="day">21</div>
                            <div>
                                <div class="month">September</div>
                                <div class="year">2017</div>
                            </div>
                        </div>
                        <div class="cardcontent">
                            <h2> $testType</h2>
                            <p>Lisque persius interesset his et, in quot quidam persequeris vim,
                                ad mea essent possim iriure.

                        </div>
                    </div> -->
                    <!-- <div class='card indgo pointer'>
                        <div class="date-card">
                            <div class="day">21</div>
                            <div>
                                <div class="month">September</div>
                                <div class="year">2017</div>
                            </div>
                        </div>
                        <div class="cardcontent">
                            <h2> $testType</h2>
                            <p>Lisque persius interesset his et, in quot quidam persequeris vim,
                                ad mea essent possim iriure.

                        </div>
                    </div> -->
                    <!-- <div class='card indgo pointer'>
                        <div class="date-card">
                            <div class="day">21</div>
                            <div>
                                <div class="month">September</div>
                                <div class="year">2017</div>
                            </div>
                        </div>
                        <div class="cardcontent">
                            <h2> $testType</h2>
                            <p>Lisque persius interesset his et, in quot quidam persequeris vim,
                                ad mea essent possim iriure.

                        </div>
                    </div> -->


                </div>

            </div>
        </section>
        <section id="appiontments" class="sectionStart">
            <div class=" report" id="appointments">


                <div class="title">
                    <h1>appointments</h1>
                </div>
                <h3 class="input-error" style="margin-top: 1.5rem; width:100%, text-align:center;" id="form-error">
                    <?php if (!empty($error)) : ?>
                        <?php echo $error; ?>
                    <?php endif; ?>
                </h3>
                <div class="parent-container">
                    <div class="chhild2-container">
                        <?php foreach ($appointments as $appointment) : ?>
                            <div class='card indgo pointer' data-id="<?php echo $appointment['app_id'] ?>">
                                <div class="date-card">
                                    <div class="day"><?php echo date('d', strtotime($appointment['date'])) ?></div>
                                    <div>
                                        <div class="month"><?php echo date('M', strtotime($appointment['date'])) ?></div>
                                        <div class="year"><?php echo date('Y', strtotime($appointment['date'])) ?></div>
                                    </div>
                                </div>
                                <div class="cardcontent">
                                    <h2><?php echo $appointment['test_name'] ?></h2>
                                    <p>
                                        You have an appointment on <?php echo $appointment['date'] ?> at
                                        <?php echo $appointment['time'] ?> for a <?php echo $appointment['test_name'] ?> test

                                    </p>
                                    <div class="download">
                                        <div class=" rowButtons">
                                            <div class="update" data-id="<?php echo $appointment['app_id'] ?>" data-phone="<?php echo $appointment['phone_number'] ?>"><img src="assets/icons8-modify-20.png"></div>
                                            <div class="delete" data-id="<?php echo $appointment['app_id'] ?>"> <img src="assets/icons8-delete-20.png"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
        </section>

        <footer class="footer" id="contact">
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
                    <a class="footer__link twitter-link" target="_blank" href="https://twitter.com/ibrahim_askar11">Ibrahim
                        Askar </a>All rights reserved
                </p>
            </div>
            </div>
        </footer>



        <div id="deleteModal" class="modal">
            <form action="profile.php" method="POST" class="modal-content">
                <input type="hidden" id="delete_id_input" name="app_id" value="">
                <span class="close">&times;</span>
                <h3>Are you sure you want to delete this record?</h3>
                <div class="modal-buttons">

                    <button type="submit" name="delete_app" id="confirmButton">Delete</button>
                </div>
            </form>
        </div>
        <!-- The update modal form -->
        <div id="updateModal" class="update-modal">
            <div class="update-modal-content">
                <span class="closeupdate">&times;</span>
                <h2>Update Appointment</h2>
                <form action="profile.php" method="POST">
                    <label for="appointmentid"></label>
                    <input type="text" id="appIdForm" name="appointmentid" placeholder="appointment-id">
                    <label for=" email"></label>
                    <input type="email" value="<?php echo $_SESSION['user']['email']; ?>" id="emailform" name="email" placeholder="email">
                    <label for="phone"></label>
                    <input type="tel" id="phoneform" name="phone" placeholder="phone">
                    <label for="select"></label>
                    <select class="select" name="selected">
                        <option value="0">Test Type:</option>
                        <option value="1">Cardiologists</option>
                        <option value="2">Dermatologists</option>
                        <option value="3">Endocrinologists</option>
                        <option value="4">Gastroenterologists</option>
                        <option value="5">Allergists</option>
                        <option value="6">Immunologists</option>
                    </select>
                    <label for="time"></label>
                    <input name="time" type="time" placeholder="time" name="time">


                    <label for="date"></label>
                    <input name="date" type="date" placeholder="Date">


                    <button type="submit" name="update_user" id="updateButton">Update</button>

                </form>
            </div>
        </div>

        <div id="editUserInfo" class="edit-modal">
            <div class="edit-modal-content">
                <span class="close-edit" id="close-user-info">&times;</span>
                <h2>Edit Info</h2>
                <form action="profile.php" method="POST">

                    <label for=""></label>
                    <input type="text" id="editusername" name="username_input" placeholder="name">
                    <label for=""></label>
                    <input type="text" id="edituseremail" name="email_input" placeholder="email">
                    <label for=""></label>
                    <input type="date" value="<?php echo $formattedDate; ?>" id="edituserage" name="date_input" placeholder="age">
                    <label for=""></label>
                    <input type="text" id="edituserfrom" name="address_input" placeholder="from">


                    <h3 class="changing-password pointer">change password</h3>
                    <button type="submit" name="edit_user" id="edit-user-info-button">Submit Info</button>

                </form>
            </div>
        </div>
        <div id="change-password" class="edit-modal">
            <div class="edit-modal-content">
                <span class="close-edit" id="close-change-password">&times;</span>
                <h2>change the password</h2>
                <form action="profile.php" method="POST">

                    <label for=""></label>
                    <input type="password" id="" name="current_password" placeholder="Current password">
                    <label for=""></label>
                    <input type="password" id="" name="new_password" placeholder="New password ">




                    <button type="submit" name="update_password" id="confirm-change-password">change</button>

                </form>
            </div>
        </div>
</body>

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
<script>
    // Get the modal element
    let modal = document.getElementById("deleteModal");

    // Get all the delete buttons
    let deleteButtons = document.querySelectorAll('.delete');

    // Get the cancel button element
    let cancelButton = document.getElementById("cancelButton");

    // Get the confirm button element
    let confirmButton = document.getElementById("confirmButton");

    let closeButton = document.querySelector(".close");
    // When the user clicks on a delete button, open the modal
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener("click", function() {
            document.getElementById('delete_id_input').value = deleteButton.dataset.id;
            modal.style.display = "block";
            // Set the row to delete as the parent of the clicked button
            let rowToDelete = deleteButton.parentNode.parentNode.parentElement.parentElement;
            // Store the row to delete as a property of the confirm button
            confirmButton.rowToDelete = rowToDelete;
        });
    });



    // When the user clicks on the close button, close the modal
    closeButton.onclick = function() {
        modal.style.display = "none";
    }
    window.addEventListener("click", function(event) {
        // Check if the target of the click event is the modal
        if (event.target === modal) {
            // Hide the modal
            modal.style.display = "none";
        }
    })
    // When the user clicks on confirm, delete the row and close the modal
    confirmButton.onclick = function() {
        // Delete the row here
        let rowToDelete = confirmButton.rowToDelete;
        rowToDelete.parentNode.removeChild(rowToDelete);
        modal.style.display = "none";
    };
</script>

<script defer>
    // Get the update modal element
    let updateModal = document.getElementById("updateModal");

    // Get all the update buttons
    let updateButtons = document.querySelectorAll('.update');

    // Get the close button element
    let closeupdate = updateModal.querySelector(".closeupdate");

    // Get the update button element
    let updateButton = updateModal.querySelector("#updateButton");
    let row = ""
    // When the user clicks on an update button, open the update modal
    updateButtons.forEach(function(updateButton) {
        updateButton.addEventListener("click", function() {
            updateModal.style.display = "block";
            console.log(updateButton.dataset);
            document.getElementById("phoneform").value = updateButton.dataset.phone;
            document.getElementById("appIdForm").value = updateButton.dataset.id;
            // Set the row to update as the parent of the clicked button
            let rowToUpdate = updateButton.parentNode.parentNode.parentElement.parentElement;
            // Set the input values to the current row values

            row = rowToUpdate;

        });
    });


    closeupdate.onclick = function() {
        updateModal.style.display = "none";
    };


    window.onclick = function(event) {
        if (event.target == updateModal) {
            updateModal.style.display = "none";
        }
    };


    updateButton.addEventListener("click", function() {



        document.getElementById("updateModal").style.display = "none";
    });
</script>

<!-- Include ScrollReveal.js -->
<script>
    let userinfomodal = document.getElementById("editUserInfo");
    let closeUserInfo = document.getElementById("close-user-info");
    let infoToUpdate = ""
    let submitNewInfo = document.getElementById("edit-user-info-button")
    let editButton = document.querySelector(".update-user-info")
    editButton.addEventListener("click", function() {
        userinfomodal.style.display = "block";
        infoToUpdate = editButton.parentElement
        console.log(infoToUpdate.querySelector("#profilename"))
        document.getElementById("editusername").value = infoToUpdate.querySelector("#profilename").textContent.trim();
        document.getElementById("edituseremail").value = infoToUpdate.querySelector("#profileemail").textContent.trim();
        document.getElementById("edituserage").value = infoToUpdate.querySelector("#profileage").textContent.trim();
        document.getElementById("edituserfrom").value = infoToUpdate.querySelector("#profilefrom").textContent.trim();

    })


    window.onclick = function(event) {
        if (event.target == userinfomodal) {
            userinfomodal.style.display = "none";
        }
    };


    closeUserInfo.onclick = function() {
        userinfomodal.style.display = "none";
    };
    submitNewInfo.addEventListener("click", function() {

        userinfomodal.style.display = "none";

    })
</script>
<script>
    let changePasswordModal = document.getElementById("change-password");
    let closeChangePassword = document.getElementById("close-change-password");
    let confirmChangePassword = document.getElementById("confirm-change-password");
    let changingthePassord = document.querySelector(".changing-password");
    changingthePassord.addEventListener("click", function() {
        changePasswordModal.style.display = "block";
    });
    window.addEventListener("click", function(event) {
        // Check if the target of the click event is the modal
        if (event.target === changePasswordModal) {
            // Hide the modal
            changePasswordModal.style.display = "none";
        }
    })
    closeChangePassword.onclick = function() {
        changePasswordModal.style.display = "none";
    }
    // When the user clicks on confirm, delete the row and close the modal
    confirmChangePassword.onclick = function() {
        // Delete the row here

        changePasswordModal.style.display = "none";
    };
    // 
</script>