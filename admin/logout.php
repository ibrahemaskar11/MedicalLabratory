<?php
session_start();
session_unset();
header('location:/MedicalLaboratory/admin/login.php');
?>