<?php

function db_connect()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect('localhost', 'root', '', 'MedicalLaboratory', 4306);

    return $conn;
}

function login($email, $password)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    print_r($admin);
    return $admin;
}

function fetchUsers()
{
    $conn = db_connect();

    $sql = "SELECT * from users";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $users;
}
function fetchAppointments()
{
    $conn = db_connect();

    $sql =
        "SELECT a.app_id, a.date, a.time, a.phone_number, t.name AS test_name, u.username AS user_name, u.email, u.mrn
        FROM appointments a
        JOIN tests t ON a.test_type = t.test_id
        JOIN users u ON a.mrn = u.mrn
";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $appointments;
}
function fetchReports()
{
    $conn = db_connect();

    $sql =
        "SELECT r.report_id, r.url,r.appointment_id, u.username, u.email, u.mrn, a.date, a.time, a.phone_number,t.test_id, t.name AS test_name
        FROM reports r
        JOIN users u ON r.mrn = u.mrn
        JOIN appointments a ON r.appointment_id = a.app_id
        JOIN tests t ON a.test_type = t.test_id";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $reports;
};

function deleteAppointment($appointmentId)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "DELETE FROM appointments WHERE app_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $appointmentId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
function deleteUser($mrn)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE mrn = ?");
    mysqli_stmt_bind_param($stmt, "i", $mrn);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
function deleteReport($reportId)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "DELETE FROM reports WHERE report_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $reportId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function updateUser($mrn, $userName, $userEmail, $userAddress, $userDate)
{

    $sql = "UPDATE users SET username = ?, email = ?, birthdate = ?, address = ? WHERE mrn = ?";
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $userName, $userEmail, $userDate, $userAddress, $mrn);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
function updateAppointment($app_id, $mrn, $phone, $testType, $time, $date)
{
    $conn = db_connect();
    $sql = "UPDATE appointments SET mrn = ?, phone_number = ?, test_type = ?, time = ?, date = ? WHERE app_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isissi", $mrn, $phone, $testType, $time, $date, $app_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function updateReport($mrn, $test_id, $report_id, $tempUrl, $appId, $file)
{
    $conn = db_connect();
    // Database query statements
    $testTypeQuery = "SELECT name FROM tests WHERE test_id = ?";
    $usernameQuery = "SELECT username FROM users WHERE mrn = ?";
    $appointmentQuery = "SELECT time, date FROM appointments WHERE app_id = ?";


    $stmtTestType = mysqli_prepare($conn, $testTypeQuery);
    $stmtUsername = mysqli_prepare($conn, $usernameQuery);
    $stmtAppointment = mysqli_prepare($conn, $appointmentQuery);

    mysqli_stmt_bind_param($stmtTestType, "i", $test_id);
    mysqli_stmt_bind_param($stmtUsername, "i", $mrn);
    mysqli_stmt_bind_param($stmtAppointment, "i", $appId);

    mysqli_stmt_execute($stmtTestType);
    $resultTestType = mysqli_stmt_get_result($stmtTestType);

    mysqli_stmt_execute($stmtUsername);
    $resultUsername = mysqli_stmt_get_result($stmtUsername);

    mysqli_stmt_execute($stmtAppointment);
    $resultAppointment = mysqli_stmt_get_result($stmtAppointment);

    // Fetch data from results
    $testTypeData = mysqli_fetch_assoc($resultTestType);
    $usernameData = mysqli_fetch_assoc($resultUsername);
    $appointmentData = mysqli_fetch_assoc($resultAppointment);

    // Close database statements and connection
    mysqli_stmt_close($stmtTestType);
    mysqli_stmt_close($stmtUsername);
    mysqli_stmt_close($stmtAppointment);
    mysqli_close($conn);

    // Extract relevant data
    $testName = $testTypeData['name'];
    $username = $usernameData['username'];
    $time = $appointmentData['time'];
    $appointmentDate = $appointmentData['date'];
    $targetDir = '../uploads/';
    // Delete the existing file
    // unlink($targetDir . $tempUrl);

    // File upload

    $fileName = $testName . '_' . $appointmentDate . '_' . $username . '_' . str_replace(':', '_', $time) . '.pdf';
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Update the URL in the database
        $conn = db_connect();
        $sql = "UPDATE reports SET  mrn = ?, test_type = ?, appointment_id = ?, url = ? WHERE report_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiisi", $mrn, $test_id, $appId, $fileName, $report_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // echo "The file " . basename($file["name"]) . " has been uploaded.";
    }   else {
        echo "Sorry, there was an error uploading your file.";
    }
}



function addAppointment($mrn, $phoneNumber, $testType, $time, $date)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "INSERT INTO appointments (mrn, phone_number, test_type, time, date) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssiss", $mrn, $phoneNumber, $testType, $time, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function uploadFile($testTypeID, $appointmentID, $mrn, $file)
{
    $targetDir = '../uploads/';
    $conn = db_connect();

    // Database query statements
    $testTypeQuery = "SELECT name FROM tests WHERE test_id = ?";
    $usernameQuery = "SELECT username FROM users WHERE mrn = ?";
    $appointmentQuery = "SELECT time, date FROM appointments WHERE app_id = ?";


    $stmtTestType = mysqli_prepare($conn, $testTypeQuery);
    $stmtUsername = mysqli_prepare($conn, $usernameQuery);
    $stmtAppointment = mysqli_prepare($conn, $appointmentQuery);

    mysqli_stmt_bind_param($stmtTestType, "i", $testTypeID);
    mysqli_stmt_bind_param($stmtUsername, "i", $mrn);
    mysqli_stmt_bind_param($stmtAppointment, "i", $appointmentID);

    mysqli_stmt_execute($stmtTestType);
    $resultTestType = mysqli_stmt_get_result($stmtTestType);

    mysqli_stmt_execute($stmtUsername);
    $resultUsername = mysqli_stmt_get_result($stmtUsername);

    mysqli_stmt_execute($stmtAppointment);
    $resultAppointment = mysqli_stmt_get_result($stmtAppointment);

    // Fetch data from results
    $testTypeData = mysqli_fetch_assoc($resultTestType);
    $usernameData = mysqli_fetch_assoc($resultUsername);
    $appointmentData = mysqli_fetch_assoc($resultAppointment);

    // Close database statements and connection
    mysqli_stmt_close($stmtTestType);
    mysqli_stmt_close($stmtUsername);
    mysqli_stmt_close($stmtAppointment);
    mysqli_close($conn);

    // Extract relevant data
    $testName = $testTypeData['name'];
    $username = $usernameData['username'];
    $time = $appointmentData['time'];
    $appointmentDate = $appointmentData['date'];

    // File upload
    $targetDir = '../uploads/';
    $fileName = $testName . '_' . $appointmentDate . '_' . $username . '_' . str_replace(':', '_', $time) . '.pdf';
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $reportQuery = "INSERT INTO reports (url, mrn, test_type, appointment_id) VALUES (?, ?, ?, ?)";
        $conn = db_connect();
        $stmt = mysqli_prepare($conn, $reportQuery);
        mysqli_stmt_bind_param($stmt, "siii", $fileName, $mrn, $testTypeID, $appointmentID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        return 'Failed to upload the file.';
    }
}
