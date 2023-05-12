<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <h1 class="Poiret">edge.</h1>
            <div class="nav-list-container">
                <ul class="nav-list ">
                    <li><a href="http://localhost:8001/MedicalLabratory/"> Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-right__actions ">
            <div class="navbar-right ">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <a class="btn sign-in" href="http://localhost:8001/MedicalLabratory/login.php">Sign In</a>
                    <a class="btn sign-up" href="http://localhost:8001/MedicalLabratory/signup.php">Sign Up</a>
                <?php else : ?>
                    <a class="btn sign-in" href="http://localhost:8001/MedicalLabratory/logout.php">Logout</a>
                    <?php if ($_SERVER['REQUEST_URI'] == "/MedicalLabratory/") {
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