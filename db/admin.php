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
