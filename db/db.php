<?php
require_once 'conn.php';

function login($email, $password)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            "id" => $user['mrn'],
            "name" => $user['username'],
            "email" => $user['email'],
            "address" => $user['address'],
            "birthdate" => $user['birthdate'],
            "age" => $user['age'],
        ];
    } else {
        $user = null;
    }
    mysqli_close($conn);
    return $user;
}

function signup($email, $name, $password, $address, $date)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, address, birthdate) VALUES (?, ?, ?, ?, ?)");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $hashed_password, $address, $date);
    // mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $address, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    $user = login($email, $password);
    $_SESSION['user'] = [
        "id" => $user['mrn'],
        "name" => $user['username'],
        "email" => $user['email'],
        "address" => $user['address'],
        "birthdate" => $user['birthdate'],
        "age" => $user['age'],
    ];
}

function addAppointment($mrn, $phoneNumber, $testType, $time, $date)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "INSERT INTO appointments (mrn, phone_number, test_type, time, date) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $mrn, $phoneNumber, $testType, $time, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function fetchAppointments($userId)
{
    $conn = db_connect();

    $sql = "SELECT a.app_id, a.date, a.time, a.phone_number, t.name AS test_name
        FROM appointments a
        JOIN tests t ON a.test_type = t.test_id
        WHERE a.mrn = ? AND a.date >= CURDATE()";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $appointments;
}

function fetchReports($userId)
{
    $conn = db_connect();

    $sql =
        "SELECT r.report_id, r.url, u.username, u.email, u.mrn, a.date, a.time, a.phone_number, t.name AS test_name
        FROM reports r
        JOIN users u ON r.mrn = u.mrn
        JOIN appointments a ON r.appointment_id = a.app_id
        JOIN tests t ON a.test_type = t.test_id
        WHERE u.mrn = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $reports;
}
function updateAppointment($app_id, $mrn, $phone, $testType, $time, $date)
{
    $conn = db_connect();
    $sql = "UPDATE appointments SET  phone_number = ?, test_type = ?, time = ?, date = ? WHERE app_id = ? AND mrn = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sissii", $phone, $testType, $time, $date, $app_id, $mrn);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
function deleteAppointment($appointmentId)
{
    $conn = db_connect();
    $stmt = mysqli_prepare($conn, "DELETE FROM appointments WHERE app_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $appointmentId);
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

    // $conn = db_connect();
    // $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE mrn = ?");
    // mysqli_stmt_bind_param($stmt, "s", $mrn);
    // mysqli_stmt_execute($stmt);
    // $result = mysqli_stmt_get_result($stmt);
    // $user = mysqli_fetch_assoc($result);
    // mysqli_stmt_close($stmt);

    $date = new DateTime($userDate);
    $today = new DateTime();
    $age = $today->diff($date)->y;
    $_SESSION['user'] = [
        "id" => $mrn,
        "name" => $userName,
        "email" => $userEmail,
        "address" => $userAddress,
        "birthdate" => $userDate,
        "age" => $age,
    ];
}

function updateUserPassword($mrn, $currentPassword, $newPassword)
{
    // Connect to the database
    $conn = db_connect();

    // Prepare the select statement to fetch the hashed password
    $selectSql = "SELECT password FROM users WHERE mrn = ?";
    $selectStmt = mysqli_prepare($conn, $selectSql);

    // Bind the MRN parameter and execute the select statement
    mysqli_stmt_bind_param($selectStmt, "i", $mrn);
    mysqli_stmt_execute($selectStmt);

    // Fetch the hashed password from the result
    mysqli_stmt_bind_result($selectStmt, $hashedPassword);

    mysqli_stmt_fetch($selectStmt);

    // Close the select statement
    mysqli_stmt_close($selectStmt);
    // Verify the current password
    if (password_verify($currentPassword, $hashedPassword)) {
        // Hash the new password
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Prepare the update statement
        $updateSql = "UPDATE users SET password = ? WHERE mrn = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);

        // Bind parameters and execute the update statement
        mysqli_stmt_bind_param($updateStmt, "si", $newHashedPassword, $mrn);
        mysqli_stmt_execute($updateStmt);
        // Close the update statement
        mysqli_stmt_close($updateStmt);

        // Close the database connection
        mysqli_close($conn);
        return 'success';
    } else {
        return 'something went wrong';
    }
}
