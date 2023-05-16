<?php
$requestUri = $_SERVER['REQUEST_URI'];
?>

<nav class="<?php if (str_contains($requestUri, 'admin')) {
                echo ('navbar-admin');
            } else {
                echo 'navbar';
            } ?>">
    <div class="navbar-container">
        <div class="navbar-left">
            <h1 class="Poiret">edge.</h1>
            <div class="nav-list-container">
                <?php if (str_contains($requestUri, 'admin')) : ?>
                   <ul class="nav-list ">
                        <li><a href="index.php"> Users</a></li>
                        <li><a href="reports.php">Reports</a></li>
                        <li><a href="appointments.php">Apointments</a></li>
                    </ul>
                <?php else : ?>
                    <ul class="nav-list ">
                        <li><a href="http://localhost:8001/MedicalLabratory/#hom"> Home</a></li>
                        <li><a href="http://localhost:8001/MedicalLabratory/#abt">About</a></li>
                        <li><a href="http://localhost:8001/MedicalLabratory/#srvs">Services</a></li>
                        <li><a href="http://localhost:8001/MedicalLabratory/#pri">Pricing</a></li>
                        <li><a href="http://localhost:8001/MedicalLabratory/#us">Make an Appointment</a></li>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
        <div class="navbar-right__actions ">
            <div class="navbar-right ">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <a class="btn sign-in" href="http://localhost:8001/MedicalLabratory/login.php">Sign In</a>
                    <a class="btn sign-up" href="http://localhost:8001/MedicalLabratory/signup.php">Sign Up</a>
                <?php else : ?>
                    <a class="btn sign-in" href="http://localhost:8001/MedicalLabratory/logout.php">Logout</a>
                    <?php if ($_SERVER['REQUEST_URI'] == "/MedicalLabratory/" || $_SERVER['REQUEST_URI'] == "/MedicalLabratory/index.php") {
                        echo '<a class="account-btn" href="http://localhost:8001/MedicalLabratory/profile.php">
                            <img src="./assets/icons8-user-24.png" alt="">
                        </a>';
                    } ?>
                    <!-- <a class="account-btn" href="http://localhost:8001/MedicalLabratory/profile.php">
                            <img src="./assets/icons8-user-24.png" alt="">
                        </a> -->
                <?php endif; ?>
            </div>
        </div>
        <div class="navbar-right ">
            <div class="navbar-btn ">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>
    <div class="navbar-mobile ">
        <ul class="navbar-mobile__list hidden" id="list-mobile">
            <li><a href="#hom"> Home</a></li>
            <li><a href="#abt">About</a></li>
            <li><a href="#srvs">Services</a></li>
            <li><a href="#pri">Pricing</a></li>
            <li><a href="#us">Contact us</a></li>
        </ul>
        <div class="navbar-mobile__actions">
            <button class=" sign-in__mobile">Sign In</button>
            <button class=" sign-up__mobile">Sign Up</button>
        </div>
    </div>
</nav>

<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>