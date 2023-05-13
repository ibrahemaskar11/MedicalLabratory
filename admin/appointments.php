<?php
require_once __DIR__ . '/../db/admin.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
    exit();
}
$appointments = fetchAppointments();
if (isset($_POST['delete_app'])) {
    $app_id = $_POST['app_id'];
    deleteAppointment($app_id);
    $appointments = fetchAppointments();
}
if (isset($_POST['update_app'])) {
    $app_id = $_POST['app_id'];
    $mrn = $_POST['user_mrn'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $testType = $_POST['selected'];
    $time = $_POST['time'];
    $formattedTime = $time . ':00';
    $date = $_POST['date'];

    if (empty($mrn) || empty($phone) || empty($name) || empty($email) || empty($testType) || empty($time) || empty($date)) {
        $error = "Missing credentials";
    }
    if ($date < date("Y-m-d")) {
        $error = "wrong information entered";
    }
    if (!preg_match("/^[0-9]{11}$/", $phone)) {
        $error = "wrong information entered";
    }
    if (empty($error)) {
        updateAppointment($app_id, $mrn, $phone, $testType, $formattedTime, $date);
        $appointments = fetchAppointments();
    }
}
// print_r($appointments);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/adminstyles.css" />
    <link rel="stylesheet" href="../styles/styles.css" />
    <link rel="stylesheet" href="../styles/modals.css" />

    <link rel="stylesheet" href="../styles/media-query.css" />
    <title>Edge Laboratory</title>
</head>

<body>
    <?php include __DIR__ . '/../components/adminnavbar.php'; ?>
    <section id="appointments">

        <h1>APPOINTMENTS</h1>
        <h3 class="input-error" style="margin-top: 1.5rem;" id="form-error">
            <?php if (!empty($error)) : ?>
                <?php echo $error; ?>
            <?php endif; ?>
        </h3>

        <?php foreach ($appointments as $appointment) : ?>
            <div class='row containerrow indgo' data-id="<?php echo $appointment['app_id'] ?>">


                <div class=" rowheaders">

                    <li>
                        <div class="rowItem">
                            <h3>
                                id
                            </h3>
                            <h4>
                                <?php echo $appointment['app_id'] ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                name
                            </h3>
                            <h4 id="appointname">
                                <?php echo $appointment['user_name'] ?>
                            </h4>
                        </div>
                    </li>

                    <li>
                        <div class="rowItem">
                            <h3>
                                type
                            </h3>
                            <h4>
                                <?php echo $appointment['test_name'] ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                email
                            </h3>
                            <h4 id="appointemail">
                                <?php echo $appointment['email'] ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                appointment-id
                            </h3>
                            <h4 id="appointid">
                                <?php echo $appointment['app_id'] ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class=" rowItem">
                            <h3>
                                MRN
                            </h3>
                            <h4 id="appointuserid">
                                <?php echo $appointment['mrn'] ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class=" rowButtons">
                            <div class="update-appoint" data-id="<?php echo $appointment['app_id'] ?>" data-mrn="<?php echo $appointment['mrn'] ?>" data-phone="<?php echo $appointment['phone_number'] ?>"><img src=" ../assets/icons8-modify-20.png"></div>
                            <div class="delete" data-id="<?php echo $appointment['app_id'] ?>">
                                <img src="../assets/icons8-delete-20.png">
                            </div>
                        </div>
                    </li>

                </div>



            </div>
        <?php endforeach; ?>
        <!-- <div class='row containerrow indgo'>


            <div class="rowheaders">

                <li>
                    <div class="rowItem">
                        <h3>
                            id
                        </h3>
                        <h4>
                            1
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            name
                        </h3>
                        <h4 id="appointname">
                            ahmed
                        </h4>
                    </div>
                </li>

                <li>
                    <div class="rowItem">
                        <h3>
                            type
                        </h3>
                        <h4>
                            heart
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="appointemail">
                            ahmed@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            appointment-id
                        </h3>
                        <h4 id="appointid">
                            2213
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowItem">
                        <h3>
                            user-id
                        </h3>
                        <h4 id="appointuserid">
                            123
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowButtons">
                        <div class="update-appoint"><img src=" ../assets/icons8-modify-20.png"></div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>

            </div>



        </div> -->
        <!-- <div class='row containerrow indgo'>

            <div class=" rowcontainer">
            </div>
            <div class="rowheaders">

                <li>
                    <div class="rowItem">
                        <h3>
                            id
                        </h3>
                        <h4>
                            1
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            name
                        </h3>
                        <h4 id="appointname">
                            yara
                        </h4>
                    </div>
                </li>

                <li>
                    <div class="rowItem">
                        <h3>
                            type
                        </h3>
                        <h4>
                            heart
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="appointemail">
                            yara@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            appointment-id
                        </h3>
                        <h4 id="appointid">
                            221311
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowItem">
                        <h3>
                            user-id
                        </h3>
                        <h4 id="appointuserid">
                            123
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowButtons">
                        <div class="update-appoint"><img src=" ../assets/icons8-modify-20.png"></div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>

            </div>



        </div> -->

    </section>





    <!-- <footer class="footer" id="contact">
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
    </footer> -->


    <div id="updateappointModal" class="update-modal">
        <div class="update-modal-content">
            <span class="close-update-appoint">&times;</span>
            <h2>Update appointment</h2>
            <form action="appointments.php" method="POST">
                <label for="appointnameform"></label>
                <input type="text" name="name" id="appointnameform" placeholder="name">
                <label for="appointUserIdform"></label>
                <label for="appointIDform"></label>
                <input type="email" id="appointEmailform" name="email" placeholder="email">
                <input type="text" id="phone" name="phone" placeholder="phone">

                <label for=" appointEmailform"></label>

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
                <input name="date" type="date" id="testdateform" placeholder=" Date">

                <input type="hidden" id="update-appointment__mrn" value="" name="user_mrn" placeholder="MRN">
                <input type="hidden" id="update-appointment__id" value="" name="app_id" placeholder="MRN">
                <button type="submit" name="update_app" id="updateAppointButton">Update</button>

            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <form action="appointments.php" method="POST" class="modal-content">
            <input type="hidden" id="delete_id_input" name="app_id" value="">
            <span class="close">&times;</span>
            <h3>Are you sure you want to delete this record?</h3>
            <div class="modal-buttons">

                <button type="submit" name="delete_app" id="confirmButton">Delete</button>
            </div>
        </form>
    </div>

</body>
<!-- update appointments -->

<script defer>
    // Get the update modal element
    let updateAppointModal = document.querySelector("#updateappointModal");

    // Get all the update buttons
    let updateAppointButtons = document.querySelectorAll('.update-appoint');

    // Get the close button element
    let closeupdateappoint = updateAppointModal.querySelector(".close-update-appoint");

    // Get the update button element
    let updatappointButton = updateAppointModal.querySelector("#updateAppointButton");

    let appointrow = "";

    // When the user clicks on an update button, open the update modal
    updateAppointButtons.forEach(function(updatappointButton) {
        updatappointButton.addEventListener("click", function() {
            updateAppointModal.style.display = "block";
            // Set the row to update as the parent of the clicked button
            let appointRowToUpdate = updatappointButton.parentNode.parentNode.parentNode;

            // Set the input values to the current row values
            let emailInput = updateAppointModal.querySelector("#appointEmailform");
            let appointIdInput = updateAppointModal.querySelector("#appointIdform");
            let userid = updateAppointModal.querySelector("#appointUserIdform");
            let appointusername = updateAppointModal.querySelector("#appointnameform");

            emailInput.value = appointRowToUpdate.querySelector("#appointemail").textContent.trim();
            appointusername.value = appointRowToUpdate.querySelector("#appointname").textContent.trim();
            document.getElementById('update-appointment__mrn').value = updatappointButton.dataset.mrn;
            document.getElementById('update-appointment__id').value = updatappointButton.dataset.id;
            document.getElementById('phone').value = updatappointButton.dataset.phone
            // Store the row to update and the update button as properties of the update button
            appointrow = appointRowToUpdate;
        });
    });


    // When the user clicks on the close button, close the update modal
    closeupdateappoint.onclick = function() {
        document.querySelector("#updateappointModal").
        style.display = "none";
    };

    // When the user clicks outside the update modal, close it
    window.addEventListener("click", function(event) {
        if (event.target == updateAppointModal) {
            updateAppointModal.style.display = "none";
        }
    });

    // When the user clicks on the update button, update the row and close the update modal
    updatappointButton.addEventListener("click", function() {

        // Update the row here




        let emailvalue = document.getElementById("appointEmailform").value;
        let appointId = document.getElementById("appointIdform").value;
        let userid = document.getElementById("appointUserIdform").value;
        let nameValue = document.getElementById("appointnameform").value
        // Update the text content of an element with ID "name" inside a row element

        appointrow.querySelector("#appointemail").textContent = emailvalue;

        appointrow.querySelector("#appointid").textContent = appointId;
        appointrow.querySelector("#appointname").textContent = nameValue

        appointrow.querySelector("#appointuserid").textContent = userid;
        updateAppointModal.style.display = "none";
    });
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

    let deleteIdInput = document.querySelector("#delete_id_input");
    // When the user clicks on a delete button, open the modal
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener("click", function() {
            deleteIdInput.value = deleteButton.dataset.id;
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
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
</script>