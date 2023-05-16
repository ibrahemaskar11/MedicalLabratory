<?php
session_start();

// Unset the user session variable
unset($_SESSION['user']);

header('location: index.php');
