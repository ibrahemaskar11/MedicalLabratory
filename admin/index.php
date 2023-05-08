<!-- <?php
      //   session_start();
      // if(!isset($_SESSION['admin'])){
      //     header('http://localhost:1337/MedicalLaboratory/admin/login.php');
      //     exit();
      // }
      //     require('../conn-db.php');
      //     $userSql = $conn->prepare("SELECT * FROM users");
      //     $userSql->execute();
      //     $users = $userSql->fetchAll();
      //     $appointmentSql = $conn->prepare("SELECT * FROM appointments");
      //     $appointmentSql->execute();
      //     $appointments = $appointmentSql->fetchAll();
      //     $tests=['Cardiologists', 'Dermatologists', 'Endocrinologists', 'Gastroenterologists', 'Allergists', 'Immunologists'];
      //     $id = $_SESSION['admin']['username'];
      //     $testsSql = $conn->prepare("SELECT * FROM tests");
      //     $testsSql->execute();
      //     $testResults = $testsSql->fetchAll();

      ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="adminstyles.css" />
    <link rel="stylesheet" href="../styles.css" />
    <link rel="stylesheet" href="../modals.css" />

    <link rel="stylesheet" href="media-query.css" />
    <title>Edge Laboratory</title>
</head>

<body>
    <nav class="navbar-admin">
        <div class="navbar-container">
            <div class="navbar-left">
                <h1>Edge.</h1>
                <div class="nav-list-container">
                    <ul class="nav-list ">
                        <li><a href="#users"> Users</a></li>
                        <li><a href="#reps">Reports</a></li>
                        <li><a href="#appointments">Apointments</a></li>
                        <li><a href="#contact">Contact</a></li>

                    </ul>
                </div>
            </div>
            <div class="navbar-right ">
                <a class="btn sign-up" href="logout.php">log out</a>

            </div>
    </nav>

    <section id="users">
        <h1>USERS</h1>




        </div>
        <div class='row containerrow indgo'>
            <div class="rowcontainer"></div>
            <div class="rowheaders">

                <li>
                    <div class="rowItem">
                        <h3>
                            num
                        </h3>
                        <h4>
                            2
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            name
                        </h3>
                        <h4 id="name">
                            rana
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="email">
                            rana@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="phone">
                            01222213
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowButtons">
                        <div class="update"><img src=" ../assets/icons8-modify-20.png"></div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>

            </div>



        </div>
        <div class='row containerrow indgo'>
            <div class=" rowcontainer">
            </div>
            <div class="rowheaders">

                <li>
                    <div class="rowItem">
                        <h3>
                            num
                        </h3>
                        <h4>
                            3
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            name
                        </h3>
                        <h4 id="name">
                            sara
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="email">
                            sara@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="phone">
                            01222213
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowButtons">
                        <div class="update"><img src=" ../assets/icons8-modify-20.png"></div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>

            </div>



        </div>


        <div class='row containerrow indgo'>
            <div class=" rowcontainer">
            </div>
            <div class="rowheaders">

                <li>
                    <div class="rowItem">
                        <h3>
                            num
                        </h3>
                        <h4>
                            3
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            name
                        </h3>
                        <h4 id="name">
                            sara
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="email">
                            sara@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="phone">
                            01222213
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowButtons">
                        <div class="update"><img src=" ../assets/icons8-modify-20.png"></div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>

            </div>



        </div>
        <div class='row containerrow indgo'>
            <div class=" rowcontainer">
            </div>
            <div class="rowheaders">

                <li>
                    <div class="rowItem">
                        <h3>
                            num
                        </h3>
                        <h4>
                            4
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            name
                        </h3>
                        <h4 id="name">
                            noor
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="email">
                            noor@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="phone">
                            01222213
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowButtons">
                        <div class="update"><img src=" ../assets/icons8-modify-20.png"></div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>

            </div>



        </div>
    </section>
    <section id="reps">
        <div class="separator"></div>
        <h1> TESTS</h1>
        <div class='row containerrow indgo '>

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
                        <h4 id="testname">
                            ahmed
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            date
                        </h3>
                        <h4 id="testdate">
                            11/12/1011
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            type
                        </h3>
                        <h4 id="testtype">
                            heart
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="testemail">
                            ahmed@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="testphone">
                            01222213
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            user-id
                        </h3>
                        <h4 id="testuserId">
                            123
                        </h4>
                    </div>
                </li>
                <li>

                    <div class=" rowButtons">
                        <div class="update-test"><img src=" ../assets/icons8-modify-20.png">
                        </div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>


            </div>




        </div>
        <div class='row containerrow indgo '>

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
                        <h4 id="testname">
                            ahmed
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            date
                        </h3>
                        <h4 id="testdate">
                            11/12/1011
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            type
                        </h3>
                        <h4 id="testtype">
                            heart
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="testemail">
                            ahmed@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="testphone">
                            01222213
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            user-id
                        </h3>
                        <h4 id="testuserId">
                            123
                        </h4>
                    </div>
                </li>
                <li>

                    <div class=" rowButtons">
                        <div class="update-test"><img src=" ../assets/icons8-modify-20.png">
                        </div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>


            </div>




        </div>
        <div class='row containerrow indgo '>

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
                        <h4 id="testname">
                            aloka
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            date
                        </h3>
                        <h4 id="testdate">
                            11/12/1011
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            type
                        </h3>
                        <h4 id="testtype">
                            heart
                        </h4>
                    </div>
                </li>
                <li>
                    <div class=" rowItem">
                        <h3>
                            email
                        </h3>
                        <h4 id="testemail">
                            ysss@gmial.com
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            phone
                        </h3>
                        <h4 id="testphone">
                            01222
                        </h4>
                    </div>
                </li>
                <li>
                    <div class="rowItem">
                        <h3>
                            user-id
                        </h3>
                        <h4 id="testuserId">
                            1233
                        </h4>
                    </div>
                </li>
                <li>

                    <div class=" rowButtons">
                        <div class="update-test"><img src=" ../assets/icons8-modify-20.png">
                        </div>
                        <div class="delete"> <img src="../assets/icons8-delete-20.png"></div>
                    </div>
                </li>


            </div>




        </div>
    </section>

    <section id="appointments">
        <div class="separator"></div>
        <h1>APPOINTMENTS</h1>
        <div class='row containerrow indgo'>

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



        </div>
        <div class='row containerrow indgo'>

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


    <!-- Add a button to trigger the modal -->



    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Are you sure you want to delete this record?</h3>
            <div class="modal-buttons">

                <button id="confirmButton">Delete</button>
            </div>
        </div>
    </div>



    <!-- The update modal form -->
    <div id="updateUserModal" class="update-modal">
        <div class="update-modal-content">
            <span class="closeupdate">&times;</span>
            <h2>Update User</h2>
            <form>
                <label for="name"></label>
                <input type="text" id="nameform" name="name" placeholder="name">
                <label for=" email"></label>
                <input type="email" id="emailform" name="email" placeholder="email">
                <label for="phone"></label>
                <input type="tel" id="phoneform" name="phone" placeholder="phone">
                <button type="button" id="updateButton">Update</button>
            </form>
        </div>
    </div>


    <div id="updateTestModal" class="update-modal">
        <div class="update-modal-content">
            <span class="close-update-test">&times;</span>
            <h2>Update test</h2>
            <form>
                <label for="testname"></label>
                <input type="text" id="testnameform" placeholder="name">
                <label for="testuserid"></label>
                <input type="text" id="userIdform" name="appointmentid" placeholder="userId">

                <label for=" email"></label>
                <input type="email" id="testemailform" name="email" placeholder="email">
                <label for="phone"></label>
                <input type="tel" id="testphoneform" name="phone" placeholder="phone">
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
                <input name="date" type="date" id="testdateform" placeholder=" Date">


                <button type="button" id="updateButton">Update</button>

            </form>
        </div>
    </div>

    <div id="updateappointModal" class="update-modal">
        <div class="update-modal-content">
            <span class="close-update-appoint">&times;</span>
            <h2>Update appointment</h2>
            <form>
                <label for="appointnameform"></label>
                <input type="text" id="appointnameform" placeholder="name">
                <label for="appointUserIdform"></label>
                <input type="text" id="appointUserIdform" name="appointmentid" placeholder="user-id">
                <label for="appointIDform"></label>
                <input type="email" id="appointIdform" name="email" placeholder="appointment-id">

                <label for=" appointEmailform"></label>
                <input type="email" id="appointEmailform" name="email" placeholder="email">

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


                <button type="button" id="updateAppointButton">Update</button>

            </form>
        </div>
    </div>



</body>










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
        appointIdInput.value = appointRowToUpdate.querySelector("#appointid").textContent.trim();
        userid.value = appointRowToUpdate.querySelector("#appointuserid").textContent.trim();
        appointusername.value = appointRowToUpdate.querySelector("#appointname").textContent.trim();
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

    appointrow.querySelector("#appointuserid").textContent = userid;
    appointrow.querySelector("#appointname").textContent = nameValue
    updateAppointModal.style.display = "none";
});
</script>






<script defer>
// Get the update modal element
let updateTestModal = document.querySelector("#updateTestModal");

// Get all the update buttons
let updateTestButtons = document.querySelectorAll('.update-test');

// Get the close button element
let closeupdatetest = updateTestModal.querySelector(".close-update-test");

// Get the update button element
let updateTestButton = updateTestModal.querySelector("#updateButton");

let testrow = "";

// When the user clicks on an update button, open the update modal
updateTestButtons.forEach(function(updateTestButton) {
    updateTestButton.addEventListener("click", function() {
        updateTestModal.style.display = "block";
        // Set the row to update as the parent of the clicked button
        let testRowToUpdate = updateTestButton.parentNode.parentNode.parentNode.parentElement;

        // Set the input values to the current row values
        let emailInput = updateTestModal.querySelector("#testemailform");
        let phoneInput = updateTestModal.querySelector("#testphoneform");
        let userid = updateTestModal.querySelector("#userIdform");
        let testusername = updateTestModal.querySelector("#testnameform");

        emailInput.value = testRowToUpdate.querySelector("#testemail").textContent.trim();
        phoneInput.value = testRowToUpdate.querySelector("#testphone").textContent.trim();
        userid.value = testRowToUpdate.querySelector("#testuserId").textContent.trim();
        testusername.value = testRowToUpdate.querySelector("#testname").textContent.trim();
        // Store the row to update and the update button as properties of the update button
        testrow = testRowToUpdate;
    });
});


// When the user clicks on the close button, close the update modal
closeupdatetest.onclick = function() {
    document.querySelector("#updateTestModal").style.display = "none";
};

// When the user clicks outside the update modal, close it
window.addEventListener("click", function(event) {
    if (event.target == updateTestModal) {
        updateTestModal.style.display = "none";
    }
});


// When the user clicks on the update button, update the row and close the update modal
updateTestButton.addEventListener("click", function() {

    // Update the row here




    let emailvalue = document.getElementById("testemailform").value;
    let phonevalue = document.getElementById("testphoneform").value;
    let userid = document.getElementById("userIdform").value;
    let nameValue = document.getElementById("testnameform").value
    // Update the text content of an element with ID "name" inside a row element

    testrow.querySelector("#testemail").textContent =
        emailvalue;

    testrow.querySelector("#testphone").textContent = phonevalue;

    testrow.querySelector("#testuserId").textContent = userid;
    testrow.querySelector("#testname").textContent = nameValue
    document.getElementById("updateTestModal")
        .style.display = "none";
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
// When the user clicks on a delete button, open the modal
deleteButtons.forEach(function(deleteButton) {
    deleteButton.addEventListener("click", function() {
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
let updateModal = document.getElementById("updateUserModal");

// Get all the update buttons
let updateButtons = document.querySelectorAll('.update');

let updateButton = updateModal.querySelector("#updateButton");
// Get the close button element
let closeupdate = updateModal.querySelector(".closeupdate");

// Get the update button element

let row = ""
// When the user clicks on an update button, open the update modal
updateButtons.forEach(function(updateButton) {
    updateButton.addEventListener("click", function() {
        updateModal.style.display = "block";
        // Set the row to update as the parent of the clicked button
        let rowToUpdate = updateButton.parentNode.parentNode.parentElement.parentElement;
        // Set the input values to the current row values

        let nameInput = updateModal.querySelector("#nameform");
        let emailInput = updateModal.querySelector("#emailform");
        let phoneInput = updateModal.querySelector("#phoneform");

        nameInput.value = rowToUpdate.querySelector("#name").textContent.trim();;
        emailInput.value = rowToUpdate.querySelector("#email").textContent.trim();;
        phoneInput.value = rowToUpdate.querySelector("#phone").textContent.trim();;
        // Store the row to update and the update button as properties of the update button
        row = rowToUpdate;

    });
});

// When the user clicks on the close button, close the update modal
closeupdate.onclick = function() {
    updateModal.style.display = "none";
};

// When the user clicks outside the update modal, close it
window.onclick = function(event) {

    if (event.target == updateModal) {

        updateModal.style.display = "none";
    }
};

// When the user clicks on the update button, update the row and close the update modal
updateButton.addEventListener("click", function() {

    // Update the row here



    var nameValue = document.getElementById("nameform").value;
    var emailvalue = document.getElementById("emailform").value;
    var phonevalue = document.getElementById("phoneform").value;

    // Update the text content of an element with ID "name" inside a row element
    row.querySelector("#name").textContent = nameValue;
    row.querySelector("#email").textContent =
        emailvalue;

    row.querySelector("#phone").textContent = phonevalue;

    updateModal.style.display = "none";

});
</script>