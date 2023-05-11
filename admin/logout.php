<?php
session_start();
session_unset();
header('location:/MedicalLabratory/admin/login.php');
?>