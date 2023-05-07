<?php
require_once __DIR__ . '/db/db.php';
session_start();
if (isset($_SESSION['user'])) {
  header('location:profile.php');
  exit();
}


$error = "";
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $errors = [];
  if (empty($email)) {
    $error = "Missing credentials";
  }
  if (empty($password)) {
    $error = "Missing credentials";
  }
  if (empty($error)) {
    $user = login($email, $password);
    if ($user === null) {
      $error = "Wrong email or password";
    } else {
      $error = '';
      header("location: profile.php");
      exit;
    }
  }
}


// $statement = "SELECT * FROM users WHERE email ='$email'";
// $query = $conn->prepare($statement);
// $query->execute();
// $data = $query->fetch();
// if (!$data) {
//   $errors[] = "Email or password is incorrect";
// } else {

//   $password_hash = $data['password'];

//   if (!password_verify($password, $password_hash)) {
//     $errors[] = "Email or password is incorrect";
//   } else {
//     $_SESSION['user'] = [
//       "name" => $data['username'],
//       "userid" => $data['id'],
//       "email" => $email,
//       "age" => $data['age'],
//       "address" => $data['address'],
//     ];
//     header('location:profile.php');
//   }
// }
//   }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      let submit = $("#submit");
      $("#email").on("keyup", function() {
        let errorContainer = $('#email-error')
        setTimeout(() => {
          console.log("hello");
          let inputVal = $(this).val();
          if (inputVal.length > 0 && !(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(inputVal))) {
            $(this).css("border-color", "red");
            errorContainer.text("please enter a valid email")
            submit.prop('disabled', true)
          } else {
            $(this).css('border-color', 'rgb(203, 213, 225)')
            errorContainer.text("")
            submit.prop('disabled', false)
          }
        }, 1000)

      });
      $("#password").on("keyup", function() {
        let errorContainer = $('#password-error')
        setTimeout(() => {
          console.log("hello");
          let inputVal = $(this).val();
          if (inputVal.length > 0 && !(/^(?=.{6,16}$)/.test(inputVal))) {
            $(this).css("border-color", "red");
            errorContainer.text("Password must be between 6 and 16 characters")
            submit.prop('disabled', true)
          } else {
            $(this).css('border-color', 'rgb(203, 213, 225)')
            errorContainer.text("")
            submit.prop('disabled', false)

          }
        }, 1000)

      });
    });
  </script>
  <title>login</title>
</head>

<body>
  <div class="signup-page">
    <form action="login.php" class="signup-form" name="POST" method="POST">

      <div class="form-container">
        <h1 class="signup-header">Login</h1>
        <h3 class="input-error" id="form-error">
          <?php if (!empty($error)) : ?>
            <?php echo $error; ?>
          <?php endif; ?>
        </h3>
        <input type="text" placeholder="Email" id="email" name="email" />
        <h3 class="input-error" id="email-error"></h3>
        <input type="password" placeholder="Password" id="password" name="password" />
        <h3 class="input-error" id="password-error"></h3>
        <button type="submit" id="submit" class="btn signup-form__btn" name="login" value="Login">
          Submit
        </button>
        <!-- <div class="signup__providers--container">
            <p>or login with</p>
            <div class="signup__providers">
              <span
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 48 48"
                  width="36px"
                  height="36px"
                  className="cursor-pointer"
                >
                  <path
                    fill="#fbc02d"
                    d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12 s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20 s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"
                  />
                  <path
                    fill="#e53935"
                    d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039 l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"
                  />
                  <path
                    fill="#4caf50"
                    d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36 c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"
                  />
                  <path
                    fill="#1565c0"
                    d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571 c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"
                  /></svg
              ></span>
              <span
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 48 48"
                  width="36px"
                  height="36px"
                  className="cursor-pointer"
                >
                  <linearGradient
                    id="Ld6sqrtcxMyckEl6xeDdMa"
                    x1="9.993"
                    x2="40.615"
                    y1="9.993"
                    y2="40.615"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop offset="0" stop-color="#2aa4f4" />
                    <stop offset="1" stop-color="#007ad9" />
                  </linearGradient>
                  <path
                    fill="url(#Ld6sqrtcxMyckEl6xeDdMa)"
                    d="M24,4C12.954,4,4,12.954,4,24s8.954,20,20,20s20-8.954,20-20S35.046,4,24,4z"
                  />
                  <path
                    fill="#fff"
                    d="M26.707,29.301h5.176l0.813-5.258h-5.989v-2.874c0-2.184,0.714-4.121,2.757-4.121h3.283V12.46 c-0.577-0.078-1.797-0.248-4.102-0.248c-4.814,0-7.636,2.542-7.636,8.334v3.498H16.06v5.258h4.948v14.452 C21.988,43.9,22.981,44,24,44c0.921,0,1.82-0.084,2.707-0.204V29.301z"
                  /></svg
              ></span>
              <span
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="#000000"
                  viewBox="0 0 30 30"
                  width="36px"
                  height="36px"
                  className="cursor-pointer"
                  stopColor=""
                >
                  {" "}
                  <path
                    d="M15,3C8.373,3,3,8.373,3,15c0,5.623,3.872,10.328,9.092,11.63C12.036,26.468,12,26.28,12,26.047v-2.051 c-0.487,0-1.303,0-1.508,0c-0.821,0-1.551-0.353-1.905-1.009c-0.393-0.729-0.461-1.844-1.435-2.526 c-0.289-0.227-0.069-0.486,0.264-0.451c0.615,0.174,1.125,0.596,1.605,1.222c0.478,0.627,0.703,0.769,1.596,0.769 c0.433,0,1.081-0.025,1.691-0.121c0.328-0.833,0.895-1.6,1.588-1.962c-3.996-0.411-5.903-2.399-5.903-5.098 c0-1.162,0.495-2.286,1.336-3.233C9.053,10.647,8.706,8.73,9.435,8c1.798,0,2.885,1.166,3.146,1.481C13.477,9.174,14.461,9,15.495,9 c1.036,0,2.024,0.174,2.922,0.483C18.675,9.17,19.763,8,21.565,8c0.732,0.731,0.381,2.656,0.102,3.594 c0.836,0.945,1.328,2.066,1.328,3.226c0,2.697-1.904,4.684-5.894,5.097C18.199,20.49,19,22.1,19,23.313v2.734 c0,0.104-0.023,0.179-0.035,0.268C23.641,24.676,27,20.236,27,15C27,8.373,21.627,3,15,3z"
                  /></svg
              ></span>
              <span
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 48 48"
                  width="36px"
                  height="36px"
                  className="cursor-pointer"
                >
                  <path
                    fill="#03A9F4"
                    d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429"
                  /></svg
              ></span>
            </div>
          </div> -->
        <div class="signup__footer">
          you don't have an account?
          <a class="login__link" href="http://localhost:8001/MedicalLaboratory/signup.php  "> sign up </a>
          .
        </div>
      </div>
    </form>
  </div>
</body>

</html>