<?php
require_once __DIR__ . '/conn.php';

// Extract the MRN from the request body
$mrn = $_POST['mrn'];

// Connect to the database
$conn = db_connect();

// Prepare the SQL query to retrieve appointments based on MRN
$sql = "SELECT * FROM appointments WHERE mrn = ? AND date <= CURDATE()";
$stmt = mysqli_prepare($conn, $sql);

// Bind the MRN parameter and execute the query
mysqli_stmt_bind_param($stmt, "i", $mrn);
mysqli_stmt_execute($stmt);

// Fetch the appointment data
$result = mysqli_stmt_get_result($stmt);
$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Return the appointment data as JSON response
header('Content-Type: application/json');
echo json_encode($appointments);
