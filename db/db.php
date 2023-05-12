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
        WHERE a.mrn = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $appointments;
}

function fetchReports($userId){
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