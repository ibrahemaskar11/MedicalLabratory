<?php
require_once __DIR__ . '/../db/admin.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
    exit;
}
$reports = fetchReports();
if (isset($_POST['delete_report'])) {
    $report_id = $_POST['user_report_id'];
    $report_url = $_POST['user_report_url'];
    deleteReport($report_id, $report_url);
    $reports = fetchReports();
}
// print_r($reports)

if (isset($_POST['update-report'])) {
    // print_r($_POST);
    $mrn = $_POST['mrn'];
    $test_id = $_POST['selected'];
    $report_id = $_POST['report_id'];
    $tempUrl = $_POST['temp_url'];
    $appId = $_POST['app_id'];
    $file = $_FILES['report-file'];
    if (empty($mrn) || empty($test_id) || empty($report_id) || empty($tempUrl) || empty($appId)) {
        $error = "Missing credentials";
    }
    if ($file['size'] == 0) {
        $error = "Missing credentials";
    }
    if (empty($error)) {
        updateReport($mrn, $test_id, $report_id, $tempUrl, $appId, $file);
        $reports = fetchReports();
    }
}

$conn = db_connect();
$sql = "SELECT test_id, name FROM tests";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$tests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/adminstyles.css?<?= rand() ?>" />
    <link rel="stylesheet" href="../styles/styles.css?<?= rand() ?>" />
    <link rel="stylesheet" href="../styles/modals.css?<?= rand() ?>" />

    <link rel="stylesheet" href="../styles/media-query.css?<?= rand() ?>" />
    <title>Edge Laboratory</title>
</head>

<body>

    <?php include __DIR__ . '/../components/adminnavbar.php'; ?>
    <section id="reps">

        <h1> Reports</h1>
        <h3 class="input-error" style="margin-top: 1.5rem;" id="form-error">
            <?php if (!empty($error)) : ?>
                <?php echo $error; ?>
            <?php endif; ?>
        </h3>
        <?php foreach ($reports as $report) : ?>
            <div class='row containerrow indgo '>
                <div class="rowheaders">

                    <li>
                        <div class="rowItem">
                            <h3>
                                id
                            </h3>
                            <h4>
                                <?php echo $report['report_id']; ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                name
                            </h3>
                            <h4 id="testname">
                                <?php echo $report['username']; ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                date
                            </h3>
                            <h4 id="testdate">
                                <?php echo $report['date']; ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                type
                            </h3>
                            <h4 id="testtype">
                                <?php echo $report['test_name']; ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class=" rowItem">
                            <h3>
                                email
                            </h3>
                            <h4 id="testemail">
                                <?php echo $report['email']; ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                phone
                            </h3>
                            <h4 id="testphone">
                                <?php echo $report['phone_number']; ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="rowItem">
                            <h3>
                                MRN
                            </h3>
                            <h4 id="testuserId">
                                <?php echo $report['mrn']; ?>
                            </h4>
                        </div>
                    </li>
                    <li>

                        <div class=" rowButtons">
                            <a class="view pointer" href="./view.php?url=<?php echo $report['url'] ?>" target="_blank"> <img src="../assets/icons8-file-24 (1).png"></a>
                            <div class="update-test pointer" data-app="<?php echo $report['appointment_id'] ?>" data-mrn="<?php echo $report['mrn'] ?>" data-test="<?php echo $report['test_id'] ?>" data-url="<?php echo $report['url'] ?>" data-id="<?php echo $report['report_id'] ?>">
                                <img src=" ../assets/icons8-modify-20.png">
                            </div>
                            <div class="delete pointer" data-url="<?php echo $report['url'] ?>" data-id="<?php echo $report['report_id'] ?>"> <img src="../assets/icons8-delete-20.png"></div>
                        </div>
                    </li>


                </div>
            </div>
        <?php endforeach; ?>
        <!-- <div class='row containerrow indgo '>

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




        </div> -->
        <!-- <div class='row containerrow indgo '>

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
            <h3 class="Poiret">EDGE</h3>
            <p class=" footer__copyright">
                &copy; Copyright by
                <a class="footer__link twitter-link" target="_blank" href="https://twitter.com/ibrahim_askar11">Ibrahim
                    Askar </a>All rights reserved
                </p>
        </div>
        </div>
    </footer> -->




    <div id="updateTestModal" class="add-modal">
        <div class="add-modal-content">
            <span class="close-add" id="close-update-test">&times;</span>
            <h2>Update Report</h2>
            <form action="reports.php" method="POST" enctype="multipart/form-data">

                <label for=""></label>
                <input type="text" id="mrn-input" placeholder="MRN">
                <label for=""></label>
                <input type="text" id="app-id" placeholder="appointment-id">



                <select class="select" id="selected" name="">
                    <option value="0">Test Type:</option>
                    <?php foreach ($tests as $test) : ?>
                        <option value="<?php echo $test['test_id']; ?>">
                            <?php echo $test['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>




                <input type="file" id="myFile" name="report-file" class="file-input">
                <input type="hidden" value="" name="temp_url" id="url">
                <input type="hidden" value="" name="report_id" id="report-id">
                <input type="hidden" id="app-id_input_hidden" name="app_id">
                <input type="hidden" id="mrn_input_hidden" name="mrn">
                <input type="hidden" id="selected_input_hidden" name="selected">
                <span> last uploaded: <?php echo $report['url'] ?></span>
                <button type="submit" name="update-report" id="add-button-test">update report</button>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <form action="reports.php" method="POST" class="modal-content">
            <input type="hidden" id="delete_report_value" name="user_report_id" value="">
            <input type="hidden" id="delete_report_url" name="user_report_url" value="">
            <span class="close">&times;</span>
            <h3>Are you sure you want to delete this record?</h3>
            <div class="modal-buttons">

                <button type="submit" name="delete_report" id="confirmButton">Delete</button>
            </div>
        </form>
    </div>
</body>


<script defer>
    // Get the update modal element
    let updateTestModal = document.querySelector("#updateTestModal");
    console.log(updateTestModal);

    // Get all the update buttons
    let updateTestButtons = document.querySelectorAll('.update-test');

    // Get the close button element
    let closeupdatetest = updateTestModal.querySelector("#close-update-test");
    console.log(closeupdatetest);

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
            let mrnInput = document.querySelector("#mrn-input");
            let fileInput = document.querySelector("#url");
            let appointmentIDInput = document.querySelector("#app-id");
            let testType = document.querySelector("#selected");
            let reportId = document.querySelector("#report-id");

            mrnInput.value = updateTestButton.dataset.mrn
            mrnInput.disabled = true;
            document.querySelector("#mrn_input_hidden").value = updateTestButton.dataset.mrn
            appointmentIDInput.value = updateTestButton.dataset.app
            appointmentIDInput.disabled = true;
            document.querySelector("#app-id_input_hidden").value = updateTestButton.dataset.app
            testType.value = updateTestButton.dataset.test
            testType.disabled = true;
            document.querySelector("#selected_input_hidden").value = updateTestButton.dataset.test
            fileInput.value = updateTestButton.dataset.url
            reportId.value = updateTestButton.dataset.id
        });
    });


    // When the user clicks on the close button, close the update modal
    closeupdatetest.onclick = function() {
        updateTestModal.style.display = "none"
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
    let deleteInput = document.getElementById("delete_report_value")
    let deleteUrl = document.getElementById("delete_report_url")

    // When the user clicks on a delete button, open the modal
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener("click", function() {
            modal.style.display = "block";
            deleteInput.value = deleteButton.dataset.id;
            deleteUrl.value = deleteButton.dataset.url;

            // Set the row to delete as the parent of the clicked button
            // Store the row to delete as a property of the confirm button
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