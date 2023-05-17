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
  <link rel="stylesheet" href="./styles/styles.css?<?= rand() ?>" />
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
        <div class="signup__footer">
          you don't have an account?
          <a class="login__link" href="./signup.php  "> sign up </a>
          .
        </div>
      </div>
    </form>
  </div>
</body>

</html>