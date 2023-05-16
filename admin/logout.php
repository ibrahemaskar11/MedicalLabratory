<?php
session_start();
unset($_SESSION['admin']);
header('location:/MedicalLabratory/admin/login.php');
