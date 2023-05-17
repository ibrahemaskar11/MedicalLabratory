<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/styles.css?<?= rand() ?>" />
    <title>Edge Laboratory</title>
    <style>
        .report-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        iframe {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <iframe src="./uploads/<?php echo $_GET['url'] ?>" frameborder="0"></iframe>
    </div>
</body>

</html>